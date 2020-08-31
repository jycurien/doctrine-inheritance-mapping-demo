<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200830200142 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_translation DROP FOREIGN KEY FK_2EEA2F087294869C');
        $this->addSql('DROP INDEX IDX_2EEA2F087294869C ON article_translation');
        $this->addSql('ALTER TABLE article_translation CHANGE article_id translatable_id INT NOT NULL');
        $this->addSql('ALTER TABLE article_translation ADD CONSTRAINT FK_2EEA2F082C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_2EEA2F082C2AC5D3 ON article_translation (translatable_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_translation DROP FOREIGN KEY FK_2EEA2F082C2AC5D3');
        $this->addSql('DROP INDEX IDX_2EEA2F082C2AC5D3 ON article_translation');
        $this->addSql('ALTER TABLE article_translation CHANGE translatable_id article_id INT NOT NULL');
        $this->addSql('ALTER TABLE article_translation ADD CONSTRAINT FK_2EEA2F087294869C FOREIGN KEY (article_id) REFERENCES article (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_2EEA2F087294869C ON article_translation (article_id)');
    }
}
