<?php

namespace App\Controller;

use App\Entity\Usuario;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistroApiController extends AbstractController
{
    #[Route('/registro/api', name: 'app_registro_api')]
    public function index(ManagerRegistry $doctrine, Request $request, UserPasswordHasherInterface $passwordHasher)
    {
        $em = $doctrine->getManager();
        $decoded = json_decode($request->getContent());
        $email = $decoded->email;
        $plaintextPassword = $decoded->password;

        $usuario = new Usuario();
        $hashedPassword = $passwordHasher->hashPassword(
            $usuario,
            $plaintextPassword
        );
        $usuario->setPassword($hashedPassword);
        $usuario->setEmail($email);
        $usuario->setUsername($email);
        $em->persist($usuario);
        $em->flush();

        return $this->json(['mensaje' => 'Registro realizado con éxito']);
    }
}
?>
