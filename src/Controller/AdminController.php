<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api', name: 'api_')]
class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin', methods: 'GET')]
    public function admin(): JsonResponse
    {
        return $this->json([
            'message' => 'La autenticación JWT ha sido exitosa. Bienvenido al area privada',
            'path' => 'src/Controller/AdminController.php',
        ]);
    }
}
