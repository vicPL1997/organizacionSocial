<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220429174412 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sedes ADD administrador_sede_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sedes ADD CONSTRAINT FK_EAF0B6AB2A76889B FOREIGN KEY (administrador_sede_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EAF0B6AB2A76889B ON sedes (administrador_sede_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sedes DROP FOREIGN KEY FK_EAF0B6AB2A76889B');
        $this->addSql('DROP INDEX UNIQ_EAF0B6AB2A76889B ON sedes');
        $this->addSql('ALTER TABLE sedes DROP administrador_sede_id');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
