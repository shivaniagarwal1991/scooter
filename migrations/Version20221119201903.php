<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221119201903 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ride CHANGE end_time end_time VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE track_ride ADD ride_uuid VARCHAR(50) NOT NULL, DROP ride_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ride CHANGE end_time end_time VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE track_ride ADD ride_id INT NOT NULL, DROP ride_uuid');
    }
}
