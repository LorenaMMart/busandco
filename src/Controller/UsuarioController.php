<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Linea;
use App\Dto\ListLineasDto;


#[Route('/api', name: 'api_')]
class UsuarioController extends AbstractController
{
   
    public function __construct()
    {
       
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
    public function lineas(EntityManagerInterface $em): JsonResponse {
        $lineas = $em->getRepository(Linea::class)->findAll();
        if($lineas){
            $dtoList = [];
            foreach($lineas as $linea){
                $dto = [
                        'id' => $linea->getId(),
                        'nombre' => $linea->getNombre(),
                        'descripcion' => $linea->getDescripcion(),
                        'empresa' => $linea->getEmpresa()->getNombre(),
                        'tipo' => $linea->getTipo(),
                        ];
                array_push($dtoList,$dto);                        
            }
            return new JsonResponse($dtoList, Response::HTTP_OK);
        }
        else{
            return $this->json(["error" => "Linea no encontrada"], 404);
        } 
    }

}
