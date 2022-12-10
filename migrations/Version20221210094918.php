<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221210094918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game_log DROP INDEX UNIQ_94657B004ACC9A20, ADD INDEX IDX_94657B004ACC9A20 (card_id)');
        $this->addSql('ALTER TABLE game_log DROP INDEX UNIQ_94657B0099E6F5DF, ADD INDEX IDX_94657B0099E6F5DF (player_id)');
        $this->addSql('ALTER TABLE game_log DROP INDEX UNIQ_94657B00E48FD905, ADD INDEX IDX_94657B00E48FD905 (game_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game_log DROP INDEX IDX_94657B00E48FD905, ADD UNIQUE INDEX UNIQ_94657B00E48FD905 (game_id)');
        $this->addSql('ALTER TABLE game_log DROP INDEX IDX_94657B004ACC9A20, ADD UNIQUE INDEX UNIQ_94657B004ACC9A20 (card_id)');
        $this->addSql('ALTER TABLE game_log DROP INDEX IDX_94657B0099E6F5DF, ADD UNIQUE INDEX UNIQ_94657B0099E6F5DF (player_id)');
    }
}
