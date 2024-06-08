<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
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
        $lineas = $mr->getRepository(Linea::class)->findAll();
        $empresas = $mr->getRepository(Empresa::class)->findAll();
    
        $data = [];
        foreach($lineas as $linea){
            if($linea->isActiva()){
                $data[] = [
                    'id'    => $linea->getId(),
                    'linea' => $linea->getNombre(),
                    'descripion' => $linea->getDescripcion(),
                    'empresa' => $linea->getEmpresa(),
                    'sublineas' => $linea->getSublineas(),
                    'tipo' => $linea->getTipo(),
                    'empresas' => $empresas
                ];
            }
        }
        if(count($data) != 0)
            return $this->json($data);
        else{
            return $this->json(["error" => "No se han encontrado lineas"], 404);
        }
    }

    #[Route('/addlinea', name: 'app_addlinea', methods: 'POST')]
    public function addlinea(ManagerRegistry $mr, Request $request) : JsonResponse
    {
       $entityManager = $mr->getManager();
       $linea = new Linea();
       $linea->setNombre($request->request->get('linea'));
       $linea->setDescripcion($request->request->get('descripcion'));
       //Lo que espera recibir es un Objeto empresa
       $empresa = $mr->getRepository(Empresa::class)->find($request->request->get('empresa'));
       $linea->setEmpresa($empresa);
       //Lo que espera recibir es una Coleccion de objetos Sublinea
       $sublinea = new Sublinea();
       $sublinea->setNombre($request->request->get('sublinea'));
       $linea->addSublinea($sublinea);
       $linea->setTipo($request->request->get('tipo'));
       $entityManager->persist($linea);
       $entityManager->flush();

       return $this->json('Una nueva linea ha sido creada satisfactoriamente con id ' . $linea->getId());
       
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
                'linea' => $linea->getNombre(),
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
       $entityManager = $mr->getManager();
       $linea = $entityManager->getRepository(Linea::class)->find($id);
       if(!$linea || $linea->isActiva() == false){
            return $this->json('No se ha encontrado la linea con id' . $id, 404);
       }else{
            $content = json_decode($request->getContent());
            $linea->setNombre($content->nombre);
            $linea->setDescripcion($content->descripcion);

            $empresa = $mr->getRepository(Empresa::class)->find($content->empresa->getId());
            $linea->setEmpresa($empresa);
            //Lo que espera recibir es una Coleccion de objetos Sublinea
            $sublinea = new Sublinea();
            $sublinea->setNombre($content->sublinea->getNombre());
            $linea->addSublinea($sublinea);
            $linea->setTipo($content->tipo);
            $entityManager->flush();
            $data = [
                'id'    => $linea->getId(),
                    'linea' => $linea->getNombre(),
                    'descripion' => $linea->getDescripcion(),
                    'empresa' => $linea->getEmpresa(),
                    'sublineas' => $linea->getSublineas(),
                    'tipo' => $linea->getTipo()
            ];
            return $this->json($data);
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
                    'empresa' => $linea->getEmpresa(),
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
