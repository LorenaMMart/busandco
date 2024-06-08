<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Parada;
use App\Entity\Empresa;

class UsuarioControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $cliente = static::createcliente();
        $cliente->request('GET', '/usuario/usuario');
        
        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            'message' => 'Server status OK!',
            'path' => 'src/Controller/UsuarioController.php',
        ]);
    }

    public function testBusquedaOrigenDestinoSuccess()
    {
        $cliente = static::createcliente();
        // Mock the repositories and expected return values
        $cliente->getContainer()->get('doctrine')->getRepository(Parada::class)->method('findAll')->willReturn([
            new Parada(1, 'Parada 1', '10.000', '10.000', 'Poblacion 1'),
            new Parada(2, 'Parada 2', '20.000', '20.000', 'Poblacion 2'),
        ]);
        $cliente->getContainer()->get('doctrine')->getRepository(Empresa::class)->method('findAll')->willReturn([
            new Empresa(1, 'Empresa 1'),
            new Empresa(2, 'Empresa 2'),
        ]);
        
        $cliente->request('GET', '/usuario/busqueda');
        
        $this->assertResponseIsSuccessful();
        $responseContent = $cliente->getResponse()->getContent();
        $responseData = json_decode($responseContent, true);
        
        $this->assertArrayHasKey('dtoListParada', $responseData);
        $this->assertArrayHasKey('dtoListEmpresa', $responseData);
    }

    public function testBusquedaOrigenDestinoFailure()
    {
        $cliente = static::createcliente();
        // Mock the repositories to return empty arrays
        $cliente->getContainer()->get('doctrine')->getRepository(Parada::class)->method('findAll')->willReturn([]);
        $cliente->getContainer()->get('doctrine')->getRepository(Empresa::class)->method('findAll')->willReturn([]);
        
        $cliente->request('GET', '/usuario/busqueda');
        
        $this->assertEquals(Response::HTTP_NOT_FOUND, $cliente->getResponse()->getStatusCode());
        $this->assertJsonContains(["error" => "Búsqueda sin resultados"]);
    }

    public function testCuerpoOrigenDestinoSuccess()
    {
        $cliente = static::createcliente();
        $cliente->request('GET', '/usuario/origenDestino', ['origen' => 1, 'destino' => 2]);

        $this->assertResponseIsSuccessful();
        $responseContent = $cliente->getResponse()->getContent();
        $responseData = json_decode($responseContent, true);

        $this->assertArrayHasKey('dtoLineas', $responseData);
        $this->assertArrayHasKey('dtoSublineas', $responseData);
        $this->assertArrayHasKey('dtoParHorarios', $responseData);
        $this->assertArrayHasKey('dtoSubParHorarios', $responseData);
    }

    public function testCuerpoOrigenDestinoFailure()
    {
        $cliente = static::createcliente();
        $cliente->request('GET', '/usuario/origenDestino', ['origen' => 999, 'destino' => 999]);

        $this->assertEquals(Response::HTTP_NOT_FOUND, $cliente->getResponse()->getStatusCode());
        $this->assertJsonContains(["error" => "No se han encontrado Sublineas"]);
    }

}

?>
