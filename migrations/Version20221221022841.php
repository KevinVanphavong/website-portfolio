<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221221022841 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE work_experience_image (id INT AUTO_INCREMENT NOT NULL, work_experience_id INT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_839259936347713 (work_experience_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE work_experience_image ADD CONSTRAINT FK_839259936347713 FOREIGN KEY (work_experience_id) REFERENCES work_experience (id)');
        $this->addSql('ALTER TABLE related_social_network DROP FOREIGN KEY FK_8FA78E3E74D00D09');
        $this->addSql('DROP TABLE related_social_network');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE related_social_network (id INT AUTO_INCREMENT NOT NULL, profile_user_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, link_url VARCHAR(300) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_8FA78E3E74D00D09 (profile_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE related_social_network ADD CONSTRAINT FK_8FA78E3E74D00D09 FOREIGN KEY (profile_user_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE work_experience_image DROP FOREIGN KEY FK_839259936347713');
        $this->addSql('DROP TABLE work_experience_image');
    }
}
