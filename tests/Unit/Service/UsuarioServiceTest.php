<?php

declare (strict_types=1);

namespace App\Tests\Unit\Service;
use Symfony\Component\HttpFoundation\Request;

use PHPUnit\Framework\TestCase;
use App\Service\UsuarioService;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Parada;
use App\Entity\Empresa;
use App\Entity\Sublinea;
use App\Entity\Linea;
use App\Entity\SublineasParadasHorarios;
use App\Entity\Horario;
use App\Entity\Poblacion;
use App\Repository\EmpresaRepository;
use App\Repository\HorarioRepository;
use App\Repository\ParadaRepository;
use App\Repository\SublineaRepository;
use App\Repository\SublineasParadasHorariosRepository;
use DateTime;

class UsuarioServiceTest extends TestCase
{
    public function testBusquedaOrigenDestinoSuccess()
    {
    
        $entityManagerMock = $this->createMock(EntityManagerInterface::class);

        $paradaRepositoryMock = $this->getMockBuilder(ParadaRepository::class)->disableOriginalConstructor()->getMock();
        $empresaRepositoryMock = $this->getMockBuilder(EmpresaRepository::class)->disableOriginalConstructor()->getMock();
        $poblacion = new Poblacion();
        $poblacion->setNombre('La Alberca');

        // Paradas
        $parada1 = $this->createMock(Parada::class);
        $parada1->method('getId')->willReturn(1);
        $parada1->method('getNombre')->willReturn('Vistabella');
        $parada1->method('getLatitud')->willReturn(37.93845205870166);
        $parada1->method('getLongitud')->willReturn(-1.1439575858259798);
        $parada1->method('getPoblacion')->willReturn($poblacion);

        $poblacion->setNombre('Santo Angel');
        $parada2 = $this->createMock(Parada::class);
        $parada2->method('getId')->willReturn(2);
        $parada2->method('getNombre')->willReturn('El Charco');
        $parada2->method('getLatitud')->willReturn(37.94215009569323);
        $parada2->method('getLongitud')->willReturn(-1.1323881552750608);
        $parada2->method('getPoblacion')->willReturn($poblacion);

        $paradaRepositoryMock->expects($this->once())
            ->method('findAll')
            ->willReturn([$parada1, $parada2]);

        //Empresas
        $empresa1 = $this->createMock(Empresa::class);
        $empresa1->method('getId')->willReturn(1);
        $empresa1->method('getNombre')->willReturn('TmpMurcia');

        $empresa2 = $this->createMock(Empresa::class);
        $empresa2->method('getId')->willReturn(2);
        $empresa2->method('getNombre')->willReturn('Transportes de Murcia');

        $empresaRepositoryMock->expects($this->once())
            ->method('findAll')
            ->willReturn([$empresa1, $empresa2]);

        // Configurar el EntityManager para devolver los repositorios mockeados
        $entityManagerMock->expects($this->exactly(2))
            ->method('getRepository')
            ->willReturnMap([
                [Parada::class, $paradaRepositoryMock],
                [Empresa::class, $empresaRepositoryMock],
            ]);

        $usuarioService = new UsuarioService($entityManagerMock);

        // Llamar al método y verificar el resultado
        $result = $usuarioService->busquedaOrigenDestino();
        
        //Verificar los resultados
        $this->assertIsArray($result);   
        $this->assertCount(1, $result);
    }

    public function testBusquedaOrigenDestinoFailure()
    {
       
        $entityManagerMock = $this->createMock(EntityManagerInterface::class);

        $paradaRepositoryMock = $this->getMockBuilder(ParadaRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $empresaRepositoryMock = $this->getMockBuilder(EmpresaRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $paradaRepositoryMock->expects($this->once())
            ->method('findAll')
            ->willReturn([]);

        $empresaRepositoryMock->expects($this->once())
            ->method('findAll')
            ->willReturn([]);

        $entityManagerMock->expects($this->exactly(2))
            ->method('getRepository')
            ->willReturnMap([
                [Parada::class, $paradaRepositoryMock],
                [Empresa::class, $empresaRepositoryMock],
            ]);

        $usuarioService = new UsuarioService($entityManagerMock);

        $result = $usuarioService->busquedaOrigenDestino();

        // Verificar el mensaje de error y el código
        $this->assertIsArray($result);
        $this->assertEquals('Búsqueda sin resultados', $result['error']);
        $this->assertEquals(404, $result['code']);
    }

    public function testOrigenDestinoSuccess()
    {
   
        $entityManagerMock = $this->createMock(EntityManagerInterface::class);
        $poblacion = new Poblacion();
        $poblacion->setNombre('La Alberca');


        $paradaOrigen = $this->createMock(Parada::class);
        $paradaOrigen->method('getId')->willReturn(1);
        $paradaOrigen->method('getNombre')->willReturn('Vistabella');
        $paradaOrigen->method('getPoblacion')->willReturn($poblacion);

        $poblacion->setNombre('Murcia');
        $paradaDestino = $this->createMock(Parada::class);
        $paradaDestino->method('getId')->willReturn(5);
        $paradaDestino->method('getNombre')->willReturn('Glorieta de España');
        $paradaDestino->method('getPoblacion')->willReturn($poblacion);

        // Crear mock de Empresa
        $empresa = $this->createMock(Empresa::class);
        $empresa->method('getId')->willReturn(1);
        $empresa->method('getNombre')->willReturn('TmpMurcia');

        // Crear mock de Linea
        $linea = $this->createMock(Linea::class);
        $linea->method('getId')->willReturn(1);
        $linea->method('getNombre')->willReturn('L6');
        $linea->method('getEmpresa')->willReturn($empresa);

        //Crear mock de Sublinea
        $sublinea = $this->createMock(Sublinea::class);
        $sublinea->method('getId')->willReturn(1);
        $sublinea->method('getLinea')->willReturn($linea);
        $sublinea->method('getNombre')->willReturn('A');

        // Crear mocks de los repositorios
        $paradaRepositoryMock = $this->getMockBuilder(ParadaRepository::class)->disableOriginalConstructor()->getMock();
        $sublineaRepositoryMock = $this->getMockBuilder(SublineaRepository::class)->disableOriginalConstructor()->getMock();
        $sublineasParadasHorariosRepositoryMock = $this->getMockBuilder(SublineasParadasHorariosRepository::class)->disableOriginalConstructor()->getMock();
        $horarioRepositoryMock = $this->getMockBuilder(HorarioRepository::class)->disableOriginalConstructor()->getMock();

        // Configurar los repositorios para devolver valores mockeados
        $paradaRepositoryMock->expects($this->exactly(2))->method('find')->willReturnOnConsecutiveCalls($paradaOrigen, $paradaDestino);

        $sublineaRepositoryMock->expects($this->once())->method('findSublineasByParadas')->with($paradaOrigen, $paradaDestino)->willReturn([$sublinea]);

        $direcciones =[['direccion' => 'La Alberca-Murcia']];
        $sublineasParadasHorariosRepositoryMock->expects($this->once())->method('findDireccionesBySublinea')->with($sublinea->getId())->willReturn($direcciones);

        $paradaRepositoryMock->expects($this->once())->method('findParadasByDireccionSublinea')->with('La Alberca-Murcia')->willReturn([$paradaOrigen]);

        $horarioRepositoryMock->expects($this->once())
            ->method('findHorariosByParadaSublineaDireccion')
            ->with($sublinea->getId(), $paradaOrigen->getId(), $direcciones[0])
            ->willReturn([['hora' => new DateTime('2000-01-01 08:00:00')], ['hora' =>new DateTime('2000-01-01 12:00:00')]]);

        $sublineasParadasHorariosRepositoryMock->expects($this->once())
            ->method('findOrdenByParadaDireccion')
            ->with($paradaOrigen->getId(), 'La Alberca-Murcia')
            ->willReturn([['orden' => 1]]);

        // Configurar el EntityManager para devolver los repositorios mockeados
        $entityManagerMock->expects($this->exactly(7))
            ->method('getRepository')
            ->willReturnMap([
                [Parada::class, $paradaRepositoryMock],
                [Sublinea::class, $sublineaRepositoryMock],
                [SublineasParadasHorarios::class, $sublineasParadasHorariosRepositoryMock],
                [Horario::class, $horarioRepositoryMock],
            ]);

        // Instanciar el servicio con el EntityManager mockeado
        $usuarioService = new UsuarioService($entityManagerMock);

        // Llamar al método y verificar el resultado
        $result = $usuarioService->origenDestino(1, 5);

        $this->assertIsArray($result);
        $this->assertCount(1, $result);
    }

  
}

?>