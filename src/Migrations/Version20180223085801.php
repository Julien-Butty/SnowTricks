<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180223085801 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tricks_chat (tricks_id INT NOT NULL, chat_id INT NOT NULL, INDEX IDX_83F947433B153154 (tricks_id), INDEX IDX_83F947431A9A7125 (chat_id), PRIMARY KEY(tricks_id, chat_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_chat (user_id INT NOT NULL, chat_id INT NOT NULL, INDEX IDX_1F1CBE63A76ED395 (user_id), INDEX IDX_1F1CBE631A9A7125 (chat_id), PRIMARY KEY(user_id, chat_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tricks_chat ADD CONSTRAINT FK_83F947433B153154 FOREIGN KEY (tricks_id) REFERENCES tricks (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tricks_chat ADD CONSTRAINT FK_83F947431A9A7125 FOREIGN KEY (chat_id) REFERENCES chat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_chat ADD CONSTRAINT FK_1F1CBE63A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_chat ADD CONSTRAINT FK_1F1CBE631A9A7125 FOREIGN KEY (chat_id) REFERENCES chat (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tricks_chat');
        $this->addSql('DROP TABLE user_chat');
    }
}
