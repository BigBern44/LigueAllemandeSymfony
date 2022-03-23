<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220323211210 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fight (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, ligue_id INT NOT NULL, resultat TINYINT(1) DEFAULT NULL, INDEX IDX_21AA4456A76ED395 (user_id), INDEX IDX_21AA44564D7328E5 (ligue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligue (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligue_stat (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, ligue_id INT DEFAULT NULL, defaite INT NOT NULL, victoire INT NOT NULL, taux_victoire DOUBLE PRECISION NOT NULL, INDEX IDX_5F690B97A76ED395 (user_id), INDEX IDX_5F690B974D7328E5 (ligue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, ligue_stat_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, discord_id VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D64949876B2D (ligue_stat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fight ADD CONSTRAINT FK_21AA4456A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE fight ADD CONSTRAINT FK_21AA44564D7328E5 FOREIGN KEY (ligue_id) REFERENCES ligue (id)');
        $this->addSql('ALTER TABLE ligue_stat ADD CONSTRAINT FK_5F690B97A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE ligue_stat ADD CONSTRAINT FK_5F690B974D7328E5 FOREIGN KEY (ligue_id) REFERENCES ligue (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D64949876B2D FOREIGN KEY (ligue_stat_id) REFERENCES ligue_stat (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fight DROP FOREIGN KEY FK_21AA44564D7328E5');
        $this->addSql('ALTER TABLE ligue_stat DROP FOREIGN KEY FK_5F690B974D7328E5');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64949876B2D');
        $this->addSql('ALTER TABLE fight DROP FOREIGN KEY FK_21AA4456A76ED395');
        $this->addSql('ALTER TABLE ligue_stat DROP FOREIGN KEY FK_5F690B97A76ED395');
        $this->addSql('DROP TABLE fight');
        $this->addSql('DROP TABLE ligue');
        $this->addSql('DROP TABLE ligue_stat');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
