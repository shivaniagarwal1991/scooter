<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221119075355 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ride CHANGE start_time start_time VARCHAR(50) NOT NULL, CHANGE end_time end_time VARCHAR(50) DEFAULT NULL, CHANGE created_at created_at VARCHAR(50) NOT NULL, CHANGE updated_at updated_at VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE scooter CHANGE uuid uuid VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_43D2208BD17F50A6 ON scooter (uuid)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ride CHANGE start_time start_time DATETIME NOT NULL, CHANGE end_time end_time DATETIME DEFAULT NULL, CHANGE created_at created_at DATETIME NOT NULL, CHANGE updated_at updated_at DATETIME NOT NULL');
        $this->addSql('DROP INDEX UNIQ_43D2208BD17F50A6 ON scooter');
        $this->addSql('ALTER TABLE scooter CHANGE uuid uuid VARCHAR(50) NOT NULL');
    }
}
