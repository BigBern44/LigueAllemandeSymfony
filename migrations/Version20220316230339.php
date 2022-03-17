<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220316230339 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ligue_stat (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, ligue_id INT DEFAULT NULL, defaite INT NOT NULL, victoire INT NOT NULL, taux_victoire DOUBLE PRECISION NOT NULL, INDEX IDX_5F690B97A76ED395 (user_id), INDEX IDX_5F690B974D7328E5 (ligue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ligue_stat ADD CONSTRAINT FK_5F690B97A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE ligue_stat ADD CONSTRAINT FK_5F690B974D7328E5 FOREIGN KEY (ligue_id) REFERENCES ligue (id)');
        $this->addSql('DROP TABLE ligue_user');
        $this->addSql('ALTER TABLE fight MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE fight DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE fight ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE user ADD ligue_stat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64949876B2D FOREIGN KEY (ligue_stat_id) REFERENCES ligue_stat (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64949876B2D ON user (ligue_stat_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64949876B2D');
        $this->addSql('CREATE TABLE ligue_user (ligue_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_F24222FF4D7328E5 (ligue_id), INDEX IDX_F24222FFA76ED395 (user_id), PRIMARY KEY(ligue_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ligue_user ADD CONSTRAINT FK_F24222FF4D7328E5 FOREIGN KEY (ligue_id) REFERENCES ligue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ligue_user ADD CONSTRAINT FK_F24222FFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE ligue_stat');
        $this->addSql('ALTER TABLE fight MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE fight DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE fight ADD PRIMARY KEY (id, user_id, ligue_id)');
        $this->addSql('ALTER TABLE ligue CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE messenger_messages CHANGE body body LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE headers headers LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE queue_name queue_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX IDX_8D93D64949876B2D ON `user`');
        $this->addSql('ALTER TABLE `user` DROP ligue_stat_id, CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE username username VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE avatar avatar VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE discord_id discord_id VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
