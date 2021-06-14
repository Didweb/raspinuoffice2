<?php

declare(strict_types=1);

namespace RaspinuOffice\Shared\Infrastructure\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210614115152 extends AbstractMigration
{

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'CREATE TABLE label (
                                    id VARCHAR(255) NOT NULL, 
                                    name VARCHAR(255) NOT NULL, 
                                    UNIQUE INDEX UNIQ_EA750E85E237E06 (name), 
                                    PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 
                                    COLLATE `utf8_unicode_ci` ENGINE = InnoDB'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE label');
        $this->addSql(
            'ALTER TABLE genre CHANGE id id VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, CHANGE name name VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`'
        );
    }
}
