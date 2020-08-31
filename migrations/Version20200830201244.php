<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200830201244 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_content_translation DROP FOREIGN KEY FK_11390C27B879726C');
        $this->addSql('DROP INDEX IDX_11390C27B879726C ON article_content_translation');
        $this->addSql('ALTER TABLE article_content_translation CHANGE article_content_id translatable_id INT NOT NULL');
        $this->addSql('ALTER TABLE article_content_translation ADD CONSTRAINT FK_11390C272C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES article_content (id)');
        $this->addSql('CREATE INDEX IDX_11390C272C2AC5D3 ON article_content_translation (translatable_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_content_translation DROP FOREIGN KEY FK_11390C272C2AC5D3');
        $this->addSql('DROP INDEX IDX_11390C272C2AC5D3 ON article_content_translation');
        $this->addSql('ALTER TABLE article_content_translation CHANGE translatable_id article_content_id INT NOT NULL');
        $this->addSql('ALTER TABLE article_content_translation ADD CONSTRAINT FK_11390C27B879726C FOREIGN KEY (article_content_id) REFERENCES article_content (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_11390C27B879726C ON article_content_translation (article_content_id)');
    }
}
