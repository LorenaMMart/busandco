<?php

namespace App\Controller;

use App\Dto\CuerpoLineaDetalleDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;



use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Linea;
use App\Dto\ListLineasDto;
use App\Dto\SublineaDto;
use App\Dto\CabeceraLineaDto;
use App\Entity\Sublinea;
use App\Entity\Parada;
use App\Entity\SublineasParadasHorarios;
use App\Entity\Coordenadas;
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
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UsuarioController.php',
        ]);
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

    #[Route('/lineadetalleca/{idLinea}/{idSublinea}', name: 'app_lineadetalle_ca', methods: 'GET')]
    public function lineaDetalleCabecera($idLinea, $idSublinea): JsonResponse {
        if($idLinea != null){

            $dtoSubline = [];

            $linea = $this->em->getRepository(Linea::class)->find($idLinea);
                $nombreLinea = $linea->getNombre();
                $descripcionLinea = $linea->getDescripcion();

            $sublineas = $linea->getSublineas();
                foreach($sublineas as $sublinea){
                    $dtoL = SublineaDto::of($sublinea->getId(),
                    $sublinea->getNombre());

                    array_push($dtoSubline, $dtoL);
                }

            $empresa = $linea->getEmpresa();
                $nombreEmpresa = $empresa->getNombre();
                $logoEmpresa = $empresa->getLogo(); 

            //$subLineaParadaHora = $this->em->getRepository(SublineasParadasHorarios::class)->find($idLinea);
            $direccion = $this->em->getRepository(SublineasParadasHorarios::class)->findDireccionIdaBySublinea($idSublinea, $descripcionLinea);
                
            $coordenadas = $this->em->getRepository(Coordenadas::class)->findCoordenadasBySublinea($idSublinea); 
            
                $dto = CabeceraLineaDto::of(
                    $idLinea,
                    $nombreLinea,
                    $dtoSubline,
                    $direccion,
                    $nombreEmpresa,
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
        if($idSubLinea != null && $idLinea != null){
            $dtoList = [];
            $sublinea = $this->em->getRepository(Sublinea::class)->find($idSubLinea);
            if($sublinea){
                $paradas =  $this->em->getRepository(Parada::class)->findParadasBySublinea($idSubLinea,$direccion);
                foreach($paradas as $parada){
                    $linea = $this->em->getRepository(Linea::class)->findLineasByParada($idLinea, $parada->getId());
                    $dto = CuerpoLineaDetalleDto::of($parada->getPoblacion()->getNombre(),
                                        $parada->getNombre(),
                                        $linea);
                    array_push($dtoList,$dto);                
                    }
                }
        $transform_obj = new TransformDto();
        $jsonContent = $transform_obj->encoderDto($dtoList);
        return $this->json($jsonContent);              
        }
        else{
            return $this->json(["error" => "Linea no encontrada"], 404);
        } 
    }

    #[Route('/paradahorario/{idParada}', name: 'app_parada_ho', methods: 'GET')]
    public function paradaHorario($idParada): JsonResponse{
        if($idParada != null){
            $dtoList = [];
                
        $transform_obj = new TransformDto();
        $jsonContent = $transform_obj->encoderDto($dtoList);
        return $this->json($jsonContent);              
        }
        else{
            return $this->json(["error" => "Linea no encontrada"], 404);
        } 
    }



    


}
