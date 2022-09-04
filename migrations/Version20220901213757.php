<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220901213757 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE history (id INT AUTO_INCREMENT NOT NULL, date VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, location_picture VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, post_code INT NOT NULL, city VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE kmj_histo');
        $this->addSql('DROP TABLE kmj_lieu');
        $this->addSql('DROP TABLE kmj_type');
        $this->addSql('DROP TABLE kmj_user');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE kmj_histo (histo_date DATE NOT NULL, user_id NUMERIC(10, 0) NOT NULL, lieu_id NUMERIC(10, 0) NOT NULL, INDEX fk_kmj_histo_lieu (lieu_id), PRIMARY KEY(histo_date, user_id, lieu_id)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_general_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE kmj_lieu (lieu_id NUMERIC(10, 0) NOT NULL, lieu_lib VARCHAR(100) CHARACTER SET latin1 NOT NULL COLLATE `latin1_general_ci`, type_id INT NOT NULL, PRIMARY KEY(lieu_id)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_general_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE kmj_type (type_id INT NOT NULL, type_lib VARCHAR(100) CHARACTER SET latin1 NOT NULL COLLATE `latin1_general_ci`, PRIMARY KEY(type_id)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_general_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE kmj_user (user_id NUMERIC(10, 0) NOT NULL, user_nom VARCHAR(100) CHARACTER SET latin1 NOT NULL COLLATE `latin1_general_ci`, user_login VARCHAR(32) CHARACTER SET latin1 NOT NULL COLLATE `latin1_general_ci`, user_pwd VARCHAR(40) CHARACTER SET ascii NOT NULL COLLATE `ascii_bin`, PRIMARY KEY(user_id)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_general_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('DROP TABLE history');
        $this->addSql('DROP TABLE location');
    }
}
