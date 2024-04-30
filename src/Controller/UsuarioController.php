<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

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

    #[Route('/lineas', name: 'app_lineas', methods: 'POST')]
    public function lineas(): JsonResponse {
        return $this->json( [

        ]);
    }

    // public function listLineas(EntityManagerInterface $em){
    //     $lineas = $em->getRepository(Linea::class)->findAll();

    //     foreach($lineas as $linea){
    //         //recorrer lineas recuperar:
    //         //nombre linea
    //         //empresa por id de empresa
    //         //Direccion por id de sublinea

    //         //setear objeto

    //     }
    // }
}
