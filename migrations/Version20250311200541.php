<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250311200541 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function preUp(Schema $schema): void
    {
        $this->addSql('CREATE DOMAIN year AS integer CONSTRAINT year_check CHECK ((VALUE >= 1901) AND (VALUE <= 2155))');
        $this->addSql("CREATE TYPE mpaa_rating AS ENUM ('G', 'PG', 'PG-13', 'R', 'NC-17')");
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE actor (actor_id SERIAL NOT NULL, first_name VARCHAR(45) NOT NULL, last_name VARCHAR(45) NOT NULL, last_update TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(actor_id))');
        $this->addSql('CREATE INDEX idx_actor_last_name ON actor (last_name)');
        $this->addSql('COMMENT ON COLUMN actor.last_update IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('CREATE TABLE address (address_id SERIAL NOT NULL, city_id INT DEFAULT NULL, address VARCHAR(50) NOT NULL, address2 VARCHAR(50) DEFAULT NULL, district VARCHAR(20) NOT NULL, postal_code VARCHAR(10) DEFAULT NULL, phone VARCHAR(20) NOT NULL, last_update TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(address_id))');
        $this->addSql('CREATE INDEX IDX_D4E6F818BAC62AF ON address (city_id)');
        $this->addSql('COMMENT ON COLUMN address.last_update IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('CREATE TABLE category (category_id SERIAL NOT NULL, name VARCHAR(25) NOT NULL, last_update TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(category_id))');
        $this->addSql('COMMENT ON COLUMN category.last_update IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('CREATE TABLE city (city_id SERIAL NOT NULL, country_id INT DEFAULT NULL, city VARCHAR(50) NOT NULL, last_update TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(city_id))');
        $this->addSql('CREATE INDEX IDX_2D5B0234F92F3E70 ON city (country_id)');
        $this->addSql('COMMENT ON COLUMN city.last_update IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('CREATE TABLE country (country_id SERIAL NOT NULL, country VARCHAR(50) NOT NULL, last_update TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(country_id))');
        $this->addSql('COMMENT ON COLUMN country.last_update IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('CREATE TABLE customer (customer_id SERIAL NOT NULL, address_id INT DEFAULT NULL, store_id INT DEFAULT NULL, first_name VARCHAR(45) NOT NULL, last_name VARCHAR(45) NOT NULL, email VARCHAR(50) NOT NULL, activebool BOOLEAN DEFAULT true NOT NULL, active SMALLINT DEFAULT NULL, create_date TIMESTAMP(0) WITH TIME ZONE NOT NULL, last_update TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(customer_id))');
        $this->addSql('CREATE INDEX IDX_81398E09F5B7AF75 ON customer (address_id)');
        $this->addSql('CREATE INDEX IDX_81398E09B092A811 ON customer (store_id)');
        $this->addSql('CREATE INDEX idx_customer_last_name ON customer (last_name)');
        $this->addSql('COMMENT ON COLUMN customer.create_date IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('COMMENT ON COLUMN customer.last_update IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('CREATE TABLE film (film_id SERIAL NOT NULL, language_id INT DEFAULT NULL, original_language_id INT DEFAULT NULL, title VARCHAR(128) NOT NULL, description TEXT DEFAULT NULL, release_year year NOT NULL, rental_duration SMALLINT DEFAULT 3 NOT NULL, rental_rate NUMERIC(4, 2) DEFAULT \'4.99\' NOT NULL, length SMALLINT DEFAULT NULL, replacement_cost NUMERIC(5, 2) DEFAULT \'19.99\' NOT NULL, rating mpaa_rating DEFAULT \'G\' NOT NULL, special_features text[] NOT NULL, fulltext tsvector NOT NULL, last_update TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(film_id))');
        $this->addSql('CREATE INDEX IDX_8244BE2282F1BAF4 ON film (language_id)');
        $this->addSql('CREATE INDEX IDX_8244BE2275FE5ADE ON film (original_language_id)');
        $this->addSql('CREATE INDEX idx_title ON film (title)');
        $this->addSql('COMMENT ON COLUMN film.last_update IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('CREATE TABLE film_actor (film_id INT NOT NULL, actor_id INT NOT NULL, last_update TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(film_id, actor_id))');
        $this->addSql('CREATE INDEX IDX_DD19A8A9567F5183 ON film_actor (film_id)');
        $this->addSql('CREATE INDEX IDX_DD19A8A910DAF24A ON film_actor (actor_id)');
        $this->addSql('COMMENT ON COLUMN film_actor.last_update IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('CREATE TABLE film_category (film_id INT NOT NULL, category_id INT NOT NULL, last_update TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(film_id, category_id))');
        $this->addSql('CREATE INDEX IDX_A4CBD6A8567F5183 ON film_category (film_id)');
        $this->addSql('CREATE INDEX IDX_A4CBD6A812469DE2 ON film_category (category_id)');
        $this->addSql('COMMENT ON COLUMN film_category.last_update IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('CREATE TABLE inventory (inventory_id SERIAL NOT NULL, film_id INT DEFAULT NULL, store_id INT DEFAULT NULL, last_update TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(inventory_id))');
        $this->addSql('CREATE INDEX IDX_B12D4A36567F5183 ON inventory (film_id)');
        $this->addSql('CREATE INDEX IDX_B12D4A36B092A811 ON inventory (store_id)');
        $this->addSql('COMMENT ON COLUMN inventory.last_update IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('CREATE TABLE language (language_id SERIAL NOT NULL, name VARCHAR(20) NOT NULL, last_update TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(language_id))');
        $this->addSql('COMMENT ON COLUMN language.last_update IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('CREATE TABLE rental (rental_id SERIAL NOT NULL, inventory_id INT DEFAULT NULL, customer_id INT DEFAULT NULL, staff_id INT DEFAULT NULL, rental_date TIMESTAMP(0) WITH TIME ZONE NOT NULL, return_date TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, last_update TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(rental_id))');
        $this->addSql('CREATE INDEX IDX_1619C27D9EEA759 ON rental (inventory_id)');
        $this->addSql('CREATE INDEX IDX_1619C27D9395C3F3 ON rental (customer_id)');
        $this->addSql('CREATE INDEX IDX_1619C27DD4D57CD ON rental (staff_id)');
        $this->addSql('COMMENT ON COLUMN rental.rental_date IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('COMMENT ON COLUMN rental.return_date IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('COMMENT ON COLUMN rental.last_update IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('CREATE TABLE staff (staff_id SERIAL NOT NULL, address_id INT DEFAULT NULL, store_id INT DEFAULT NULL, first_name VARCHAR(45) NOT NULL, last_name VARCHAR(45) NOT NULL, picture BYTEA DEFAULT NULL, email VARCHAR(50) NOT NULL, active BOOLEAN NOT NULL, username VARCHAR(32) NOT NULL, password VARCHAR(40) NOT NULL, last_update TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(staff_id))');
        $this->addSql('CREATE INDEX IDX_426EF392F5B7AF75 ON staff (address_id)');
        $this->addSql('CREATE INDEX IDX_426EF392B092A811 ON staff (store_id)');
        $this->addSql('COMMENT ON COLUMN staff.last_update IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('CREATE TABLE store (store_id SERIAL NOT NULL, manager_staff_id INT DEFAULT NULL, address_id INT DEFAULT NULL, last_update TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(store_id))');
        $this->addSql('CREATE INDEX IDX_FF575877F9272FA9 ON store (manager_staff_id)');
        $this->addSql('CREATE INDEX IDX_FF575877F5B7AF75 ON store (address_id)');
        $this->addSql('COMMENT ON COLUMN store.last_update IS \'(DC2Type:datetimetz_immutable)\'');
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
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (address_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09B092A811 FOREIGN KEY (store_id) REFERENCES store (store_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE2282F1BAF4 FOREIGN KEY (language_id) REFERENCES language (language_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE2275FE5ADE FOREIGN KEY (original_language_id) REFERENCES language (language_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE film_actor ADD CONSTRAINT FK_DD19A8A9567F5183 FOREIGN KEY (film_id) REFERENCES film (film_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE film_actor ADD CONSTRAINT FK_DD19A8A910DAF24A FOREIGN KEY (actor_id) REFERENCES actor (actor_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE film_category ADD CONSTRAINT FK_A4CBD6A8567F5183 FOREIGN KEY (film_id) REFERENCES film (film_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE film_category ADD CONSTRAINT FK_A4CBD6A812469DE2 FOREIGN KEY (category_id) REFERENCES category (category_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE inventory ADD CONSTRAINT FK_B12D4A36567F5183 FOREIGN KEY (film_id) REFERENCES film (film_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE inventory ADD CONSTRAINT FK_B12D4A36B092A811 FOREIGN KEY (store_id) REFERENCES store (store_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rental ADD CONSTRAINT FK_1619C27D9EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (inventory_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rental ADD CONSTRAINT FK_1619C27D9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (customer_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rental ADD CONSTRAINT FK_1619C27DD4D57CD FOREIGN KEY (staff_id) REFERENCES staff (staff_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE staff ADD CONSTRAINT FK_426EF392F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (address_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE staff ADD CONSTRAINT FK_426EF392B092A811 FOREIGN KEY (store_id) REFERENCES store (store_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE store ADD CONSTRAINT FK_FF575877F9272FA9 FOREIGN KEY (manager_staff_id) REFERENCES staff (staff_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE store ADD CONSTRAINT FK_FF575877F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (address_id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->upFullText();
    }

    private function upFullText(): void
    {
        $this->addSql('CREATE INDEX film_fulltext_idx ON film USING GIST (fulltext)');
        $this->addSql("CREATE TRIGGER film_fulltext_trigger BEFORE INSERT OR UPDATE ON public.film FOR EACH ROW EXECUTE FUNCTION tsvector_update_trigger('fulltext', 'pg_catalog.english', 'title', 'description');");
    }

    public function down(Schema $schema): void
    {
        $this->downFullText();

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE address DROP CONSTRAINT FK_D4E6F818BAC62AF');
        $this->addSql('ALTER TABLE city DROP CONSTRAINT FK_2D5B0234F92F3E70');
        $this->addSql('ALTER TABLE customer DROP CONSTRAINT FK_81398E09F5B7AF75');
        $this->addSql('ALTER TABLE customer DROP CONSTRAINT FK_81398E09B092A811');
        $this->addSql('ALTER TABLE film DROP CONSTRAINT FK_8244BE2282F1BAF4');
        $this->addSql('ALTER TABLE film DROP CONSTRAINT FK_8244BE2275FE5ADE');
        $this->addSql('ALTER TABLE film_actor DROP CONSTRAINT FK_DD19A8A9567F5183');
        $this->addSql('ALTER TABLE film_actor DROP CONSTRAINT FK_DD19A8A910DAF24A');
        $this->addSql('ALTER TABLE film_category DROP CONSTRAINT FK_A4CBD6A8567F5183');
        $this->addSql('ALTER TABLE film_category DROP CONSTRAINT FK_A4CBD6A812469DE2');
        $this->addSql('ALTER TABLE inventory DROP CONSTRAINT FK_B12D4A36567F5183');
        $this->addSql('ALTER TABLE inventory DROP CONSTRAINT FK_B12D4A36B092A811');
        $this->addSql('ALTER TABLE rental DROP CONSTRAINT FK_1619C27D9EEA759');
        $this->addSql('ALTER TABLE rental DROP CONSTRAINT FK_1619C27D9395C3F3');
        $this->addSql('ALTER TABLE rental DROP CONSTRAINT FK_1619C27DD4D57CD');
        $this->addSql('ALTER TABLE staff DROP CONSTRAINT FK_426EF392F5B7AF75');
        $this->addSql('ALTER TABLE staff DROP CONSTRAINT FK_426EF392B092A811');
        $this->addSql('ALTER TABLE store DROP CONSTRAINT FK_FF575877F9272FA9');
        $this->addSql('ALTER TABLE store DROP CONSTRAINT FK_FF575877F5B7AF75');
        $this->addSql('DROP TABLE actor');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE film');
        $this->addSql('DROP TABLE film_actor');
        $this->addSql('DROP TABLE film_category');
        $this->addSql('DROP TABLE inventory');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE rental');
        $this->addSql('DROP TABLE staff');
        $this->addSql('DROP TABLE store');
        $this->addSql('DROP TABLE messenger_messages');
    }

    private function downFullText(): void
    {
        $this->addSql('DROP INDEX film_fulltext_idx');
        $this->addSql("DROP TRIGGER film_fulltext_trigger");
    }

    public function postDown(Schema $schema): void
    {
        $this->addSql("DROP TYPE mpaa_rating");
        $this->addSql('DROP DOMAIN year');
    }
}
