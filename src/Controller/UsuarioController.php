<?php

namespace App\Controller;

use App\Dto\BusquedaOrigenDestinoDto;
use App\Dto\CuerpoLineaDetalleDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;



use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Linea;
use App\Dto\ListLineasDto;
use App\Dto\CabeceraLineaDto;
use App\Dto\ParadaHorarioDto;
use App\Dto\SublineaDto;
use App\Dto\ParadaDto;
use App\Dto\EmpresaDto;
use App\Entity\Sublinea;
use App\Entity\Parada;
use App\Entity\SublineasParadasHorarios;
use App\Entity\Coordenadas;
use App\Entity\Horario;
use App\Entity\Empresa;
use App\Utils\TransformDto;



#[Route('/api', name: 'api_')]
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
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UsuarioController.php',
        ]);
    }

    #[Route('/busquedarusuario', name: 'app_busqueda_usuario')]
    public function busquedaOrigenDestino(): JsonResponse{
        
        $paradas = $this->em->getRepository(Parada::class)->findAll();
        $empresas = $this->em->getRepository(Empresa::class)->findAll();
        if($paradas && $empresas){
            $dtoListParada = [];
            $dtoListEmpresa = [];
            foreach($paradas as $parada){

                $dtoParada = ParadaDto::of($parada->getId(),$parada->getNombre(), $parada->getLatitud(), $parada->getLongitud());
                array_push($dtoListParada, $dtoParada);
            }
            foreach($empresas as $empresa){
                $dtoEmpresa = EmpresaDto::of($empresa->getId(), $empresa->getNombre());
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
            $horarioTipo = $this->em->getRepository(Horario::class)->findHorariosByParada($sublinea->getId(),$parada->getId(), $direccion);
            if($horarioTipo){
                $dtoP = ParadaHorarioDto::of($parada->getId(),
                                        $parada->getNombre(),
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

    





    


}
