<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220927171315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_2F89867A2CD7AF10 ON player_user');
        $this->addSql('ALTER TABLE player_user CHANGE gamert_tag gamer_tag VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2F89867A9CA629E0 ON player_user (gamer_tag)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_2F89867A9CA629E0 ON player_user');
        $this->addSql('ALTER TABLE player_user CHANGE gamer_tag gamert_tag VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2F89867A2CD7AF10 ON player_user (gamert_tag)');
    }
}
