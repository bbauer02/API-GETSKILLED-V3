<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250425210042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, demonym VARCHAR(255) DEFAULT NULL, language_name VARCHAR(255) NOT NULL, iso_code VARCHAR(3) NOT NULL, UNIQUE INDEX UNIQ_5373C96662B6A45E (iso_code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE institut (id INT AUTO_INCREMENT NOT NULL, country_id INT NOT NULL, stripe_account_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, siteweb VARCHAR(255) DEFAULT NULL, social_networks JSON DEFAULT NULL COMMENT '(DC2Type:json)', contact_address1 VARCHAR(255) NOT NULL, contact_address2 VARCHAR(255) DEFAULT NULL, contact_zipcode VARCHAR(20) NOT NULL, contact_city VARCHAR(100) NOT NULL, INDEX IDX_E01D2AB2F92F3E70 (country_id), UNIQUE INDEX UNIQ_E01D2AB2E065F932 (stripe_account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE institut_membership (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, institut_id INT NOT NULL, role VARCHAR(255) NOT NULL, since DATETIME NOT NULL, UNIQUE INDEX UNIQ_6473F6E1A76ED395 (user_id), INDEX IDX_6473F6E1ACF64F5F (institut_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE stripe_account (id INT AUTO_INCREMENT NOT NULL, stripe_id VARCHAR(255) NOT NULL, is_activated TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, native_country_id INT NOT NULL, nationality_id INT NOT NULL, firstlanguage_id INT NOT NULL, country_id INT NOT NULL, avatar VARCHAR(255) NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, civility VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, birthday DATE NOT NULL, previous_registration_number VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', platform_role VARCHAR(255) NOT NULL, contact_address1 VARCHAR(255) NOT NULL, contact_address2 VARCHAR(255) DEFAULT NULL, contact_zipcode VARCHAR(20) NOT NULL, contact_city VARCHAR(100) NOT NULL, INDEX IDX_8D93D64999AF4A30 (native_country_id), INDEX IDX_8D93D6491C9DA55 (nationality_id), INDEX IDX_8D93D64970222B8B (firstlanguage_id), INDEX IDX_8D93D649F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institut ADD CONSTRAINT FK_E01D2AB2F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institut ADD CONSTRAINT FK_E01D2AB2E065F932 FOREIGN KEY (stripe_account_id) REFERENCES stripe_account (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institut_membership ADD CONSTRAINT FK_6473F6E1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institut_membership ADD CONSTRAINT FK_6473F6E1ACF64F5F FOREIGN KEY (institut_id) REFERENCES institut (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD CONSTRAINT FK_8D93D64999AF4A30 FOREIGN KEY (native_country_id) REFERENCES country (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD CONSTRAINT FK_8D93D6491C9DA55 FOREIGN KEY (nationality_id) REFERENCES country (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD CONSTRAINT FK_8D93D64970222B8B FOREIGN KEY (firstlanguage_id) REFERENCES country (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD CONSTRAINT FK_8D93D649F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE institut DROP FOREIGN KEY FK_E01D2AB2F92F3E70
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institut DROP FOREIGN KEY FK_E01D2AB2E065F932
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institut_membership DROP FOREIGN KEY FK_6473F6E1A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institut_membership DROP FOREIGN KEY FK_6473F6E1ACF64F5F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP FOREIGN KEY FK_8D93D64999AF4A30
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP FOREIGN KEY FK_8D93D6491C9DA55
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP FOREIGN KEY FK_8D93D64970222B8B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F92F3E70
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE country
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE institut
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE institut_membership
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE stripe_account
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user
        SQL);
    }
}
