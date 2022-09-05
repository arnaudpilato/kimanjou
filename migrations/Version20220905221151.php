<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220905221151 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE history ADD user_id INT DEFAULT NULL, ADD location_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704BA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704B64D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('CREATE INDEX IDX_27BA704BA76ED395 ON history (user_id)');
        $this->addSql('CREATE INDEX IDX_27BA704B64D218E ON history (location_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE history DROP FOREIGN KEY FK_27BA704BA76ED395');
        $this->addSql('ALTER TABLE history DROP FOREIGN KEY FK_27BA704B64D218E');
        $this->addSql('DROP INDEX IDX_27BA704BA76ED395 ON history');
        $this->addSql('DROP INDEX IDX_27BA704B64D218E ON history');
        $this->addSql('ALTER TABLE history DROP user_id, DROP location_id');
    }
}
