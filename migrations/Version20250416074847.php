<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250416074847 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE equipement_enchantement (equipement_id INT NOT NULL, enchantement_id INT NOT NULL, INDEX IDX_9E7E520806F0F5C (equipement_id), INDEX IDX_9E7E520FE7C9E74 (enchantement_id), PRIMARY KEY(equipement_id, enchantement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE equipement_stat_hero (equipement_id INT NOT NULL, stat_hero_id INT NOT NULL, INDEX IDX_4C9AA00D806F0F5C (equipement_id), INDEX IDX_4C9AA00DE0A17C54 (stat_hero_id), PRIMARY KEY(equipement_id, stat_hero_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE equipement_enchantement ADD CONSTRAINT FK_9E7E520806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE equipement_enchantement ADD CONSTRAINT FK_9E7E520FE7C9E74 FOREIGN KEY (enchantement_id) REFERENCES enchantement (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE equipement_stat_hero ADD CONSTRAINT FK_4C9AA00D806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE equipement_stat_hero ADD CONSTRAINT FK_4C9AA00DE0A17C54 FOREIGN KEY (stat_hero_id) REFERENCES stat_hero (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE equipement_enchantement DROP FOREIGN KEY FK_9E7E520806F0F5C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE equipement_enchantement DROP FOREIGN KEY FK_9E7E520FE7C9E74
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE equipement_stat_hero DROP FOREIGN KEY FK_4C9AA00D806F0F5C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE equipement_stat_hero DROP FOREIGN KEY FK_4C9AA00DE0A17C54
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE equipement_enchantement
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE equipement_stat_hero
        SQL);
    }
}
