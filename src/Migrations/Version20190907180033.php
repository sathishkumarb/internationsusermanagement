<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190907180033 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fos_user ADD user_created INT DEFAULT NULL, ADD user_updated INT DEFAULT NULL, ADD created_by VARCHAR(255) DEFAULT NULL, ADD updated_by VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A6479EA30A9B2 FOREIGN KEY (user_created) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A64799E9688FD FOREIGN KEY (user_updated) REFERENCES fos_user (id)');
        $this->addSql('CREATE INDEX IDX_957A6479EA30A9B2 ON fos_user (user_created)');
        $this->addSql('CREATE INDEX IDX_957A64799E9688FD ON fos_user (user_updated)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A6479EA30A9B2');
        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A64799E9688FD');
        $this->addSql('DROP INDEX IDX_957A6479EA30A9B2 ON fos_user');
        $this->addSql('DROP INDEX IDX_957A64799E9688FD ON fos_user');
        $this->addSql('ALTER TABLE fos_user DROP user_created, DROP user_updated, DROP created_by, DROP updated_by');
    }
}
