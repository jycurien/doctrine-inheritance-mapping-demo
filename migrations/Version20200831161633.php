<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200831161633 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_content_translation DROP FOREIGN KEY FK_11390C272C2AC5D3');
        $this->addSql('ALTER TABLE article_content_translation CHANGE translatable_id translatable_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article_content_translation ADD CONSTRAINT FK_11390C272C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES article_content (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_translation DROP FOREIGN KEY FK_2EEA2F082C2AC5D3');
        $this->addSql('ALTER TABLE article_translation CHANGE translatable_id translatable_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article_translation ADD CONSTRAINT FK_2EEA2F082C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES article (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_content_translation DROP FOREIGN KEY FK_11390C272C2AC5D3');
        $this->addSql('ALTER TABLE article_content_translation CHANGE translatable_id translatable_id INT NOT NULL');
        $this->addSql('ALTER TABLE article_content_translation ADD CONSTRAINT FK_11390C272C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES article_content (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE article_translation DROP FOREIGN KEY FK_2EEA2F082C2AC5D3');
        $this->addSql('ALTER TABLE article_translation CHANGE translatable_id translatable_id INT NOT NULL');
        $this->addSql('ALTER TABLE article_translation ADD CONSTRAINT FK_2EEA2F082C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES article (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
