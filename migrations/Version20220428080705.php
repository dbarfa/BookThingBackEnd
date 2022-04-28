<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220428080705 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_98574167F6CB822A ON `read` (works_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7FB950A8F6CB822A ON to_read (works_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_98574167F6CB822A ON `read`');
        $this->addSql('DROP INDEX UNIQ_7FB950A8F6CB822A ON to_read');
    }
}
