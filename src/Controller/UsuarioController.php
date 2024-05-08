<?php

namespace App\Controller;

use App\Dto\CuerpoLineaDetalleDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;



use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Linea;
use App\Dto\ListLineasDto;
use App\Entity\Sublinea;
use App\Entity\Parada;
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
                $dto = ListLineasDto::of($linea->getNombre(),
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

    #[Route('/lineadetallec/{idLinea}/{idSubLinea}', name: 'app_lineadetalle_c', methods: 'GET')]
    public function lineaDetalleCuerpo($idLinea, $idSubLinea, $direccion): JsonResponse {
        if($idSubLinea != null && $idLinea != null){
            $dtoList = [];
            $sublinea = $this->em->getRepository(Sublinea::class)->find($idSubLinea);
            if($sublinea){
                $paradas =  $this->em->getRepository(Parada::class)->findParadasBySublinea($idSubLinea, $direccion);
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

    


}
