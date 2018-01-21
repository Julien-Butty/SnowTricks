<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180118181906 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, avatar VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, plain_password VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trick_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, tricks_video_id INT DEFAULT NULL, embed VARCHAR(255) NOT NULL, INDEX IDX_7CC7DA2C9DBDBE9 (tricks_video_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tricks (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, trick_group_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_E1D902C1A76ED395 (user_id), INDEX IDX_E1D902C19B875DF8 (trick_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chat (id INT AUTO_INCREMENT NOT NULL, tricks_id INT DEFAULT NULL, message VARCHAR(255) NOT NULL, date LONGTEXT NOT NULL, INDEX IDX_659DF2AA3B153154 (tricks_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chat_user (chat_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_2B0F4B081A9A7125 (chat_id), INDEX IDX_2B0F4B08A76ED395 (user_id), PRIMARY KEY(chat_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, trick_image_id INT DEFAULT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_C53D045F5876A1D2 (trick_image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C9DBDBE9 FOREIGN KEY (tricks_video_id) REFERENCES tricks (id)');
        $this->addSql('ALTER TABLE tricks ADD CONSTRAINT FK_E1D902C1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tricks ADD CONSTRAINT FK_E1D902C19B875DF8 FOREIGN KEY (trick_group_id) REFERENCES trick_group (id)');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AA3B153154 FOREIGN KEY (tricks_id) REFERENCES tricks (id)');
        $this->addSql('ALTER TABLE chat_user ADD CONSTRAINT FK_2B0F4B081A9A7125 FOREIGN KEY (chat_id) REFERENCES chat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chat_user ADD CONSTRAINT FK_2B0F4B08A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F5876A1D2 FOREIGN KEY (trick_image_id) REFERENCES tricks (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tricks DROP FOREIGN KEY FK_E1D902C1A76ED395');
        $this->addSql('ALTER TABLE chat_user DROP FOREIGN KEY FK_2B0F4B08A76ED395');
        $this->addSql('ALTER TABLE tricks DROP FOREIGN KEY FK_E1D902C19B875DF8');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C9DBDBE9');
        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AA3B153154');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F5876A1D2');
        $this->addSql('ALTER TABLE chat_user DROP FOREIGN KEY FK_2B0F4B081A9A7125');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE trick_group');
        $this->addSql('DROP TABLE video');
        $this->addSql('DROP TABLE tricks');
        $this->addSql('DROP TABLE chat');
        $this->addSql('DROP TABLE chat_user');
        $this->addSql('DROP TABLE image');
    }
}
