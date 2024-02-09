<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240209134426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE partner (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, logo VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT DEFAULT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255) NOT NULL, is_actu TINYINT(1) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, meta VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE post_category (post_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_B9A190604B89032C (post_id), INDEX IDX_B9A1906012469DE2 (category_id), PRIMARY KEY(post_id, category_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE training (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, is_cpf TINYINT(1) DEFAULT NULL, slug VARCHAR(255) NOT NULL, duration VARCHAR(50) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL, prerequis LONGTEXT DEFAULT NULL, presentation LONGTEXT DEFAULT NULL, cpf_link VARCHAR(255) DEFAULT NULL, objectif LONGTEXT NOT NULL, certificate LONGTEXT DEFAULT NULL, strength LONGTEXT DEFAULT NULL, resources LONGTEXT DEFAULT NULL, faq JSON DEFAULT NULL, modality VARCHAR(255) DEFAULT NULL, is_home TINYINT(1) DEFAULT NULL, is_free TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE training_category (training_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_E1290A56BEFD98D1 (training_id), INDEX IDX_E1290A5612469DE2 (category_id), PRIMARY KEY(training_id, category_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE training_training (training_source INT NOT NULL, training_target INT NOT NULL, INDEX IDX_327799186C66B81C (training_source), INDEX IDX_327799187583E893 (training_target), PRIMARY KEY(training_source, training_target)) DEFAULT CHARACTER SET utf8mb4');
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
        $this->addSql('ALTER TABLE post_category DROP FOREIGN KEY FK_B9A190604B89032C');
        $this->addSql('ALTER TABLE post_category DROP FOREIGN KEY FK_B9A1906012469DE2');
        $this->addSql('ALTER TABLE training_category DROP FOREIGN KEY FK_E1290A56BEFD98D1');
        $this->addSql('ALTER TABLE training_category DROP FOREIGN KEY FK_E1290A5612469DE2');
        $this->addSql('ALTER TABLE training_training DROP FOREIGN KEY FK_327799186C66B81C');
        $this->addSql('ALTER TABLE training_training DROP FOREIGN KEY FK_327799187583E893');
        $this->addSql('DROP TABLE partner');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE post_category');
        $this->addSql('DROP TABLE training');
        $this->addSql('DROP TABLE training_category');
        $this->addSql('DROP TABLE training_training');
    }
}
