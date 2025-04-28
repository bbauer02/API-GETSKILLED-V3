<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250428124521 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE assessment_level (assessment_id INT NOT NULL, level_id INT NOT NULL, INDEX IDX_93CEF305DD3DD5F1 (assessment_id), INDEX IDX_93CEF3055FB14BA7 (level_id), PRIMARY KEY(assessment_id, level_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) DEFAULT NULL, ref VARCHAR(10) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE assessment_level ADD CONSTRAINT FK_93CEF305DD3DD5F1 FOREIGN KEY (assessment_id) REFERENCES assessment (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE assessment_level ADD CONSTRAINT FK_93CEF3055FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE assessment ADD parent_id INT DEFAULT NULL, ADD label VARCHAR(255) NOT NULL, ADD ref VARCHAR(10) NOT NULL, ADD is_internal TINYINT(1) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE assessment ADD CONSTRAINT FK_F7523D70727ACA70 FOREIGN KEY (parent_id) REFERENCES assessment (id) ON DELETE SET NULL
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_F7523D70727ACA70 ON assessment (parent_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE assessment_level DROP FOREIGN KEY FK_93CEF305DD3DD5F1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE assessment_level DROP FOREIGN KEY FK_93CEF3055FB14BA7
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE assessment_level
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE level
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE assessment DROP FOREIGN KEY FK_F7523D70727ACA70
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_F7523D70727ACA70 ON assessment
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE assessment DROP parent_id, DROP label, DROP ref, DROP is_internal
        SQL);
    }
}
