<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221216142817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, birthdate DATETIME NOT NULL, sex VARCHAR(255) NOT NULL, current_position VARCHAR(255) NOT NULL, quick_description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile_picture (id INT AUTO_INCREMENT NOT NULL, profile_user_id INT NOT NULL, name LONGTEXT NOT NULL, INDEX IDX_C565911574D00D09 (profile_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE related_social_network (id INT AUTO_INCREMENT NOT NULL, profile_user_id INT NOT NULL, name VARCHAR(255) NOT NULL, link_url VARCHAR(300) NOT NULL, INDEX IDX_8FA78E3E74D00D09 (profile_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE profile_picture ADD CONSTRAINT FK_C565911574D00D09 FOREIGN KEY (profile_user_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE related_social_network ADD CONSTRAINT FK_8FA78E3E74D00D09 FOREIGN KEY (profile_user_id) REFERENCES profile (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profile_picture DROP FOREIGN KEY FK_C565911574D00D09');
        $this->addSql('ALTER TABLE related_social_network DROP FOREIGN KEY FK_8FA78E3E74D00D09');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE profile_picture');
        $this->addSql('DROP TABLE related_social_network');
    }
}
