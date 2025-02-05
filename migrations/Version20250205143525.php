<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250205143525 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE matricula (id INT AUTO_INCREMENT NOT NULL, aluno_id INT NOT NULL, curso_id INT NOT NULL, numero_matricula INT NOT NULL, data_matricula DATETIME NOT NULL, INDEX IDX_15DF1885B2DDF7F4 (aluno_id), INDEX IDX_15DF188587CB4A1F (curso_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE matricula ADD CONSTRAINT FK_15DF1885B2DDF7F4 FOREIGN KEY (aluno_id) REFERENCES aluno (id)');
        $this->addSql('ALTER TABLE matricula ADD CONSTRAINT FK_15DF188587CB4A1F FOREIGN KEY (curso_id) REFERENCES curso (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matricula DROP FOREIGN KEY FK_15DF1885B2DDF7F4');
        $this->addSql('ALTER TABLE matricula DROP FOREIGN KEY FK_15DF188587CB4A1F');
        $this->addSql('DROP TABLE matricula');
    }
}
