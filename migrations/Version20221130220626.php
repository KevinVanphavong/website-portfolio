<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221130220626 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_experience (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE work_experience ADD category_experience_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE work_experience ADD CONSTRAINT FK_1EF36CD058322B6C FOREIGN KEY (category_experience_id) REFERENCES category_experience (id)');
        $this->addSql('CREATE INDEX IDX_1EF36CD058322B6C ON work_experience (category_experience_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE work_experience DROP FOREIGN KEY FK_1EF36CD058322B6C');
        $this->addSql('DROP TABLE category_experience');
        $this->addSql('DROP INDEX IDX_1EF36CD058322B6C ON work_experience');
        $this->addSql('ALTER TABLE work_experience DROP category_experience_id');
    }
}
