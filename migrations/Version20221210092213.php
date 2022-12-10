<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221210092213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game ADD played_chips INT DEFAULT NULL COMMENT \'Played amount of chips in a round. (Always changing)\', CHANGE played_cards played_cards VARCHAR(255) DEFAULT NULL COMMENT \'Played cards in a round. (Always changing)\', CHANGE status status INT DEFAULT NULL COMMENT \'Status of the game. (0 - inactive, 1 - starting, 2 - active)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP played_chips, CHANGE played_cards played_cards VARCHAR(255) DEFAULT NULL, CHANGE status status INT DEFAULT NULL');
    }
}
