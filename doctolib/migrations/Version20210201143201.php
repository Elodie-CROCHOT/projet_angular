<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210201143201 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment CHANGE date_appointment date_appointment VARCHAR(255) NOT NULL, CHANGE hour_appointment hour_appointment VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE patient CHANGE birth_date birth_date VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment CHANGE date_appointment date_appointment DATETIME NOT NULL, CHANGE hour_appointment hour_appointment TIME NOT NULL');
        $this->addSql('ALTER TABLE patient CHANGE birth_date birth_date DATETIME NOT NULL');
    }
}
