<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210118093134 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE agenda_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE has_voted_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE meeting_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE meeting_user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE vote_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE agenda (id INT NOT NULL, meeting_id INT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2CEDC87767433D9C ON agenda (meeting_id)');
        $this->addSql('CREATE TABLE has_voted (id INT NOT NULL, agenda_id INT NOT NULL, meeting_user_id INT NOT NULL, has_voted BOOLEAN NOT NULL, voted_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_29D1EFB6EA67784A ON has_voted (agenda_id)');
        $this->addSql('CREATE INDEX IDX_29D1EFB63FBC9B18 ON has_voted (meeting_user_id)');
        $this->addSql('CREATE TABLE meeting (id INT NOT NULL, date DATE NOT NULL, subject VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE meeting_user (id INT NOT NULL, meeting_id INT NOT NULL, user_id INT NOT NULL, roles JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_61622E9B67433D9C ON meeting_user (meeting_id)');
        $this->addSql('CREATE INDEX IDX_61622E9BA76ED395 ON meeting_user (user_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE vote (id INT NOT NULL, agenda_id INT NOT NULL, meeting_user_id INT DEFAULT NULL, value VARCHAR(255) DEFAULT NULL, voted_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5A108564EA67784A ON vote (agenda_id)');
        $this->addSql('CREATE INDEX IDX_5A1085643FBC9B18 ON vote (meeting_user_id)');
        $this->addSql('ALTER TABLE agenda ADD CONSTRAINT FK_2CEDC87767433D9C FOREIGN KEY (meeting_id) REFERENCES meeting (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE has_voted ADD CONSTRAINT FK_29D1EFB6EA67784A FOREIGN KEY (agenda_id) REFERENCES agenda (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE has_voted ADD CONSTRAINT FK_29D1EFB63FBC9B18 FOREIGN KEY (meeting_user_id) REFERENCES meeting_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE meeting_user ADD CONSTRAINT FK_61622E9B67433D9C FOREIGN KEY (meeting_id) REFERENCES meeting (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE meeting_user ADD CONSTRAINT FK_61622E9BA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A108564EA67784A FOREIGN KEY (agenda_id) REFERENCES agenda (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A1085643FBC9B18 FOREIGN KEY (meeting_user_id) REFERENCES meeting_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE has_voted DROP CONSTRAINT FK_29D1EFB6EA67784A');
        $this->addSql('ALTER TABLE vote DROP CONSTRAINT FK_5A108564EA67784A');
        $this->addSql('ALTER TABLE agenda DROP CONSTRAINT FK_2CEDC87767433D9C');
        $this->addSql('ALTER TABLE meeting_user DROP CONSTRAINT FK_61622E9B67433D9C');
        $this->addSql('ALTER TABLE has_voted DROP CONSTRAINT FK_29D1EFB63FBC9B18');
        $this->addSql('ALTER TABLE vote DROP CONSTRAINT FK_5A1085643FBC9B18');
        $this->addSql('ALTER TABLE meeting_user DROP CONSTRAINT FK_61622E9BA76ED395');
        $this->addSql('DROP SEQUENCE agenda_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE has_voted_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE meeting_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE meeting_user_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE vote_id_seq CASCADE');
        $this->addSql('DROP TABLE agenda');
        $this->addSql('DROP TABLE has_voted');
        $this->addSql('DROP TABLE meeting');
        $this->addSql('DROP TABLE meeting_user');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE vote');
    }
}
