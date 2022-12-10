<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221210094818 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP INDEX UNIQ_232B318C13B3DB11, ADD INDEX IDX_232B318C13B3DB11 (master_id)');
        $this->addSql('ALTER TABLE player DROP INDEX UNIQ_98197A65E48FD905, ADD INDEX IDX_98197A65E48FD905 (game_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP INDEX IDX_232B318C13B3DB11, ADD UNIQUE INDEX UNIQ_232B318C13B3DB11 (master_id)');
        $this->addSql('ALTER TABLE player DROP INDEX IDX_98197A65E48FD905, ADD UNIQUE INDEX UNIQ_98197A65E48FD905 (game_id)');
    }
}
