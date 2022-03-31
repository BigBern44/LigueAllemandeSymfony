<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220326183642 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fight CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64949876B2D');
        $this->addSql('DROP INDEX IDX_8D93D64949876B2D ON user');
        $this->addSql('ALTER TABLE user DROP ligue_stat_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fight CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE ligue CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE messenger_messages CHANGE body body LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE headers headers LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE queue_name queue_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE `user` ADD ligue_stat_id INT DEFAULT NULL, CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE username username VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE avatar avatar VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE discord_id discord_id VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D64949876B2D FOREIGN KEY (ligue_stat_id) REFERENCES ligue_stat (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64949876B2D ON `user` (ligue_stat_id)');
    }
}
