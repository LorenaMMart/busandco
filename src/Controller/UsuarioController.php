<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\ORM\EntityManagerInterface;
use App\Utils\TransformDto;

use App\Entity\Linea;
use App\Entity\Sublinea;
use App\Entity\Parada;
use App\Entity\SublineasParadasHorarios;
use App\Entity\Coordenadas;
use App\Entity\Horario;
use App\Entity\Empresa;
use App\Entity\Noticia;
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
use App\Dto\NoticiaDto;
use App\Dto\SubParHorDto;
use App\Dto\CuerpoOrigenDestinoDto;
use DateTime;

#[Route('/usuario', name: 'usuario_')]
class UsuarioController extends AbstractController
{
   private $em;
    public function __construct(EntityManagerInterface $entityM)
    {
       $this->em = $entityM;
    }

    #[Route('/usuario', name: 'app_usuario')]
    public function index(): JsonResponse{
        return $this->json([
            'message' => 'Server status OK!',
            'path' => 'src/Controller/UsuarioController.php',
        ]);
    }

    #[Route('/busqueda', name: 'app_busqueda')]
    public function busquedaOrigenDestino(): JsonResponse{
        
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
        return $this->json($jsonContent);
        }
        else{
            return $this->json(["error" => "Búsqueda sin resultados"], 404);
        }  
    }

    #[Route('/origenDestino', name: 'app_origenDestino')]
    public function cuerpoOrigenDestino(Request $request): JsonResponse{
        //Recuperasmos los valores de la request
        $origen = $request->query->get('origen');
        $destino = $request->query->get('destino');
        
        //Declaramos los arrays que contendrán los DTOs
        $dtoLineas = [];
        $dtoSublineas = [];
        $dtoSubParHorarios = [];
        $dtoParHorarios = [];
        $dtoList = [];

        //Obtenemos de la BBDD los objetos parada Origen y Parada Destino y los incluimos en un array

        $origenDestinoList= [];
        $pOrigen = $this->em->getRepository(Parada::class)->find($origen);
        $pDestino = $this->em->getRepository(Parada::class)->find($destino);

        array_push($origenDestinoList, $pOrigen);
        array_push($origenDestinoList, $pDestino);

        //Recorremos array de sublineas que incluyen las paradas de Origen y/o Destino
        $sublineasBusqueda = $this->em->getRepository(Sublinea::class)->findSublineasByParadas($pOrigen, $pDestino);
        if($sublineasBusqueda){
            foreach($sublineasBusqueda as $sublineaBusqueda){
                //Generamos Dto con datos de Lineas
                $dtoLinea = ListLineasDto::of($sublineaBusqueda->getLinea()->getId(),
                                        $sublineaBusqueda->getLinea()->getNombre(),
                                        $sublineaBusqueda->getLinea()->getDescripcion(),
                                        $sublineaBusqueda->getLinea()->getEmpresa()->getNombre(),
                                        $sublineaBusqueda->getLinea()->getTipo());
                    array_push($dtoLineas,$dtoLinea);
                //Generamos Dto con Datos de Sublinea
                $dtoSublinea = SublineaDto::of($sublineaBusqueda->getId(),
                                        $sublineaBusqueda->getNombre());
    
                    array_push($dtoSublineas, $dtoSublinea);            
            }

        }else{
            return $this->json(["error" => "No se han encontrado Sublineas"], 404);
        }

        //Recorremos el array de Origen y Destino
        foreach($origenDestinoList as $origenDestino){
            //Guaradamos todos los horarios disponibles de las paradas para todas las lineas, sublinas y direcciones
            $horariosParada = $this->em->getRepository(Horario::class)->findHorariosByParada($origenDestino->getId());

            //Generamos el dto con Datos de las Paradas 
            $dtoParHorario = ParadaHorarioDto::of($origenDestino->getId(),
                                                $origenDestino->getNombre(),
                                                $origenDestino->getPoblacion()->getNombre(),
                                                $horariosParada);
                    
                    array_push($dtoParHorarios, $dtoParHorario);
            //Creamos una variable que almacena las direcciones y orden de las paradas        
            $ordenDires = $this->em->getRepository(SublineasParadasHorarios::class)->findDirOrdByParada($origenDestino->getId());
            
            //Generamos el dto con Datos de SublineasParadasHorarios, direccion y orden
            foreach($ordenDires as $ordenDire ){
                $dtoSubParHorario = SubParHorDto::of($ordenDire['orden'],
                                                $ordenDire['direccion'],
                                                $origenDestino->getId()
                                                );

                array_push($dtoSubParHorarios, $dtoSubParHorario);
            }   
        }
        //Generamos un nuevo dto que retorna un objeto compuesto por los dtos anteriores
        $dtoList = CuerpoOrigenDestinoDto::of($dtoLineas,
                                            $dtoSublineas,
                                            $dtoParHorarios,
                                            $dtoSubParHorarios);
        $transform_obj = new TransformDto();
        $jsonContent = $transform_obj->encoderDtoObject($dtoList);
        return $this->json($jsonContent);                                    
                            
    }

    #[Route('/lineas', name: 'app_lineas', methods: 'GET')]
    public function lineas(): JsonResponse {
        $lineas = $this->em->getRepository(Linea::class)->findAll();
        if($lineas){
            $dtoList = [];
            foreach($lineas as $linea){
                $dto = ListLineasDto::of($linea->getId(),
                                        $linea->getNombre(),
                                        $linea->getDescripcion(),
                                        $linea->getEmpresa()->getNombre(),
                                        $linea->getTipo());
                array_push($dtoList,$dto);                        
            }
            
            $transform_obj = new TransformDto();
            $jsonContent = $transform_obj->encoderDto($dtoList);
            return $this->json($jsonContent);
        }
        else{
            return $this->json(["error" => "Linea no encontrada"], 404);
        } 
    }

    #[Route('/lineadetalleca/{idLinea}', name: 'app_lineadetalle_ca', methods: 'GET')]
    public function lineaDetalleCabecera($idLinea): JsonResponse {
        $linea = $this->em->getRepository(Linea::class)->find($idLinea);
        if($idLinea && $idLinea != null && $linea){

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
                $logoEmpresa = $empresa->getLogo();
            
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
                    base64_encode($logoEmpresa .''),
                    $coordenadas);
 
            $transform_obj = new TransformDto();
            $jsonContent = $transform_obj->encoderDtoObject($dto);
            return $this->json($jsonContent);              
        }
        else{
            return $this->json(["error" => "Linea no encontrada"], 404);
        } 
    }

    #[Route('/lineadetallecu/{idLinea}/{idSubLinea}', name: 'app_lineadetalle_c', methods: 'GET')]
    public function lineaDetalleCuerpo(Request $request ,$idLinea, $idSubLinea): JsonResponse{
        $direccion = $request->query->get('direccion');
        $sublinea = $this->em->getRepository(Sublinea::class)->find($idSubLinea);
        $linea = $this->em->getRepository(Linea::class)->find($idLinea);
        if($idSubLinea != null && $idLinea != null && $idSubLinea && $linea){
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
                return $this->json($jsonContent);  
            }
            else{
                return $this->json(["error" => "Sublinea no encontrada"], 404);
            }                  
        }
        else{
            return $this->json(["error" => "Linea no encontrada"], 404);
        } 
    }

    #[Route('/paradahorario/{idSublinea}/{idParada}', name: 'app_parada_ho', methods: 'GET')]
    public function paradaHorario(Request $request,$idSublinea,$idParada): JsonResponse{
        $direccion= "";
        $direccionRequest = $request->query->get('direccion');
        $sublinea = $this->em->getRepository(Sublinea::class)->find($idSublinea);
        $direcciones = $this->em->getRepository(SublineasParadasHorarios::class)->findDireccionesBySublinea($sublinea->getId());

        if($direccionRequest){
            foreach($direcciones as $direccionBd){
                if($direccionBd['direccion'] == $direccionRequest){
                    $direccion = $direccionBd['direccion'];
                    break;
                }
            }
            if($direccion == ""){ return $this->json(["error" => "Direccion no válida"], 404);}
        } 
        else{
                return $this->json(["error" => "Direccion no válida"], 404);
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
                return $this->json($jsonContent);    
            }
            else{
                return $this->json(["error" => "Horario no encontrado"], 404);
            }           
        }
        else{
            return $this->json(["error" => "Parada no encontrada"], 404);
        } 
    }

    #[Route('/noticias', name: 'app_noticias', methods: 'GET')]
    public function noticias(): JsonResponse {
        $noticias = $this->em->getRepository(Noticia::class)->findAll();
        if($noticias){
            $dtoList = [];
            foreach($noticias as $noticia){
                $dto = NoticiaDto::of($noticia->getId(),
                                        $noticia->getNombre(),
                                        $noticia->getDescripcion(),
                                        $noticia->getCuerpo(),
                                        $noticia->getFecha());

                array_push($dtoList,$dto);                        
            }
            
            $transform_obj = new TransformDto();
            $jsonContent = $transform_obj->encoderDto($dtoList);
            return $this->json($jsonContent);
        }
        else{
            return $this->json(["error" => "No existen noticias"], 404);
        } 
    }

    #[Route('/incidencias', name: 'app_incidencias', methods: 'GET')]
    public function incidencias(): JsonResponse {
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
                return $this->json(["error" => "No existen Incidencias Activas"], 404);
            }

            $transform_obj = new TransformDto();
            $jsonContent = $transform_obj->encoderDto($dtoList);
            return $this->json($jsonContent);
        }
        else{
            return $this->json(["error" => "No existen Incidencias"], 404);
        } 
    }

    #[Route('/contacto', name: 'app_contacto', methods: 'GET')]
    public function contacto(): JsonResponse {
        $empresas = $this->em->getRepository(Empresa::class)->findAll();
        if($empresas){
            $dtoList = [];
            foreach($empresas as $empresa){
                $dto = EmpresaDto::of($empresa->getId(),
                                        $empresa->getNombre(),
                                        $empresa->getDireccion(),
                                        $empresa->getTelefono(),
                                        $empresa->getEmail(),
                                        $empresa->getWeb(),
                                        base64_encode($empresa->getLogo() . ''));
                array_push($dtoList,$dto);                        
            }
            
            $transform_obj = new TransformDto();
            $jsonContent = $transform_obj->encoderDto($dtoList);
            return $this->json($jsonContent);
        }
        else{
            return $this->json(["error" => "No existen empresas"], 404);
        } 
    }
}
