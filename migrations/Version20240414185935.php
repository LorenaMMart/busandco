<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240414185935 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE horario (id INT AUTO_INCREMENT NOT NULL, hora TIME NOT NULL, tipo VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incidencia (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(50) NOT NULL, descripcion VARCHAR(255) NOT NULL, fecha DATETIME NOT NULL, estado TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incidencias_sublineas (id INT AUTO_INCREMENT NOT NULL, indicencia_id INT NOT NULL, sublinea_id INT NOT NULL, INDEX IDX_8A0D8A64AC3A23A8 (indicencia_id), INDEX IDX_8A0D8A648E6EC471 (sublinea_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE linea (id INT AUTO_INCREMENT NOT NULL, empresa_id INT NOT NULL, nombre VARCHAR(50) NOT NULL, descripcion VARCHAR(100) NOT NULL, INDEX IDX_BCB8FDDE521E1991 (empresa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parada (id INT AUTO_INCREMENT NOT NULL, poblacion_id INT NOT NULL, nombre VARCHAR(50) NOT NULL, latitud DOUBLE PRECISION NOT NULL, longitud DOUBLE PRECISION NOT NULL, INDEX IDX_ADB5C4F2238957D9 (poblacion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poblacion (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recorrido (id INT AUTO_INCREMENT NOT NULL, sublinea_id INT NOT NULL, latitud DOUBLE PRECISION NOT NULL, longitud DOUBLE PRECISION NOT NULL, orden INT NOT NULL, UNIQUE INDEX UNIQ_3A1543A88E6EC471 (sublinea_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sublinea (id INT AUTO_INCREMENT NOT NULL, linea_id INT NOT NULL, nombre VARCHAR(50) NOT NULL, INDEX IDX_C60B120485FE79F8 (linea_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sublineas_paradas_horarios (id INT AUTO_INCREMENT NOT NULL, sublinea_id INT NOT NULL, horario_id INT NOT NULL, parada_id INT NOT NULL, orden INT NOT NULL, direccion VARCHAR(50) NOT NULL, INDEX IDX_3BB5AEFF8E6EC471 (sublinea_id), INDEX IDX_3BB5AEFF4959F1BA (horario_id), INDEX IDX_3BB5AEFFC49C376A (parada_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE incidencias_sublineas ADD CONSTRAINT FK_8A0D8A64AC3A23A8 FOREIGN KEY (indicencia_id) REFERENCES incidencia (id)');
        $this->addSql('ALTER TABLE incidencias_sublineas ADD CONSTRAINT FK_8A0D8A648E6EC471 FOREIGN KEY (sublinea_id) REFERENCES sublinea (id)');
        $this->addSql('ALTER TABLE linea ADD CONSTRAINT FK_BCB8FDDE521E1991 FOREIGN KEY (empresa_id) REFERENCES empresa (id)');
        $this->addSql('ALTER TABLE parada ADD CONSTRAINT FK_ADB5C4F2238957D9 FOREIGN KEY (poblacion_id) REFERENCES poblacion (id)');
        $this->addSql('ALTER TABLE recorrido ADD CONSTRAINT FK_3A1543A88E6EC471 FOREIGN KEY (sublinea_id) REFERENCES sublinea (id)');
        $this->addSql('ALTER TABLE sublinea ADD CONSTRAINT FK_C60B120485FE79F8 FOREIGN KEY (linea_id) REFERENCES linea (id)');
        $this->addSql('ALTER TABLE sublineas_paradas_horarios ADD CONSTRAINT FK_3BB5AEFF8E6EC471 FOREIGN KEY (sublinea_id) REFERENCES sublinea (id)');
        $this->addSql('ALTER TABLE sublineas_paradas_horarios ADD CONSTRAINT FK_3BB5AEFF4959F1BA FOREIGN KEY (horario_id) REFERENCES horario (id)');
        $this->addSql('ALTER TABLE sublineas_paradas_horarios ADD CONSTRAINT FK_3BB5AEFFC49C376A FOREIGN KEY (parada_id) REFERENCES parada (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE incidencias_sublineas DROP FOREIGN KEY FK_8A0D8A64AC3A23A8');
        $this->addSql('ALTER TABLE incidencias_sublineas DROP FOREIGN KEY FK_8A0D8A648E6EC471');
        $this->addSql('ALTER TABLE linea DROP FOREIGN KEY FK_BCB8FDDE521E1991');
        $this->addSql('ALTER TABLE parada DROP FOREIGN KEY FK_ADB5C4F2238957D9');
        $this->addSql('ALTER TABLE recorrido DROP FOREIGN KEY FK_3A1543A88E6EC471');
        $this->addSql('ALTER TABLE sublinea DROP FOREIGN KEY FK_C60B120485FE79F8');
        $this->addSql('ALTER TABLE sublineas_paradas_horarios DROP FOREIGN KEY FK_3BB5AEFF8E6EC471');
        $this->addSql('ALTER TABLE sublineas_paradas_horarios DROP FOREIGN KEY FK_3BB5AEFF4959F1BA');
        $this->addSql('ALTER TABLE sublineas_paradas_horarios DROP FOREIGN KEY FK_3BB5AEFFC49C376A');
        $this->addSql('DROP TABLE horario');
        $this->addSql('DROP TABLE incidencia');
        $this->addSql('DROP TABLE incidencias_sublineas');
        $this->addSql('DROP TABLE linea');
        $this->addSql('DROP TABLE parada');
        $this->addSql('DROP TABLE poblacion');
        $this->addSql('DROP TABLE recorrido');
        $this->addSql('DROP TABLE sublinea');
        $this->addSql('DROP TABLE sublineas_paradas_horarios');
    }
}
