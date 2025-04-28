<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250428102634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE assessment (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, demonym VARCHAR(255) DEFAULT NULL, language_name VARCHAR(255) NOT NULL, iso_code VARCHAR(3) NOT NULL, UNIQUE INDEX UNIQ_5373C96662B6A45E (iso_code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE exam (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, is_written TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE institute (id INT AUTO_INCREMENT NOT NULL, country_id INT NOT NULL, stripe_account_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, siteweb VARCHAR(255) DEFAULT NULL, social_networks JSON DEFAULT NULL COMMENT '(DC2Type:json)', phone VARCHAR(15) DEFAULT NULL, contact_address1 VARCHAR(255) NOT NULL, contact_address2 VARCHAR(255) DEFAULT NULL, contact_zipcode VARCHAR(20) NOT NULL, contact_city VARCHAR(100) NOT NULL, INDEX IDX_CA55B5D0F92F3E70 (country_id), UNIQUE INDEX UNIQ_CA55B5D0E065F932 (stripe_account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE institute_assessment_ownership (id INT AUTO_INCREMENT NOT NULL, institute_id INT NOT NULL, assessment_id INT NOT NULL, ownership_type VARCHAR(255) NOT NULL, purchase_date DATE NOT NULL, INDEX IDX_26743118697B0F4C (institute_id), INDEX IDX_26743118DD3DD5F1 (assessment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE institute_membership (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, institute_id INT NOT NULL, role VARCHAR(255) NOT NULL, since DATETIME NOT NULL, UNIQUE INDEX UNIQ_5197D5FDA76ED395 (user_id), INDEX IDX_5197D5FD697B0F4C (institute_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE stripe_account (id INT AUTO_INCREMENT NOT NULL, stripe_id VARCHAR(255) NOT NULL, is_activated TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, native_country_id INT NOT NULL, nationality_id INT NOT NULL, firstlanguage_id INT NOT NULL, country_id INT NOT NULL, avatar VARCHAR(255) NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, civility VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, birthday DATE NOT NULL, previous_registration_number VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', platform_role VARCHAR(255) NOT NULL, contact_address1 VARCHAR(255) NOT NULL, contact_address2 VARCHAR(255) DEFAULT NULL, contact_zipcode VARCHAR(20) NOT NULL, contact_city VARCHAR(100) NOT NULL, INDEX IDX_8D93D64999AF4A30 (native_country_id), INDEX IDX_8D93D6491C9DA55 (nationality_id), INDEX IDX_8D93D64970222B8B (firstlanguage_id), INDEX IDX_8D93D649F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institute ADD CONSTRAINT FK_CA55B5D0F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institute ADD CONSTRAINT FK_CA55B5D0E065F932 FOREIGN KEY (stripe_account_id) REFERENCES stripe_account (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institute_assessment_ownership ADD CONSTRAINT FK_26743118697B0F4C FOREIGN KEY (institute_id) REFERENCES institute (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institute_assessment_ownership ADD CONSTRAINT FK_26743118DD3DD5F1 FOREIGN KEY (assessment_id) REFERENCES assessment (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institute_membership ADD CONSTRAINT FK_5197D5FDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institute_membership ADD CONSTRAINT FK_5197D5FD697B0F4C FOREIGN KEY (institute_id) REFERENCES institute (id) ON DELETE CASCADE
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
            ALTER TABLE institute DROP FOREIGN KEY FK_CA55B5D0F92F3E70
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institute DROP FOREIGN KEY FK_CA55B5D0E065F932
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institute_assessment_ownership DROP FOREIGN KEY FK_26743118697B0F4C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institute_assessment_ownership DROP FOREIGN KEY FK_26743118DD3DD5F1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institute_membership DROP FOREIGN KEY FK_5197D5FDA76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institute_membership DROP FOREIGN KEY FK_5197D5FD697B0F4C
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
            DROP TABLE assessment
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE country
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE exam
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE institute
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE institute_assessment_ownership
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE institute_membership
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE stripe_account
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user
        SQL);
    }
}
