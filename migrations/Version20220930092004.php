<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220930092004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD gamer_tag VARCHAR(180) NOT NULL, ADD is_captain TINYINT(1) NOT NULL, ADD points INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6499CA629E0 ON user (gamer_tag)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_8D93D6499CA629E0 ON user');
        $this->addSql('ALTER TABLE user DROP gamer_tag, DROP is_captain, DROP points');
    }
}
