<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250418090358 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE equipement ADD emplacement_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE equipement ADD CONSTRAINT FK_B8B4C6F3C4598A51 FOREIGN KEY (emplacement_id) REFERENCES emplacement (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_B8B4C6F3C4598A51 ON equipement (emplacement_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE equipement DROP FOREIGN KEY FK_B8B4C6F3C4598A51
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_B8B4C6F3C4598A51 ON equipement
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE equipement DROP emplacement_id
        SQL);
    }
}
