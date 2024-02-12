<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240210113957 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post_category ADD CONSTRAINT FK_B9A190604B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_category ADD CONSTRAINT FK_B9A1906012469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE training_category ADD CONSTRAINT FK_E1290A56BEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE training_category ADD CONSTRAINT FK_E1290A5612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE training_training ADD CONSTRAINT FK_327799186C66B81C FOREIGN KEY (training_source) REFERENCES training (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE training_training ADD CONSTRAINT FK_327799187583E893 FOREIGN KEY (training_target) REFERENCES training (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE training_category DROP FOREIGN KEY FK_E1290A56BEFD98D1');
        $this->addSql('ALTER TABLE training_category DROP FOREIGN KEY FK_E1290A5612469DE2');
        $this->addSql('ALTER TABLE training_training DROP FOREIGN KEY FK_327799186C66B81C');
        $this->addSql('ALTER TABLE training_training DROP FOREIGN KEY FK_327799187583E893');
        $this->addSql('ALTER TABLE post_category DROP FOREIGN KEY FK_B9A190604B89032C');
        $this->addSql('ALTER TABLE post_category DROP FOREIGN KEY FK_B9A1906012469DE2');
    }
}
