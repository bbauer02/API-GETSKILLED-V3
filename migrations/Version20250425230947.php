<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250425230947 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE institut_test_ownership (id INT AUTO_INCREMENT NOT NULL, test_id INT NOT NULL, institut_id INT NOT NULL, ownership_type VARCHAR(255) NOT NULL, purchase_date DATE NOT NULL, INDEX IDX_C83FA1251E5D0459 (test_id), INDEX IDX_C83FA125ACF64F5F (institut_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, test_id INT NOT NULL, label VARCHAR(255) NOT NULL, ref VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_9AEACC131E5D0459 (test_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, parent_id INT NOT NULL, label VARCHAR(255) NOT NULL, ref VARCHAR(10) NOT NULL, is_internal TINYINT(1) NOT NULL, INDEX IDX_D87F7E0C727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institut_test_ownership ADD CONSTRAINT FK_C83FA1251E5D0459 FOREIGN KEY (test_id) REFERENCES test (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institut_test_ownership ADD CONSTRAINT FK_C83FA125ACF64F5F FOREIGN KEY (institut_id) REFERENCES institut (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE level ADD CONSTRAINT FK_9AEACC131E5D0459 FOREIGN KEY (test_id) REFERENCES test (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE test ADD CONSTRAINT FK_D87F7E0C727ACA70 FOREIGN KEY (parent_id) REFERENCES test (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE institut_test_ownership DROP FOREIGN KEY FK_C83FA1251E5D0459
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE institut_test_ownership DROP FOREIGN KEY FK_C83FA125ACF64F5F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE level DROP FOREIGN KEY FK_9AEACC131E5D0459
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE test DROP FOREIGN KEY FK_D87F7E0C727ACA70
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE institut_test_ownership
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE level
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE test
        SQL);
    }
}
