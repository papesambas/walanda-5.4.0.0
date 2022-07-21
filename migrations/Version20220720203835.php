<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220720203835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE categories_publications');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories_publications (categories_id INT NOT NULL, publications_id INT NOT NULL, INDEX IDX_8C7D50E2A21214B7 (categories_id), INDEX IDX_8C7D50E2AFFB3979 (publications_id), PRIMARY KEY(categories_id, publications_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE categories_publications ADD CONSTRAINT FK_8C7D50E2A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categories_publications ADD CONSTRAINT FK_8C7D50E2AFFB3979 FOREIGN KEY (publications_id) REFERENCES publications (id) ON DELETE CASCADE');
    }
}
