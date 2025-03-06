<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250306205824 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actor (actor_id SERIAL NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, last_update TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(actor_id))');
        $this->addSql('COMMENT ON COLUMN actor.last_update IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('CREATE TABLE address (address_id SERIAL NOT NULL, city_id INT DEFAULT NULL, address VARCHAR(255) NOT NULL, address2 VARCHAR(255) DEFAULT NULL, district VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, last_update TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(address_id))');
        $this->addSql('CREATE INDEX IDX_D4E6F818BAC62AF ON address (city_id)');
        $this->addSql('COMMENT ON COLUMN address.last_update IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('CREATE TABLE category (category_id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, last_update TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(category_id))');
        $this->addSql('COMMENT ON COLUMN category.last_update IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('CREATE TABLE city (city_id SERIAL NOT NULL, country_id INT DEFAULT NULL, city VARCHAR(255) NOT NULL, last_update TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(city_id))');
        $this->addSql('CREATE INDEX IDX_2D5B0234F92F3E70 ON city (country_id)');
        $this->addSql('COMMENT ON COLUMN city.last_update IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('CREATE TABLE country (country_id SERIAL NOT NULL, country VARCHAR(255) NOT NULL, last_update TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(country_id))');
        $this->addSql('COMMENT ON COLUMN country.last_update IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('CREATE TABLE language (language_id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, last_update TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(language_id))');
        $this->addSql('COMMENT ON COLUMN language.last_update IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F818BAC62AF FOREIGN KEY (city_id) REFERENCES city (city_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234F92F3E70 FOREIGN KEY (country_id) REFERENCES country (country_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE address DROP CONSTRAINT FK_D4E6F818BAC62AF');
        $this->addSql('ALTER TABLE city DROP CONSTRAINT FK_2D5B0234F92F3E70');
        $this->addSql('DROP TABLE actor');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
