<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200827140808 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_content_translation (id INT AUTO_INCREMENT NOT NULL, article_content_id INT NOT NULL, locale VARCHAR(10) NOT NULL, content_translation LONGTEXT NOT NULL, INDEX IDX_11390C27B879726C (article_content_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_content_translation ADD CONSTRAINT FK_11390C27B879726C FOREIGN KEY (article_content_id) REFERENCES article_content (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE article_content_translation');
    }
}
