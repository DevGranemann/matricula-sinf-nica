<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250205221431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aluno CHANGE cpf cpf VARCHAR(11) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_67C971003E3E11F0 ON aluno (cpf)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_67C971003E3E11F0 ON aluno');
        $this->addSql('ALTER TABLE aluno CHANGE cpf cpf INT NOT NULL');
    }
}
