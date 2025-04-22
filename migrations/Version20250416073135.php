<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250416073135 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE bonus (id INT AUTO_INCREMENT NOT NULL, bonus_pv INT DEFAULT NULL, bonus_atk INT DEFAULT NULL, bonus_def INT DEFAULT NULL, bonus_agi INT DEFAULT NULL, bonus_int INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE chapitre (id INT AUTO_INCREMENT NOT NULL, histoire_id INT NOT NULL, stat_hero_id INT DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, num_chapitre INT NOT NULL, INDEX IDX_8C62B0259B94373 (histoire_id), UNIQUE INDEX UNIQ_8C62B025E0A17C54 (stat_hero_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE chapitre_monstre (chapitre_id INT NOT NULL, monstre_id INT NOT NULL, INDEX IDX_768FF6881FBEEF7B (chapitre_id), INDEX IDX_768FF688DAF13697 (monstre_id), PRIMARY KEY(chapitre_id, monstre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE chapitre_bonus (chapitre_id INT NOT NULL, bonus_id INT NOT NULL, INDEX IDX_2B06D21B1FBEEF7B (chapitre_id), INDEX IDX_2B06D21B69545666 (bonus_id), PRIMARY KEY(chapitre_id, bonus_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE chapitre_malus (chapitre_id INT NOT NULL, malus_id INT NOT NULL, INDEX IDX_4A0DE6971FBEEF7B (chapitre_id), INDEX IDX_4A0DE697AD839E9C (malus_id), PRIMARY KEY(chapitre_id, malus_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE chapitre_equipement (chapitre_id INT NOT NULL, equipement_id INT NOT NULL, INDEX IDX_D4C3A7901FBEEF7B (chapitre_id), INDEX IDX_D4C3A790806F0F5C (equipement_id), PRIMARY KEY(chapitre_id, equipement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE choix (id INT AUTO_INCREMENT NOT NULL, chapitre_id INT NOT NULL, description LONGTEXT NOT NULL, chapitre_cible INT NOT NULL, INDEX IDX_4F4880911FBEEF7B (chapitre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE enchantement (id INT AUTO_INCREMENT NOT NULL, bonus_pv INT DEFAULT NULL, bonus_atk INT DEFAULT NULL, bonus_def INT DEFAULT NULL, bonus_agi INT DEFAULT NULL, bonus_int INT DEFAULT NULL, malus_pv INT DEFAULT NULL, malus_atk INT DEFAULT NULL, malus_def INT DEFAULT NULL, malus_agi INT DEFAULT NULL, malus_int INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, emplacement VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE hero (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, pv INT NOT NULL, atk INT NOT NULL, def INT NOT NULL, agi INT NOT NULL, `int` INT NOT NULL, INDEX IDX_51CE6E86FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE histoire (id INT AUTO_INCREMENT NOT NULL, createur_id INT NOT NULL, titre VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', description LONGTEXT DEFAULT NULL, INDEX IDX_FD74CD6873A201E5 (createur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE malus (id INT AUTO_INCREMENT NOT NULL, malus_pv INT DEFAULT NULL, malus_atk INT DEFAULT NULL, malus_def INT DEFAULT NULL, malus_agi INT DEFAULT NULL, malus_int INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE monstre (id INT AUTO_INCREMENT NOT NULL, createur_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, pv INT NOT NULL, atk INT NOT NULL, def INT NOT NULL, INDEX IDX_A20EC7A573A201E5 (createur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE stat_hero (id INT AUTO_INCREMENT NOT NULL, hero_id INT NOT NULL, histoire_id INT DEFAULT NULL, pv_actu INT DEFAULT NULL, atk_actu INT DEFAULT NULL, def_actu INT DEFAULT NULL, agi_actu INT DEFAULT NULL, int_actu INT DEFAULT NULL, INDEX IDX_708695D245B0BCD (hero_id), INDEX IDX_708695D29B94373 (histoire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre ADD CONSTRAINT FK_8C62B0259B94373 FOREIGN KEY (histoire_id) REFERENCES histoire (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre ADD CONSTRAINT FK_8C62B025E0A17C54 FOREIGN KEY (stat_hero_id) REFERENCES stat_hero (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre_monstre ADD CONSTRAINT FK_768FF6881FBEEF7B FOREIGN KEY (chapitre_id) REFERENCES chapitre (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre_monstre ADD CONSTRAINT FK_768FF688DAF13697 FOREIGN KEY (monstre_id) REFERENCES monstre (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre_bonus ADD CONSTRAINT FK_2B06D21B1FBEEF7B FOREIGN KEY (chapitre_id) REFERENCES chapitre (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre_bonus ADD CONSTRAINT FK_2B06D21B69545666 FOREIGN KEY (bonus_id) REFERENCES bonus (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre_malus ADD CONSTRAINT FK_4A0DE6971FBEEF7B FOREIGN KEY (chapitre_id) REFERENCES chapitre (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre_malus ADD CONSTRAINT FK_4A0DE697AD839E9C FOREIGN KEY (malus_id) REFERENCES malus (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre_equipement ADD CONSTRAINT FK_D4C3A7901FBEEF7B FOREIGN KEY (chapitre_id) REFERENCES chapitre (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre_equipement ADD CONSTRAINT FK_D4C3A790806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE choix ADD CONSTRAINT FK_4F4880911FBEEF7B FOREIGN KEY (chapitre_id) REFERENCES chapitre (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE hero ADD CONSTRAINT FK_51CE6E86FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE histoire ADD CONSTRAINT FK_FD74CD6873A201E5 FOREIGN KEY (createur_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE monstre ADD CONSTRAINT FK_A20EC7A573A201E5 FOREIGN KEY (createur_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE stat_hero ADD CONSTRAINT FK_708695D245B0BCD FOREIGN KEY (hero_id) REFERENCES hero (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE stat_hero ADD CONSTRAINT FK_708695D29B94373 FOREIGN KEY (histoire_id) REFERENCES histoire (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre DROP FOREIGN KEY FK_8C62B0259B94373
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre DROP FOREIGN KEY FK_8C62B025E0A17C54
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre_monstre DROP FOREIGN KEY FK_768FF6881FBEEF7B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre_monstre DROP FOREIGN KEY FK_768FF688DAF13697
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre_bonus DROP FOREIGN KEY FK_2B06D21B1FBEEF7B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre_bonus DROP FOREIGN KEY FK_2B06D21B69545666
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre_malus DROP FOREIGN KEY FK_4A0DE6971FBEEF7B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre_malus DROP FOREIGN KEY FK_4A0DE697AD839E9C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre_equipement DROP FOREIGN KEY FK_D4C3A7901FBEEF7B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre_equipement DROP FOREIGN KEY FK_D4C3A790806F0F5C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE choix DROP FOREIGN KEY FK_4F4880911FBEEF7B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE hero DROP FOREIGN KEY FK_51CE6E86FB88E14F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE histoire DROP FOREIGN KEY FK_FD74CD6873A201E5
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE monstre DROP FOREIGN KEY FK_A20EC7A573A201E5
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE stat_hero DROP FOREIGN KEY FK_708695D245B0BCD
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE stat_hero DROP FOREIGN KEY FK_708695D29B94373
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE bonus
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE chapitre
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE chapitre_monstre
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE chapitre_bonus
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE chapitre_malus
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE chapitre_equipement
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE choix
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE enchantement
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE equipement
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE hero
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE histoire
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE malus
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE monstre
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE stat_hero
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE `user`
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
