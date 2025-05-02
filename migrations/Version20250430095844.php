<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250430095844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre CHANGE description description LONGTEXT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE choix CHANGE chapitre_cible chapitre_cible INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE hero CHANGE pv pv INT DEFAULT 10 NOT NULL, CHANGE atk atk INT DEFAULT 1 NOT NULL, CHANGE def def INT DEFAULT 1 NOT NULL, CHANGE agi agi INT DEFAULT 1 NOT NULL, CHANGE intel intel INT DEFAULT 1 NOT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE choix CHANGE chapitre_cible chapitre_cible INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE hero CHANGE pv pv INT NOT NULL, CHANGE atk atk INT NOT NULL, CHANGE def def INT NOT NULL, CHANGE agi agi INT NOT NULL, CHANGE intel intel INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre CHANGE description description VARCHAR(255) DEFAULT NULL
        SQL);
    }
}
