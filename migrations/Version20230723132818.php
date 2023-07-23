<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230723132818 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE note_frais (id INT AUTO_INCREMENT NOT NULL, societe_id INT NOT NULL, user_id INT NOT NULL, date_note DATE NOT NULL, montant_note DOUBLE PRECISION NOT NULL, type_note VARCHAR(255) NOT NULL, date_enregistrement DATE NOT NULL, INDEX IDX_4050EF4FFCF77503 (societe_id), INDEX IDX_4050EF4FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE societe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE note_frais ADD CONSTRAINT FK_4050EF4FFCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id)');
        $this->addSql('ALTER TABLE note_frais ADD CONSTRAINT FK_4050EF4FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note_frais DROP FOREIGN KEY FK_4050EF4FFCF77503');
        $this->addSql('ALTER TABLE note_frais DROP FOREIGN KEY FK_4050EF4FA76ED395');
        $this->addSql('DROP TABLE note_frais');
        $this->addSql('DROP TABLE societe');
    }
}
