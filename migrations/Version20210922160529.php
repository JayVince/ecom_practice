<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210922160529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE address_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE brand_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE city_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "order_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE address (id INT NOT NULL, id_user_id INT NOT NULL, id_city_id INT NOT NULL, postal_code VARCHAR(5) NOT NULL, country VARCHAR(255) NOT NULL, address_complement VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D4E6F8179F37AE5 ON address (id_user_id)');
        $this->addSql('CREATE INDEX IDX_D4E6F815531CBDF ON address (id_city_id)');
        $this->addSql('CREATE TABLE brand (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE city (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "order" (id INT NOT NULL, id_user_id INT NOT NULL, payment_method VARCHAR(255) NOT NULL, shipping_price DOUBLE PRECISION NOT NULL, total_price DOUBLE PRECISION NOT NULL, is_paid BOOLEAN NOT NULL, quantity SMALLINT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F529939879F37AE5 ON "order" (id_user_id)');
        $this->addSql('COMMENT ON COLUMN "order".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE product (id INT NOT NULL, id_brand_id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, price DOUBLE PRECISION NOT NULL, quantity SMALLINT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D34A04AD142E3C9D ON product (id_brand_id)');
        $this->addSql('COMMENT ON COLUMN product.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE product_category (product_id INT NOT NULL, category_id INT NOT NULL, PRIMARY KEY(product_id, category_id))');
        $this->addSql('CREATE INDEX IDX_CDFC73564584665A ON product_category (product_id)');
        $this->addSql('CREATE INDEX IDX_CDFC735612469DE2 ON product_category (category_id)');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F8179F37AE5 FOREIGN KEY (id_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F815531CBDF FOREIGN KEY (id_city_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F529939879F37AE5 FOREIGN KEY (id_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD142E3C9D FOREIGN KEY (id_brand_id) REFERENCES brand (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC73564584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC735612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD first_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD last_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD birth_date DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD street_number SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD avatar VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04AD142E3C9D');
        $this->addSql('ALTER TABLE product_category DROP CONSTRAINT FK_CDFC735612469DE2');
        $this->addSql('ALTER TABLE address DROP CONSTRAINT FK_D4E6F815531CBDF');
        $this->addSql('ALTER TABLE product_category DROP CONSTRAINT FK_CDFC73564584665A');
        $this->addSql('DROP SEQUENCE address_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE brand_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE city_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "order_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE product_id_seq CASCADE');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('ALTER TABLE "user" DROP first_name');
        $this->addSql('ALTER TABLE "user" DROP last_name');
        $this->addSql('ALTER TABLE "user" DROP birth_date');
        $this->addSql('ALTER TABLE "user" DROP street_number');
        $this->addSql('ALTER TABLE "user" DROP avatar');
    }
}
