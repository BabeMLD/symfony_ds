<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221217155719 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE server_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE server (id INT NOT NULL, name VARCHAR(50) NOT NULL, freq_prop VARCHAR(80) NOT NULL, taille_m VARCHAR(50) NOT NULL, taille_db VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE technicien ADD server_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE technicien ADD CONSTRAINT FK_96282C4CDFC5FC5E FOREIGN KEY (server_id_id) REFERENCES server (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_96282C4CDFC5FC5E ON technicien (server_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE technicien DROP CONSTRAINT FK_96282C4CDFC5FC5E');
        $this->addSql('DROP SEQUENCE server_id_seq CASCADE');
        $this->addSql('DROP TABLE server');
        $this->addSql('DROP INDEX IDX_96282C4CDFC5FC5E');
        $this->addSql('ALTER TABLE technicien DROP server_id_id');
    }
}
