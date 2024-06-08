<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Linea;
use App\Entity\Sublinea;
use App\Entity\Empresa;


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

    #[Route('/listado', name: 'app_listado', methods: 'GET')]
    public function listado(ManagerRegistry $mr) : JsonResponse
    {
        $lineas =  $mr->getRepository(Linea::class)->findAll();
        $empresas =  $mr->getRepository(Empresa::class)->findAll();

        $data = [];
        foreach($lineas as $linea){
            if($linea->isActiva()){
                $sublineas = $linea->getSublineas();
                $data[] = [
                    'id'    => $linea->getId(),
                    'nombre' => $linea->getNombre(),
                    'descripion' => $linea->getDescripcion(),
                    'empresa' => $linea->getEmpresa()->getNombre(),
                    'sublineas' => $sublineas,
                    'tipo' => $linea->getTipo()
                ];
            }
        }
        if(count($data) != 0)
        {
            return $this->json($data);
        }
        else{
            return $this->json(["error" => "No se han encontrado lineas"], 404);
        }
    }

    #[Route('/addlinea', name: 'app_addlinea', methods: 'POST')]
    public function addlinea(ManagerRegistry $mr, Request $request) : JsonResponse
    {
        try{
            if(isset($request)) 
            {
                $entityManager = $mr->getManager();
                $linea = new Linea();
                $parameter = json_decode($request->getContent(), true);
                $linea->setNombre($parameter['nombre']);
                $linea->setDescripcion($parameter['descripcion']);
                //Lo que espera recibir es un Objeto empresa
                $empresa = $mr->getRepository(Empresa::class)->find($parameter['empresa']);
                $linea->setEmpresa($empresa);
                //Lo que espera recibir es una Coleccion de objetos Sublinea
                $sublinea = $mr->getRepository(Sublinea::class)->find($parameter['sublinea']);
                $linea->addSublinea($sublinea);
                $linea->setTipo($parameter['tipo']);
                $entityManager->persist($linea);
                $entityManager->flush();

                return $this->json('Una nueva linea ha sido creada satisfactoriamente con id ' . $linea->getId());
            }
            else{
                return $this->json('Algo ha ido mal', 404);
            }
        }
        catch(\Exception $ex)
        {
            return $this->json('No se ha podido crear la línea', 500);
        }
    }

    #[Route('/verLinea/{id}', name: 'app_verLinea', methods: 'GET')]
    public function verLinea(ManagerRegistry $mr, $id) : JsonResponse
    {
       $linea = $mr->getRepository(Linea::class)->find($id);
       if(!$linea || $linea->isActiva() == false){
            return $this->json('No se ha encontrado la linea con id' . $id, 404);
       }else{
            $data = [
                'id' => $linea->getId(),
                'nombre' => $linea->getNombre(),
                'descripcion' => $linea->getDescripcion(),
                'empresa' =>$linea->getEmpresa()->getNombre(),
                'tipo' =>$linea->getTipo()
            ];
            return $this->json($data);
        }
    }

    #[Route('/editarLinea/{id}', name: 'app_editarLinea', methods: ['PUT' , 'PATCH'])]
    public function editarLinea(ManagerRegistry $mr, Request $request, $id) : JsonResponse
    {
        try{
            $entityManager = $mr->getManager();
            $linea = $entityManager->getRepository(Linea::class)->find($id);

            if(!$linea || $linea->isActiva() == false){
                return $this->json('No se ha encontrado la linea con id' . $id, 404);
            }
            else
            {
                $parameter = json_decode($request->getContent(), true);
                $linea->setNombre($parameter['nombre']);
                $linea->setDescripcion($parameter['descripcion']);

                $empresa = $mr->getRepository(Empresa::class)->find($parameter['empresa']);
                $linea->setEmpresa($empresa);
                //Lo que espera recibir es una Coleccion de objetos Sublinea
                $sublinea = $mr->getRepository(Sublinea::class)->find($parameter['sublinea']);
                $linea->addSublinea($sublinea);
                $linea->setTipo($parameter['tipo']);
                $entityManager->flush();
                $data = [
                    'id'    => $linea->getId(),
                    'linea' => $linea->getNombre(),
                    'descripion' => $linea->getDescripcion(),
                    'empresa' => $linea->getEmpresa(),
                    'sublineas' => $linea->getSublineas(),
                    'tipo' => $linea->getTipo(),
                    'activa' => $linea->isActiva()
                ];
                return $this->json($data);
            }
        }
        catch(\Exception $ex)
        {
            return $this->json($ex->getMessage(), 500);
        }
    }

    #[Route('/borrarLinea/{id}', name: 'app_borrarLinea', methods: ['PUT' , 'PATCH'])]
    public function borrarLinea(ManagerRegistry $mr, $id) : JsonResponse
    {
       $entityManager = $mr->getManager(); 
       $linea = $entityManager->getRepository(Linea::class)->find($id);

       if(!$linea || $linea->isActiva() == false){
            return $this->json('No se ha encontrado la linea con id' . $id, 404);
       }else{
            $linea->setActiva(false);
            $entityManager->persist($linea);
            $entityManager->flush();
            return $this->json('La linea con id ' . $linea->getId() . " ha sido borrada");
        }
    }

    #[Route('/listadoBorradas', name: 'app_listadoBorradas', methods: 'GET')]
    public function listadoBorradas(ManagerRegistry $mr) : JsonResponse
    {
        $lineas = $mr->getRepository(Linea::class)->findAll();
        $empresas = $mr->getRepository(Empresa::class)->findAll();
    
        $data = [];
        foreach($lineas as $linea){
            if($linea->isActiva() == false){
                $data[] = [
                    'id'    => $linea->getId(),
                    'linea' => $linea->getNombre(),
                    'descripion' => $linea->getDescripcion(),
                    'empresa' => $linea->getEmpresa()->getNombre(),
                    'sublineas' => $linea->getSublineas(),
                    'tipo' => $linea->getTipo(),
                    'empresas' => $empresas
                ];
            }
        }
        if(count($data) != 0)
            return $this->json($data);
        else{
            return $this->json(["error" => "No se han encontrado lineas borradas"], 404);
        }
        
    }

    #[Route('/recuperarLinea/{id}', name: 'app_recuperarLinea', methods: ['PUT' , 'PATCH'])]
    public function recuperarLinea(ManagerRegistry $mr, $id) : JsonResponse
    {
       $entityManager = $mr->getManager(); 
       $linea = $entityManager->getRepository(Linea::class)->find($id);

       if(!$linea || $linea->isActiva() == true){
            return $this->json('No se ha encontrado la linea borrada con id' . $id, 404);
       }else{
            $linea->setActiva(true);
            $entityManager->persist($linea);
            $entityManager->flush();
            return $this->json('La linea con id ' . $linea->getId() . " ha sido recuperada");
        }
    }




}
