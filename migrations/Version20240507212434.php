<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240507212434 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coordenadas (id INT AUTO_INCREMENT NOT NULL, sublinea_id INT NOT NULL, latitud DOUBLE PRECISION NOT NULL, longitud DOUBLE PRECISION NOT NULL, orden INT NOT NULL, INDEX IDX_979E70798E6EC471 (sublinea_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coordenadas ADD CONSTRAINT FK_979E70798E6EC471 FOREIGN KEY (sublinea_id) REFERENCES sublinea (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coordenadas DROP FOREIGN KEY FK_979E70798E6EC471');
        $this->addSql('DROP TABLE coordenadas');
    }
}
