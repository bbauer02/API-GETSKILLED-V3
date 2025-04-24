<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250417205601 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE user CHANGE contact_info_address1 contact_address1 VARCHAR(255) NOT NULL, CHANGE contact_info_address2 contact_address2 VARCHAR(255) DEFAULT NULL, CHANGE contact_info_zipcode contact_zipcode VARCHAR(20) NOT NULL, CHANGE contact_info_city contact_city VARCHAR(100) NOT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE user CHANGE contact_address1 contact_info_address1 VARCHAR(255) NOT NULL, CHANGE contact_address2 contact_info_address2 VARCHAR(255) DEFAULT NULL, CHANGE contact_zipcode contact_info_zipcode VARCHAR(20) NOT NULL, CHANGE contact_city contact_info_city VARCHAR(100) NOT NULL
        SQL);
    }
}
