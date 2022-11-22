<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221118152135 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) DEFAULT NULL, uuid VARCHAR(50) NOT NULL, created_at VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ride (id INT AUTO_INCREMENT NOT NULL, ride_uuid VARCHAR(50) NOT NULL, status SMALLINT NOT NULL, start_time DATETIME NOT NULL, end_time DATETIME DEFAULT NULL, created_at VARCHAR(50) NOT NULL, updated_at VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ride_scooter (ride_id INT NOT NULL, scooter_id INT NOT NULL, INDEX IDX_47D0FC7302A8A70 (ride_id), INDEX IDX_47D0FC77678A648 (scooter_id), PRIMARY KEY(ride_id, scooter_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ride_client (ride_id INT NOT NULL, client_id INT NOT NULL, INDEX IDX_DAA437BB302A8A70 (ride_id), INDEX IDX_DAA437BB19EB6921 (client_id), PRIMARY KEY(ride_id, client_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE scooter (id INT AUTO_INCREMENT NOT NULL, uuid VARCHAR(50) NOT NULL, current_lat NUMERIC(10, 8) NOT NULL, current_lng NUMERIC(11, 8) NOT NULL, status SMALLINT NOT NULL, created_at VARCHAR(50) NOT NULL, updated_at VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE track_ride (id INT AUTO_INCREMENT NOT NULL, lat NUMERIC(10, 8) NOT NULL, lng NUMERIC(11, 8) NOT NULL, event_time DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE track_ride_ride (track_ride_id INT NOT NULL, ride_id INT NOT NULL, INDEX IDX_D1BAE750E9B4126D (track_ride_id), INDEX IDX_D1BAE750302A8A70 (ride_id), PRIMARY KEY(track_ride_id, ride_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ride_scooter ADD CONSTRAINT FK_47D0FC7302A8A70 FOREIGN KEY (ride_id) REFERENCES ride (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ride_scooter ADD CONSTRAINT FK_47D0FC77678A648 FOREIGN KEY (scooter_id) REFERENCES scooter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ride_client ADD CONSTRAINT FK_DAA437BB302A8A70 FOREIGN KEY (ride_id) REFERENCES ride (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ride_client ADD CONSTRAINT FK_DAA437BB19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE track_ride_ride ADD CONSTRAINT FK_D1BAE750E9B4126D FOREIGN KEY (track_ride_id) REFERENCES track_ride (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE track_ride_ride ADD CONSTRAINT FK_D1BAE750302A8A70 FOREIGN KEY (ride_id) REFERENCES ride (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ride_scooter DROP FOREIGN KEY FK_47D0FC7302A8A70');
        $this->addSql('ALTER TABLE ride_scooter DROP FOREIGN KEY FK_47D0FC77678A648');
        $this->addSql('ALTER TABLE ride_client DROP FOREIGN KEY FK_DAA437BB302A8A70');
        $this->addSql('ALTER TABLE ride_client DROP FOREIGN KEY FK_DAA437BB19EB6921');
        $this->addSql('ALTER TABLE track_ride_ride DROP FOREIGN KEY FK_D1BAE750E9B4126D');
        $this->addSql('ALTER TABLE track_ride_ride DROP FOREIGN KEY FK_D1BAE750302A8A70');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE ride');
        $this->addSql('DROP TABLE ride_scooter');
        $this->addSql('DROP TABLE ride_client');
        $this->addSql('DROP TABLE scooter');
        $this->addSql('DROP TABLE track_ride');
        $this->addSql('DROP TABLE track_ride_ride');
    }
}
