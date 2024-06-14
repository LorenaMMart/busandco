<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Service\AdminService;

#[Route('/api', name: 'api_')]
class AdminController extends AbstractController
{
    private $adminService;
    public function __construct(AdminService $admService)
    {
       $this->adminService = $admService;
    }

    #[Route('/admin', name: 'app_admin', methods: 'GET')]
    public function admin(): JsonResponse
    {
        return $this->json([
            'message' => 'La autenticación JWT ha sido exitosa. Bienvenido al area privada',
            'path' => 'src/Controller/AdminController.php',
        ]);
    }

    #[Route('/listado', name: 'app_listado', methods: 'GET')]
    public function listado(ManagerRegistry $mr) : JsonResponse
    {
        $result =$this->adminService->listado($mr);
        if(isset($result['error']))
            return $this->json(["error" => $result['error']], $result['code']);
        else
            return $this->json($result);

    }

    #[Route('/listadoEmpresas', name: 'app_listadoEmp', methods: 'GET')]
    public function listadoEmpresas(ManagerRegistry $mr) : JsonResponse
    {
        $result =$this->adminService->listadoEmpresas($mr);
        if(isset($result['error']))
            return $this->json(["error" => $result['error']], $result['code']);
        else
            return $this->json($result);
    }

    #[Route('/addlinea', name: 'app_addlinea', methods: 'POST')]
    public function addLinea(ManagerRegistry $mr, Request $request) : JsonResponse
    {
        try{
            $result =$this->adminService->addLinea($mr, $request);
            if(isset($result['error']))
                return $this->json(["error" => $result['error']], $result['code']);
            else
                return $this->json($result);
        }
        catch(\Exception $ex)
        {
            return $this->json('No se ha podido crear la línea', 500);
        }
    }

    #[Route('/verLinea/{id}', name: 'app_verLinea', methods: 'GET')]
    public function verLinea(ManagerRegistry $mr, $id) : JsonResponse
    {
        $result =$this->adminService->verLinea($mr, $id);
        if(isset($result['error']))
            return $this->json(["error" => $result['error']], $result['code']);
        else
            return $this->json($result);
    }

    #[Route('/editarLinea/{id}', name: 'app_editarLinea', methods: ['PUT' , 'PATCH'])]
    public function editarLinea(ManagerRegistry $mr, Request $request, $id) : JsonResponse
    {
        try{
            $result =$this->adminService->editarLinea($mr,$request,$id);
            if(isset($result['error']))
                return $this->json(["error" => $result['error']], $result['code']);
            else
                return $this->json($result);  
        }
        catch(\Exception $ex)
        {
            return $this->json($ex->getMessage(), 500);
        }
    }

    #[Route('/borrarLinea/{id}', name: 'app_borrarLinea', methods: ['PUT' , 'PATCH'])]
    public function borrarLinea(ManagerRegistry $mr, $id) : JsonResponse
    {
        $result =$this->adminService->borrarLinea($mr,$id);
        if(isset($result['error']))
            return $this->json(["error" => $result['error']], $result['code']);
        else
            return $this->json($result);
    }

    #[Route('/listadoBorradas', name: 'app_listadoBorradas', methods: 'GET')]
    public function listadoBorradas(ManagerRegistry $mr) : JsonResponse
    {
        $result =$this->adminService->listadoBorradas($mr);
        if(isset($result['error']))
            return $this->json(["error" => $result['error']], $result['code']);
        else
            return $this->json($result);
        
    }

    #[Route('/recuperarLinea/{id}', name: 'app_recuperarLinea', methods: ['PUT' , 'PATCH'])]
    public function recuperarLinea(ManagerRegistry $mr, $id) : JsonResponse
    {
        $result =$this->adminService->recuperarLinea($mr, $id);
        if(isset($result['error']))
            return $this->json(["error" => $result['error']], $result['code']);
        else
            return $this->json($result);
    }

}
?>