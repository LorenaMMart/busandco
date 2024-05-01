<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Linea;
use App\Dto\ListLineasDto;
use App\Seriazable\SerializableCollection;
use App\Seriazable\SerializableObject;

#[Route('/api', name: 'api_')]
class UsuarioController extends AbstractController
{
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
            $dtoList = array();
            foreach($lineas as $linea){
                $dto = ListLineasDto::of($linea->getNombre(),
                                        $linea->getDescripcion(),
                                        $linea->getEmpresa()->getNombre(),
                                        $linea->getTipo());
                array_push($dtoList,new SerializableObject($dto));                        
            }
            // $jsonR = $this->jsonResponse($dtoList);
            return $this->json($dtoList);
        }
        else{
            return $this->json(["error" => "Linea no encontrada"], 404);
        } 
    }

}
