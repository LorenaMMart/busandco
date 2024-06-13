<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\UsuarioService as ServiceUsuarioService;

#[Route('/usuario', name: 'usuario_')]
class UsuarioController extends AbstractController
{

   private $usuarioService;
    public function __construct(ServiceUsuarioService $usuService)
    {
       $this->usuarioService = $usuService;
    }

    #[Route('/usuario', name: 'app_usuario', methods: 'GET')]
    public function index(): JsonResponse{
        $result = $this->usuarioService->index();
        return $this->json($result);
    }

    #[Route('/busqueda', name: 'app_busqueda', methods: 'GET')]
    public function busquedaOrigenDestino(): JsonResponse{

        $result =$this->usuarioService->busquedaOrigenDestino();
        if(isset($result['error']))
            return $this->json(["error" => $result['error']], $result['code']);
        else
            return $this->json($result);
    }

    #[Route('/origenDestino', name: 'app_origenDestino', methods: 'GET')]
    public function origenDestino(Request $request): JsonResponse{

        //Recuperasmos los valores de la request
        $origen = $request->query->get('origen');
        $destino = $request->query->get('destino');

        $result =$this->usuarioService->origenDestino($origen, $destino);
        if(isset($result['error']))
            return $this->json(["error" => $result['error']], $result['code']);
        else
            return $this->json($result);
                            
    }

    #[Route('/lineas', name: 'app_lineas', methods: 'GET')]
    public function lineas(): JsonResponse {
        $result =$this->usuarioService->lineas();
        if(isset($result['error']))
            return $this->json(["error" => $result['error']], $result['code']);
        else
            return $this->json($result);
    }

    #[Route('/lineadetalleca/{idLinea}', name: 'app_lineadetalle_ca', methods: 'GET')]
    public function lineaDetalleCabecera($idLinea): JsonResponse {
        
        $result =$this->usuarioService->lineaDetalleCabecera($idLinea);
        if(isset($result['error']))
            return $this->json(["error" => $result['error']], $result['code']);
        else
            return $this->json($result);
    }

    #[Route('/lineadetallecu/{idLinea}/{idSubLinea}', name: 'app_lineadetalle_c', methods: 'GET')]
    public function lineaDetalleCuerpo(Request $request ,$idLinea, $idSubLinea): JsonResponse{
        $direccion = $request->query->get('direccion');

        $result =$this->usuarioService->lineaDetalleCuerpo($direccion, $idLinea, $idSubLinea);
        if(isset($result['error']))
            return $this->json(["error" => $result['error']], $result['code']);
        else
            return $this->json($result);
    }

    #[Route('/paradahorario/{idSublinea}/{idParada}', name: 'app_parada_ho', methods: 'GET')]
    public function paradaHorario(Request $request,$idSublinea,$idParada): JsonResponse{
        
        $direccionRequest = $request->query->get('direccion');

        $result =$this->usuarioService->paradaHorario($direccionRequest, $idSublinea, $idParada);
        if(isset($result['error']))
            return $this->json(["error" => $result['error']], $result['code']);
        else
            return $this->json($result);
    }

    #[Route('/incidencias', name: 'app_incidencias', methods: 'GET')]
    public function incidencias(): JsonResponse {

        $result =$this->usuarioService->incidencias();
        if(isset($result['error']))
            return $this->json(["error" => $result['error']], $result['code']);
        else
            return $this->json($result);
    }

    #[Route('/contacto', name: 'app_contacto', methods: 'GET')]
    public function contacto(): JsonResponse {

        $result =$this->usuarioService->contacto();
        if(isset($result['error']))
            return $this->json(["error" => $result['error']], $result['code']);
        else
            return $this->json($result);
    }
}
?>