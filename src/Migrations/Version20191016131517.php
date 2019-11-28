<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191016131517 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE promotion ADD degree_id INT NOT NULL, ADD year_id INT NOT NULL, DROP degree, DROP year');
        $this->addSql('ALTER TABLE promotion ADD CONSTRAINT FK_C11D7DD1B35C5756 FOREIGN KEY (degree_id) REFERENCES degree (id)');
        $this->addSql('ALTER TABLE promotion ADD CONSTRAINT FK_C11D7DD140C1FEA7 FOREIGN KEY (year_id) REFERENCES year (id)');
        $this->addSql('CREATE INDEX IDX_C11D7DD1B35C5756 ON promotion (degree_id)');
        $this->addSql('CREATE INDEX IDX_C11D7DD140C1FEA7 ON promotion (year_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE promotion DROP FOREIGN KEY FK_C11D7DD1B35C5756');
        $this->addSql('ALTER TABLE promotion DROP FOREIGN KEY FK_C11D7DD140C1FEA7');
        $this->addSql('DROP INDEX IDX_C11D7DD1B35C5756 ON promotion');
        $this->addSql('DROP INDEX IDX_C11D7DD140C1FEA7 ON promotion');
        $this->addSql('ALTER TABLE promotion ADD degree VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD year VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP degree_id, DROP year_id');
    }
}
