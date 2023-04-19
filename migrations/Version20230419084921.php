<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230419084921 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE content_file (id INT AUTO_INCREMENT NOT NULL, content_id INT NOT NULL, file_name VARCHAR(255) NOT NULL, file_size INT NOT NULL, updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_41FDDBD584A0A3ED (content_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE content_file ADD CONSTRAINT FK_41FDDBD584A0A3ED FOREIGN KEY (content_id) REFERENCES content (id)');
        $this->addSql('ALTER TABLE content DROP files');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE content_file DROP FOREIGN KEY FK_41FDDBD584A0A3ED');
        $this->addSql('DROP TABLE content_file');
        $this->addSql('DROP INDEX UNIQ_FEC530A9989D9B62 ON content');
        $this->addSql('ALTER TABLE content ADD files JSON DEFAULT NULL');
    }
}
