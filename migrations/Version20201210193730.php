<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201210193730 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE debt_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ruser_debt_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_fake_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE debt (id INT NOT NULL, user_receives_id INT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, name VARCHAR(255) NOT NULL, is_subscription BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DBBF0A83DCF44346 ON debt (user_receives_id)');
        $this->addSql('CREATE TABLE ruser_debt (id INT NOT NULL, debt_id INT NOT NULL, user_owe_id INT NOT NULL, amount DOUBLE PRECISION NOT NULL, month_subscription DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_56016F37240326A5 ON ruser_debt (debt_id)');
        $this->addSql('CREATE INDEX IDX_56016F37F33820DD ON ruser_debt (user_owe_id)');
        $this->addSql('CREATE TABLE user_fake (id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE debt ADD CONSTRAINT FK_DBBF0A83DCF44346 FOREIGN KEY (user_receives_id) REFERENCES user_fake (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ruser_debt ADD CONSTRAINT FK_56016F37240326A5 FOREIGN KEY (debt_id) REFERENCES debt (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ruser_debt ADD CONSTRAINT FK_56016F37F33820DD FOREIGN KEY (user_owe_id) REFERENCES user_fake (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE ruser_debt DROP CONSTRAINT FK_56016F37240326A5');
        $this->addSql('ALTER TABLE debt DROP CONSTRAINT FK_DBBF0A83DCF44346');
        $this->addSql('ALTER TABLE ruser_debt DROP CONSTRAINT FK_56016F37F33820DD');
        $this->addSql('DROP SEQUENCE debt_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ruser_debt_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_fake_id_seq CASCADE');
        $this->addSql('DROP TABLE debt');
        $this->addSql('DROP TABLE ruser_debt');
        $this->addSql('DROP TABLE user_fake');
    }
}
