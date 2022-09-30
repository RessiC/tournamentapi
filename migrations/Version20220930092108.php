<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220930092108 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE player_user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, is_confirmed TINYINT(1) NOT NULL, is_player TINYINT(1) NOT NULL, password VARCHAR(255) NOT NULL, gamer_tag VARCHAR(180) NOT NULL, is_captain TINYINT(1) NOT NULL, points INT NOT NULL, UNIQUE INDEX UNIQ_2F89867AE7927C74 (email), UNIQUE INDEX UNIQ_2F89867A9CA629E0 (gamer_tag), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, is_confirmed TINYINT(1) NOT NULL, is_player TINYINT(1) NOT NULL, password VARCHAR(255) NOT NULL, gamer_tag VARCHAR(180) NOT NULL, is_captain TINYINT(1) NOT NULL, points INT NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D6499CA629E0 (gamer_tag), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE player_user');
        $this->addSql('DROP TABLE user');
    }
}
