<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220928100702 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player_user_player_user DROP FOREIGN KEY FK_6745CD7462EF8DDB');
        $this->addSql('ALTER TABLE player_user_player_user DROP FOREIGN KEY FK_6745CD747B0ADD54');
        $this->addSql('DROP TABLE player_user_player_user');
        $this->addSql('ALTER TABLE player_user ADD friendList VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE player_user_player_user (player_user_source INT NOT NULL, player_user_target INT NOT NULL, INDEX IDX_6745CD7462EF8DDB (player_user_source), INDEX IDX_6745CD747B0ADD54 (player_user_target), PRIMARY KEY(player_user_source, player_user_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE player_user_player_user ADD CONSTRAINT FK_6745CD7462EF8DDB FOREIGN KEY (player_user_source) REFERENCES player_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player_user_player_user ADD CONSTRAINT FK_6745CD747B0ADD54 FOREIGN KEY (player_user_target) REFERENCES player_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player_user DROP friendList');
    }
}
