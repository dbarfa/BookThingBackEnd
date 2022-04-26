<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220426093416 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `read` (id INT AUTO_INCREMENT NOT NULL, works_id VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE read_user (read_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_8670A7037B4A21E (read_id), INDEX IDX_8670A70A76ED395 (user_id), PRIMARY KEY(read_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE to_read (id INT AUTO_INCREMENT NOT NULL, works_id VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE to_read_user (to_read_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_39C4DD01B92C9FEB (to_read_id), INDEX IDX_39C4DD01A76ED395 (user_id), PRIMARY KEY(to_read_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE read_user ADD CONSTRAINT FK_8670A7037B4A21E FOREIGN KEY (read_id) REFERENCES `read` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE read_user ADD CONSTRAINT FK_8670A70A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE to_read_user ADD CONSTRAINT FK_39C4DD01B92C9FEB FOREIGN KEY (to_read_id) REFERENCES to_read (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE to_read_user ADD CONSTRAINT FK_39C4DD01A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE read_user DROP FOREIGN KEY FK_8670A7037B4A21E');
        $this->addSql('ALTER TABLE to_read_user DROP FOREIGN KEY FK_39C4DD01B92C9FEB');
        $this->addSql('DROP TABLE `read`');
        $this->addSql('DROP TABLE read_user');
        $this->addSql('DROP TABLE to_read');
        $this->addSql('DROP TABLE to_read_user');
    }
}
