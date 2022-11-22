<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221119081045 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ride_client DROP FOREIGN KEY FK_DAA437BB19EB6921');
        $this->addSql('ALTER TABLE ride_client DROP FOREIGN KEY FK_DAA437BB302A8A70');
        $this->addSql('ALTER TABLE ride_scooter DROP FOREIGN KEY FK_47D0FC77678A648');
        $this->addSql('ALTER TABLE ride_scooter DROP FOREIGN KEY FK_47D0FC7302A8A70');
        $this->addSql('ALTER TABLE track_ride_ride DROP FOREIGN KEY FK_D1BAE750302A8A70');
        $this->addSql('ALTER TABLE track_ride_ride DROP FOREIGN KEY FK_D1BAE750E9B4126D');
        $this->addSql('DROP TABLE ride_client');
        $this->addSql('DROP TABLE ride_scooter');
        $this->addSql('DROP TABLE track_ride_ride');
        $this->addSql('ALTER TABLE ride ADD scooter_uuid VARCHAR(50) NOT NULL, ADD client_uuid VARCHAR(50) NOT NULL, CHANGE ride_uuid ride_uuid VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9B3D7CD09A4065D2 ON ride (ride_uuid)');
        $this->addSql('ALTER TABLE track_ride ADD ride_id INT NOT NULL, CHANGE event_time event_time VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ride_client (ride_id INT NOT NULL, client_id INT NOT NULL, INDEX IDX_DAA437BB19EB6921 (client_id), INDEX IDX_DAA437BB302A8A70 (ride_id), PRIMARY KEY(ride_id, client_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ride_scooter (ride_id INT NOT NULL, scooter_id INT NOT NULL, INDEX IDX_47D0FC7302A8A70 (ride_id), INDEX IDX_47D0FC77678A648 (scooter_id), PRIMARY KEY(ride_id, scooter_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE track_ride_ride (track_ride_id INT NOT NULL, ride_id INT NOT NULL, INDEX IDX_D1BAE750E9B4126D (track_ride_id), INDEX IDX_D1BAE750302A8A70 (ride_id), PRIMARY KEY(track_ride_id, ride_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ride_client ADD CONSTRAINT FK_DAA437BB19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ride_client ADD CONSTRAINT FK_DAA437BB302A8A70 FOREIGN KEY (ride_id) REFERENCES ride (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ride_scooter ADD CONSTRAINT FK_47D0FC77678A648 FOREIGN KEY (scooter_id) REFERENCES scooter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ride_scooter ADD CONSTRAINT FK_47D0FC7302A8A70 FOREIGN KEY (ride_id) REFERENCES ride (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE track_ride_ride ADD CONSTRAINT FK_D1BAE750302A8A70 FOREIGN KEY (ride_id) REFERENCES ride (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE track_ride_ride ADD CONSTRAINT FK_D1BAE750E9B4126D FOREIGN KEY (track_ride_id) REFERENCES track_ride (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX UNIQ_9B3D7CD09A4065D2 ON ride');
        $this->addSql('ALTER TABLE ride DROP scooter_uuid, DROP client_uuid, CHANGE ride_uuid ride_uuid VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE track_ride DROP ride_id, CHANGE event_time event_time DATETIME NOT NULL');
    }
}
