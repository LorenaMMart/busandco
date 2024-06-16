<?php
namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Utils\TransformDto;

use App\Entity\Linea;
use App\Entity\Sublinea;
use App\Entity\Parada;
use App\Entity\SublineasParadasHorarios;
use App\Entity\Coordenadas;
use App\Entity\Horario;
use App\Entity\Empresa;
use App\Entity\Incidencia;

use App\Dto\ListLineasDto;
use App\Dto\CabeceraLineaDto;
use App\Dto\ParadaHorarioDto;
use App\Dto\SublineaDto;
use App\Dto\ParadaDto;
use App\Dto\EmpresaReduDto;
use App\Dto\EmpresaDto;
use App\Dto\BusquedaOrigenDestinoDto;
use App\Dto\CuerpoLineaDetalleDto;
use App\Dto\IncidenciasDto;
use App\Dto\CuerpoOrigenDestinoDto;

use App\Dto\COParadasDto;
use App\Dto\CODireccionesDto;

class UsuarioService{

    private $em;
   
    public function __construct(EntityManagerInterface $entityM)
    {
       $this->em = $entityM;
      
    }

    public function index(): array{
        return [
            'message' => 'Server status OK!',
            'path' => 'src/Controller/UsuarioController.php',
        ];
    }

    public function busquedaOrigenDestino(): array{
        
        $paradas = $this->em->getRepository(Parada::class)->findAll();
        $empresas = $this->em->getRepository(Empresa::class)->findAll();
        if($paradas && $empresas){
            $dtoListParada = [];
            $dtoListEmpresa = [];
            foreach($paradas as $parada){
                $dtoParada = ParadaDto::of($parada->getId(),$parada->getNombre(), $parada->getLatitud(), $parada->getLongitud(), $parada->getPoblacion()->getNombre());
                array_push($dtoListParada, $dtoParada);
            }
            foreach($empresas as $empresa){
                $dtoEmpresa = EmpresaReduDto::of($empresa->getId(), $empresa->getNombre());
                array_push($dtoListEmpresa, $dtoEmpresa);                                    
            }

        $dto = BusquedaOrigenDestinoDto::of($dtoListParada,
                                            $dtoListEmpresa);
            
        $transform_obj = new TransformDto();
        $jsonContent = $transform_obj->encoderDtoObject($dto);
        return [$jsonContent];
        }
        else{
            return ["error" => "Búsqueda sin resultados", "code"=>404];
        }  
    }

    public function origenDestino($origen, $destino): array{
        
        //Declaramos los arrays que contendrán los DTOs
        $dtoDirecciones = [];
        $dtoParadas = [];
        $dtoList = [];

        //Obtenemos de la BBDD los objetos parada Origen y Parada Destino

        $pOrigen = $this->em->getRepository(Parada::class)->find($origen);
        $pDestino = $this->em->getRepository(Parada::class)->find($destino);

        //Recorremos array de sublineas que incluyen las paradas de Origen y/o Destino
        $sublineasBusqueda = $this->em->getRepository(Sublinea::class)->findSublineasByParadas($pOrigen, $pDestino);
        if($sublineasBusqueda){

            foreach($sublineasBusqueda as $sublineaBusqueda){
                //Recuperamos las direcciones de la sublinea
                $direccionesSublinea = $this->em->getRepository(SublineasParadasHorarios::class)->findDireccionesBySublinea($sublineaBusqueda->getId());
                
                //Recorrecomos dichas direcciones y recuperamos las paradas de cada direccione
                foreach($direccionesSublinea as $direccionSublinea){
                    if($direccionSublinea && count($direccionSublinea)>0){

                        $paradasDireccion = $this->em->getRepository(Parada::class)->findParadasByDireccionSublinea($direccionSublinea['direccion'], $sublineaBusqueda->getId());
                    
                        //Recorremos las paradas y recuperamos los Horarios y el orden
                        foreach($paradasDireccion as $paradaDireccion){
                            if($paradaDireccion){
                                $horariosParada = $this->em->getRepository(Horario::class)->findHorariosByParadaSublineaDireccion($sublineaBusqueda->getId(),$paradaDireccion->getId(), $direccionSublinea);
                                $ordenParada = $this->em->getRepository(SublineasParadasHorarios::class)->findOrdenByParadaDireccion($paradaDireccion->getId(), $direccionSublinea['direccion']);
                                if(count($ordenParada) == 0){
                                    return ["error" => "No se han encontrado Datos", "code"=>404];
                                }else{
                                        //Generamos el dto con Datos de las Paradas 
                                        $dtoParada = COParadasDto::of($paradaDireccion->getId(),
                                        $paradaDireccion->getNombre(),
                                        $paradaDireccion->getPoblacion()->getNombre(),
                                        $ordenParada[0]['orden'],
                                        $horariosParada);
                                        array_push($dtoParadas, $dtoParada);
                                        $horariosParada = [];
 
                                    }
                            }
                            else{
                                return ["error" => "No se han encontrado Paradas", "code"=>404];
                            }   
                        } 

                        //Generamos el dto de direcciones
                        $dtoDireccion = CODireccionesDto::of($direccionSublinea['direccion'],
                                                            $dtoParadas);
                        array_push($dtoDirecciones, $dtoDireccion);
                        $dtoParadas = [];

                    }
                    else{
                        return ["error" => "No se han encontrado Direcciones", "code"=>404];
                    }
                    
                }

                //Generamos el dto de Sublineas
                $linea = $sublineaBusqueda->getLinea();
                $idLinea = $linea->getId();
                $nombreLinea = $linea->getNombre();
                $empresa = $linea->getEmpresa()->getNombre();
                $dtoCuerpoOrigenDestino = CuerpoOrigenDestinoDto::of($idLinea,
                                                                    $nombreLinea,
                                                                    $empresa,
                                                                    $sublineaBusqueda->getId(),
                                                                    $sublineaBusqueda->getNombre(),
                                                                    $dtoDirecciones);             
                array_push($dtoList, $dtoCuerpoOrigenDestino);
                $dtoDirecciones = [];

         
            }
            $transform_obj = new TransformDto();
            $jsonContent = $transform_obj->encoderDto($dtoList);
            return [$jsonContent];

        }else{
            return ["error" => "No se han encontrado Sublineas", "code"=>404];
        }
    }

    public function lineas(): array {
        $lineas = $this->em->getRepository(Linea::class)->findAll();
        if($lineas){
            $dtoList = [];
            foreach($lineas as $linea){
                if($linea->isActiva()){
                    $dto = ListLineasDto::of($linea->getId(),
                                        $linea->getNombre(),
                                        $linea->getDescripcion(),
                                        $linea->getEmpresa()->getNombre(),
                                        $linea->getTipo());
                    array_push($dtoList,$dto);     
                }                      
            }
            if(count($dtoList)>0){
                $transform_obj = new TransformDto();
                $jsonContent = $transform_obj->encoderDto($dtoList);
                return [$jsonContent];
            }
            else{
                return ["error" => "No hay Lineas activas", "code"=>404];
            }  
        }
        else{
            return ["error" => "Linea no encontrada", "code"=>404];
        } 
    }

    public function lineaDetalleCabecera($idLinea): array {
        $linea = $this->em->getRepository(Linea::class)->find($idLinea);
        if($idLinea && $idLinea != null && $linea && $linea->isActiva()){

            $dtoSubline = [];
            $idSublinea = 0;

                $nombreLinea = $linea->getNombre();

            $sublineas = $linea->getSublineas();
            $idSublinea = $sublineas[0]->getId();
                foreach($sublineas as $sublinea){
                    $dtoL = SublineaDto::of($sublinea->getId(),
                    $sublinea->getNombre());

                    array_push($dtoSubline, $dtoL);
                }

            $empresa = $linea->getEmpresa();
                $nombreEmpresa = $empresa->getNombre();
            
            //Recupero todas las direcciones de la sublinea, para pasarlas al frontend, en el método cuerpo se le para la dirección seleccionada por request    
            $direcciones = $this->em->getRepository(SublineasParadasHorarios::class)->findDireccionesBySublinea($idSublinea);
            $direccionS = [];
            if(count($direcciones) != 0){
                $direccionS = $direcciones;  
            }
                
            $coordenadas = $this->em->getRepository(Coordenadas::class)->findCoordenadasBySublinea($idSublinea); 
            
                $dto = CabeceraLineaDto::of(
                    $idLinea,
                    $nombreLinea,
                    $dtoSubline,
                    $direccionS,
                    $nombreEmpresa,
                    $coordenadas);
 
            $transform_obj = new TransformDto();
            $jsonContent = $transform_obj->encoderDtoObject($dto);
            return [$jsonContent];              
        }
        else{
            return ["error" => "Linea no encontrada", "code"=>404];
        } 
    }

    public function lineaDetalleCuerpo($direccion ,$idLinea, $idSubLinea): array{
        
        $sublinea = $this->em->getRepository(Sublinea::class)->find($idSubLinea);
        $linea = $this->em->getRepository(Linea::class)->find($idLinea);
        if($idSubLinea != null && $idLinea != null && $idSubLinea && $linea && $linea->isActiva()){
            $dtoList = [];
            $paradas =  $this->em->getRepository(Parada::class)->findParadasBySublinea($idSubLinea,$direccion);
            if($sublinea && $paradas){
                foreach($paradas as $parada){
                    $enlace = $this->em->getRepository(Linea::class)->findLineasByParada($linea->getId(), $parada->getId());
                    $coordenadas = $this->em->getRepository(Parada::class)->findCoordenadasbyParada($parada->getId());
                    $dto = CuerpoLineaDetalleDto::of($parada->getPoblacion()->getNombre(),
                                                    $parada->getNombre(),
                                                    $parada->getId(),
                                                    $enlace,
                                                    $coordenadas);
                    array_push($dtoList,$dto);                
                    }
                $transform_obj = new TransformDto();
                $jsonContent = $transform_obj->encoderDto($dtoList);
                return [$jsonContent];  
            }
            else{
                return ["error" => "Sublinea no encontrada", "code"=>404];
            }                  
        }
        else{
            return ["error" => "Linea no encontrada", "code"=>404];
        } 
    }

    public function paradaHorario($direccionRequest,$idSublinea,$idParada): array{
        $direccion = "";
        $sublinea = new Sublinea();
        $sublineas = $this->em->getRepository(Sublinea::class)->findSublineasActivas($idSublinea);
        if(count($sublineas)==0){
            return ["error" => "Sublinea no encontrada", "code"=>404];
        }else{
            $sublinea = $sublineas[0];
        }
        $direcciones = $this->em->getRepository(SublineasParadasHorarios::class)->findDireccionesBySublinea($sublinea->getId());

        if($direccionRequest){
            foreach($direcciones as $direccionBd){
                if($direccionBd['direccion'] == $direccionRequest){
                    $direccion = $direccionBd['direccion'];
                    break;
                }
            }
            if($direccion == ""){ return ["error" => "Direccion no válida", "code"=>404];}
        } 
        else{
            return ["error" => "Direccion no válida", "code"=>404];
        }
        
        $parada = $this->em->getRepository(Parada::class)->find($idParada);
        if($idParada != null && $parada && $sublinea){
            $horarioTipo = $this->em->getRepository(Horario::class)->findHorariosByParadaSublineaDireccion($sublinea->getId(),$parada->getId(), $direccion);
            if($horarioTipo){
                $dtoP = ParadaHorarioDto::of($parada->getId(),
                                        $parada->getNombre(),
                                        $parada->getPoblacion()->getNombre(),
                                        $horarioTipo);
                
                $transform_obj = new TransformDto();
                $jsonContent = $transform_obj->encoderDtoObject($dtoP);
                return [$jsonContent];   
            }
            else{
                return ["error" => "Horario no encontrado", "code"=>404];
            }           
        }
        else{
            return ["error" => "Parada no encontrada", "code"=>404];
        } 
    }

    public function incidencias(): array {
        $incidencias = $this->em->getRepository(Incidencia::class)->findAll();
        if($incidencias){
            $dtoList = [];
            foreach($incidencias as $incidencia){
                if($incidencia->isEstado() == true){
                    $lineasInc = $this->em->getRepository(Linea::class)->findLineaByIncidencia($incidencia->getId());
                    $dto = IncidenciasDto::of($incidencia->getId(),
                                            $incidencia->getNombre(),
                                            $incidencia->getDescripcion(),
                                            $incidencia->getFecha()->format('d-m-Y'),
                                            $lineasInc
                                            );

                    array_push($dtoList,$dto);   
                }                          
            }
            if(count($dtoList) == 0){
                return ["error" => "No existen incidencias activas", "code"=>404];
            }

            $transform_obj = new TransformDto();
            $jsonContent = $transform_obj->encoderDto($dtoList);
            return [$jsonContent];
        }
        else{
            return ["error" => "No existen incidencias", "code"=>404];
        } 
    }

    public function contacto(): array {
        $empresas = $this->em->getRepository(Empresa::class)->findAll();
        if($empresas){
            $dtoList = [];
            foreach($empresas as $empresa){
                $dto = EmpresaDto::of($empresa->getId(),
                                        $empresa->getNombre(),
                                        $empresa->getDireccion(),
                                        $empresa->getTelefono(),
                                        $empresa->getEmail(),
                                        $empresa->getWeb());
                array_push($dtoList,$dto);                        
            }
            
            $transform_obj = new TransformDto();
            $jsonContent = $transform_obj->encoderDto($dtoList);
            return [$jsonContent];
        }
        else{
            return ["error" => "No existen empresas", "code"=>404];
        } 
    }

}    
?>