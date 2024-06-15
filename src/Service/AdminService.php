<?php
namespace App\Service;


use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Linea;
use App\Entity\Sublinea;
use App\Entity\Empresa;


class AdminService{

    public function admin(): array
    {
        return [
            'message' => 'La autenticación JWT ha sido exitosa. Bienvenido al area privada',
            'path' => 'src/Controller/AdminController.php',
        ];
    }

    public function listado(ManagerRegistry $mr) : array
    {
        $lineas =  $mr->getRepository(Linea::class)->findAll();

        $data = [];
        foreach($lineas as $linea){
            if($linea->isActiva()){
                $sublineas = $linea->getSublineas();
                $data[] = [
                    'id'    => $linea->getId(),
                    'linea' => $linea->getNombre(),
                    'descripion' => $linea->getDescripcion(),
                    'empresa' => $linea->getEmpresa()->getNombre(),
                    'sublineas' => $sublineas,
                    'tipo' => $linea->getTipo()
                ];
            }
        }
        if(count($data) != 0)
        {
            return [$data];
        }
        else{
            return ["error" => "No se han encontrado lineas", "code"=>404];
        }
    }

    public function listadoEmpresas(ManagerRegistry $mr) : array
    {
        $empresas =  $mr->getRepository(Empresa::class)->findAll();

        $data = [];
        foreach($empresas as $empresa){
            $data[] = [
                'id'    => $empresa->getId(),
                'empresa' => $empresa->getNombre(),
                'direccion' => $empresa->getDireccion(),
                'telefono' => $empresa->getTelefono(),
                'email' => $empresa->getEmail(),
                'web' => $empresa->getWeb()
            ];
            
        }
        if(count($data) != 0)
        {
            return [$data];
        }
        else{
            return ["error" => "No se han encontrado empresas", "code"=>404];
        }
    }

    public function addLinea(ManagerRegistry $mr, $request) : array
    {
        if(isset($request)) 
        {
            $entityManager = $mr->getManager();
            $linea = new Linea();
            $parameter = json_decode($request->getContent(), true);
            $linea->setNombre($parameter['linea']);
            $linea->setDescripcion($parameter['descripcion']);
            //Lo que espera recibir es un Objeto empresa
            $empresa = $mr->getRepository(Empresa::class)->find($parameter['empresa']);
            $linea->setEmpresa($empresa);
            //Lo que espera recibir es una Coleccion de objetos Sublinea
            $sublineasN = explode(",", $parameter['sublinea']);
            foreach($sublineasN as $sublineaN){
                $sublinea = new Sublinea();
                $sublinea->setNombre($sublineaN);
                $linea->addSublinea($sublinea);
            }
            $linea->setTipo($parameter['tipo']);
            $entityManager->persist($linea);
            $entityManager->flush();

            return ["mensaje" => "Una nueva linea ha sido creada satisfactoriamente con id " . $linea->getId()];
        }
        else{
            return ["error" => "Algo ha ido mal", "code"=>400];
           
        }
    }       
        
    public function verLinea(ManagerRegistry $mr, $id) : array
    {
       $linea = $mr->getRepository(Linea::class)->find($id);
       if(!$linea || $linea->isActiva() == false){
            return ["error" => 'No se ha encontrado la linea con id ' . $id, "code"=>400];
       }else{
            $data = [
                'id' => $linea->getId(),
                'linea' => $linea->getNombre(),
                'descripcion' => $linea->getDescripcion(),
                'empresa' =>$linea->getEmpresa()->getNombre(),
                'tipo' =>$linea->getTipo()
            ];
            return [$data];
        }
    }
    
    public function editarLinea(ManagerRegistry $mr, $request, $id) : array
    {
      
        $entityManager = $mr->getManager();
        $linea = $entityManager->getRepository(Linea::class)->find($id);
        
        if(!$linea || $linea->isActiva() == false){
            return ["error" => 'No se ha encontrado la linea con id ' . $id, "code"=>404];
        }
        else
        {
            $parameter = json_decode($request->getContent(), true);
            $linea->setNombre($parameter['linea']);
            $linea->setDescripcion($parameter['descripcion']);
            $empresa = $mr->getRepository(Empresa::class)->find($parameter['empresa']);
            $linea->setEmpresa($empresa);
            
            $linea->setTipo($parameter['tipo']);
            $entityManager->flush();
            $data = [
                'id'    => $linea->getId(),
                'linea' => $linea->getNombre(),
                'descripcion' => $linea->getDescripcion(),
                'empresa' => $linea->getEmpresa(),
                'tipo' => $linea->getTipo(),
                'activa' => $linea->isActiva()
            ];
            return [$data];
        }
    }
    
    public function borrarLinea(ManagerRegistry $mr, $id) : array
    {
       $entityManager = $mr->getManager(); 
       $linea = $entityManager->getRepository(Linea::class)->find($id);

       if(!$linea || $linea->isActiva() == false){
            return ["error" => 'No se ha encontrado la linea con id ' . $id, "code"=>404];
       }else{
            $linea->setActiva(false);
            $entityManager->persist($linea);
            $entityManager->flush();
            return ["mensaje" => "La linea con id " . $linea->getId() . " ha sido borrada"];
        }
    }

    public function listadoBorradas(ManagerRegistry $mr) : array
    {
        $lineas = $mr->getRepository(Linea::class)->findAll();
            
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
                ];
            }
        }
        if(count($data) != 0)
            return [$data];
        else{
            return ["error" => 'No se han encontrado lineas borradas ', "code"=>404];
        }
    }
    
    public function recuperarLinea(ManagerRegistry $mr, $id) : array
    {
       $entityManager = $mr->getManager(); 
       $linea = $entityManager->getRepository(Linea::class)->find($id);

       if(!$linea || $linea->isActiva() == true){
        return ["error" => 'No se ha encontrado la linea con id ' . $id, "code"=>404];
       }else{
            $linea->setActiva(true);
            $entityManager->persist($linea);
            $entityManager->flush();
            return ["mensaje" => "La linea con id " . $linea->getId() . " ha sido recuperada"];
        }
    }
      
}

?>