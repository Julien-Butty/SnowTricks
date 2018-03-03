<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180224115353 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE video ADD trick_video_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C4C1284F1 FOREIGN KEY (trick_video_id) REFERENCES trick (id)');
        $this->addSql('CREATE INDEX IDX_7CC7DA2C4C1284F1 ON video (trick_video_id)');
        $this->addSql('DROP INDEX IDX_659DF2AA3B153154 ON chat');
        $this->addSql('ALTER TABLE chat CHANGE tricks_id trick_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AAB281BE2E FOREIGN KEY (trick_id) REFERENCES trick (id)');
        $this->addSql('CREATE INDEX IDX_659DF2AAB281BE2E ON chat (trick_id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FB281BE2E FOREIGN KEY (trick_id) REFERENCES trick (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AAB281BE2E');
        $this->addSql('DROP INDEX IDX_659DF2AAB281BE2E ON chat');
        $this->addSql('ALTER TABLE chat CHANGE trick_id tricks_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_659DF2AA3B153154 ON chat (tricks_id)');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FB281BE2E');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C4C1284F1');
        $this->addSql('DROP INDEX IDX_7CC7DA2C4C1284F1 ON video');
        $this->addSql('ALTER TABLE video DROP trick_video_id');
    }
}
