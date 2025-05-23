<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250417140929 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE hero ADD utilisateur_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE hero ADD CONSTRAINT FK_51CE6E86FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_51CE6E86FB88E14F ON hero (utilisateur_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE hero DROP FOREIGN KEY FK_51CE6E86FB88E14F
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_51CE6E86FB88E14F ON hero
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE hero DROP utilisateur_id
        SQL);
    }
}
