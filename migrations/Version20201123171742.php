<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201123171742 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE building (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(55) NOT NULL, min_level SMALLINT UNSIGNED DEFAULT NULL, max_level SMALLINT UNSIGNED DEFAULT NULL, population_factor DOUBLE PRECISION DEFAULT \'1\', wood_factor DOUBLE PRECISION DEFAULT \'1\', clay_factor DOUBLE PRECISION DEFAULT \'1\', iron_factor DOUBLE PRECISION DEFAULT \'1\', time_factor DOUBLE PRECISION DEFAULT \'1\', base_build_time INT DEFAULT 1, wood_cost SMALLINT UNSIGNED DEFAULT NULL, clay_cost SMALLINT UNSIGNED DEFAULT NULL, iron_cost SMALLINT UNSIGNED DEFAULT NULL, population_cost SMALLINT UNSIGNED DEFAULT NULL, is_output TINYINT(1) NOT NULL, base_icon VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE building_output (id INT UNSIGNED AUTO_INCREMENT NOT NULL, building_id INT UNSIGNED DEFAULT NULL, output_factor DOUBLE PRECISION DEFAULT \'1\' NOT NULL, base_output SMALLINT UNSIGNED DEFAULT 1 NOT NULL, UNIQUE INDEX UNIQ_DC68CE754D2A7E12 (building_id), INDEX building_output_building_id_fk (building_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE building_requirements (id INT UNSIGNED AUTO_INCREMENT NOT NULL, building_id INT UNSIGNED DEFAULT NULL, required_building_id INT NOT NULL, required_level SMALLINT UNSIGNED NOT NULL, INDEX building_requirements_building_id_fk (building_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE command (id INT UNSIGNED AUTO_INCREMENT NOT NULL, source_village_id INT UNSIGNED DEFAULT NULL, target_village_id INT UNSIGNED DEFAULT NULL, command_type_id INT UNSIGNED DEFAULT NULL, target_player_id INT UNSIGNED DEFAULT NULL, source_player_id INT UNSIGNED DEFAULT NULL, arrival_date DATETIME DEFAULT NULL, return_date DATETIME DEFAULT NULL, is_arrival TINYINT(1) NOT NULL, is_return TINYINT(1) NOT NULL, INDEX IDX_8ECAEAD422B924A6 (source_village_id), INDEX IDX_8ECAEAD46CE18D13 (target_village_id), INDEX command_command_type_id_fk (command_type_id), INDEX command_player_id_fk (target_player_id), INDEX command_player_id_fk_2 (source_player_id), INDEX command_player_village_id_fk_ (source_player_id), INDEX command_player_village_id_fk_2 (target_player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE command_type (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(55) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE command_unit (id INT UNSIGNED AUTO_INCREMENT NOT NULL, command_id INT UNSIGNED DEFAULT NULL, unit_id INT UNSIGNED DEFAULT NULL, unit_count INT NOT NULL, UNIQUE INDEX UNIQ_7D11A2DEF8BD700D (unit_id), INDEX command_unit_command_id_fk (command_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player (id INT UNSIGNED AUTO_INCREMENT NOT NULL, username VARCHAR(20) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, premium INT DEFAULT NULL, created_date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player_activation (id INT UNSIGNED AUTO_INCREMENT NOT NULL, player_id INT UNSIGNED DEFAULT NULL, request_date DATETIME DEFAULT NULL, activation_code VARCHAR(6) DEFAULT NULL, activation_date DATETIME DEFAULT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_43CDE44A99E6F5DF (player_id), INDEX player_activation_player_id_fk (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player_detail (id INT UNSIGNED AUTO_INCREMENT NOT NULL, player_id INT UNSIGNED DEFAULT NULL, email_activation TINYINT(1) NOT NULL, last_login_date DATETIME DEFAULT NULL, last_active_date DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_B106E94D99E6F5DF (player_id), INDEX player_detail_player_id_fk (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player_notification (id INT UNSIGNED AUTO_INCREMENT NOT NULL, player_id INT UNSIGNED DEFAULT NULL, build_notification TINYINT(1) DEFAULT \'1\' NOT NULL, message_notification TINYINT(1) DEFAULT \'1\' NOT NULL, UNIQUE INDEX UNIQ_3F6926E899E6F5DF (player_id), INDEX player_notification_player_id_fk (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player_profile (id INT UNSIGNED AUTO_INCREMENT NOT NULL, player_id INT UNSIGNED DEFAULT NULL, age SMALLINT DEFAULT NULL, sex VARCHAR(10) DEFAULT NULL, description TEXT DEFAULT NULL, UNIQUE INDEX UNIQ_E0A3554A99E6F5DF (player_id), INDEX player_profile_player_id_fk (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player_token (id INT UNSIGNED AUTO_INCREMENT NOT NULL, player_id INT UNSIGNED DEFAULT NULL, access_token VARCHAR(512) DEFAULT NULL, refresh_token VARCHAR(255) DEFAULT NULL, expire_date DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_E045DA7D99E6F5DF (player_id), INDEX player_token_player_id_fk (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player_village (id INT UNSIGNED AUTO_INCREMENT NOT NULL, player_id INT UNSIGNED DEFAULT NULL, score SMALLINT UNSIGNED NOT NULL, coordinate_x SMALLINT UNSIGNED NOT NULL, coordinate_y SMALLINT UNSIGNED NOT NULL, continent SMALLINT UNSIGNED NOT NULL, INDEX player_village_player_id_fk (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player_world (id INT UNSIGNED AUTO_INCREMENT NOT NULL, player_id INT NOT NULL, world_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE report (id INT UNSIGNED AUTO_INCREMENT NOT NULL, report_type_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE report_type (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unit (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(55) NOT NULL, time_per_area SMALLINT DEFAULT NULL, cost_per_wood INT DEFAULT NULL, cost_per_clay INT DEFAULT NULL, cost_per_iron INT DEFAULT NULL, cost_per_population SMALLINT DEFAULT NULL, per_carrying_capacity SMALLINT DEFAULT NULL, attack_force SMALLINT DEFAULT NULL, general_defense_force SMALLINT DEFAULT NULL, cavalry_defense_force SMALLINT DEFAULT NULL, base_build_time SMALLINT DEFAULT NULL, base_icon VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE village_building (id INT UNSIGNED AUTO_INCREMENT NOT NULL, building_id INT UNSIGNED DEFAULT NULL, village_id INT UNSIGNED DEFAULT NULL, building_level SMALLINT UNSIGNED DEFAULT NULL, UNIQUE INDEX UNIQ_B211E2774D2A7E12 (building_id), INDEX village_building_building_id_fk (building_id), INDEX village_building_village_id_fk (village_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE village_resource (id INT UNSIGNED AUTO_INCREMENT NOT NULL, village_id INT UNSIGNED DEFAULT NULL, wood INT NOT NULL, clay INT NOT NULL, iron INT NOT NULL, UNIQUE INDEX UNIQ_EFEF77B55E0D5582 (village_id), INDEX village_resource_village_id_fk (village_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE village_unit (id INT UNSIGNED AUTO_INCREMENT NOT NULL, unit_id INT UNSIGNED DEFAULT NULL, village_id INT UNSIGNED DEFAULT NULL, unit_count SMALLINT UNSIGNED NOT NULL, UNIQUE INDEX UNIQ_A7621B7AF8BD700D (unit_id), INDEX village_unit_unit_id_fk (unit_id), INDEX village_unit_village_id_fk (village_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE world (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE building_output ADD CONSTRAINT FK_DC68CE754D2A7E12 FOREIGN KEY (building_id) REFERENCES building (id)');
        $this->addSql('ALTER TABLE building_requirements ADD CONSTRAINT FK_EB479F254D2A7E12 FOREIGN KEY (building_id) REFERENCES building (id)');
        $this->addSql('ALTER TABLE command ADD CONSTRAINT FK_8ECAEAD422B924A6 FOREIGN KEY (source_village_id) REFERENCES player_village (id)');
        $this->addSql('ALTER TABLE command ADD CONSTRAINT FK_8ECAEAD46CE18D13 FOREIGN KEY (target_village_id) REFERENCES player_village (id)');
        $this->addSql('ALTER TABLE command ADD CONSTRAINT FK_8ECAEAD42A26DF70 FOREIGN KEY (command_type_id) REFERENCES command_type (id)');
        $this->addSql('ALTER TABLE command ADD CONSTRAINT FK_8ECAEAD4AD5287F3 FOREIGN KEY (target_player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE command ADD CONSTRAINT FK_8ECAEAD4F1786611 FOREIGN KEY (source_player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE command_unit ADD CONSTRAINT FK_7D11A2DE33E1689A FOREIGN KEY (command_id) REFERENCES command (id)');
        $this->addSql('ALTER TABLE command_unit ADD CONSTRAINT FK_7D11A2DEF8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id)');
        $this->addSql('ALTER TABLE player_activation ADD CONSTRAINT FK_43CDE44A99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE player_detail ADD CONSTRAINT FK_B106E94D99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE player_notification ADD CONSTRAINT FK_3F6926E899E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE player_profile ADD CONSTRAINT FK_E0A3554A99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE player_token ADD CONSTRAINT FK_E045DA7D99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE player_village ADD CONSTRAINT FK_2F9880EF99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE village_building ADD CONSTRAINT FK_B211E2774D2A7E12 FOREIGN KEY (building_id) REFERENCES building (id)');
        $this->addSql('ALTER TABLE village_building ADD CONSTRAINT FK_B211E2775E0D5582 FOREIGN KEY (village_id) REFERENCES player_village (id)');
        $this->addSql('ALTER TABLE village_resource ADD CONSTRAINT FK_EFEF77B55E0D5582 FOREIGN KEY (village_id) REFERENCES player_village (id)');
        $this->addSql('ALTER TABLE village_unit ADD CONSTRAINT FK_A7621B7AF8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id)');
        $this->addSql('ALTER TABLE village_unit ADD CONSTRAINT FK_A7621B7A5E0D5582 FOREIGN KEY (village_id) REFERENCES player_village (id)');
        //$this->addSql('DROP TABLE table_name');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE building_output DROP FOREIGN KEY FK_DC68CE754D2A7E12');
        $this->addSql('ALTER TABLE building_requirements DROP FOREIGN KEY FK_EB479F254D2A7E12');
        $this->addSql('ALTER TABLE village_building DROP FOREIGN KEY FK_B211E2774D2A7E12');
        $this->addSql('ALTER TABLE command_unit DROP FOREIGN KEY FK_7D11A2DE33E1689A');
        $this->addSql('ALTER TABLE command DROP FOREIGN KEY FK_8ECAEAD42A26DF70');
        $this->addSql('ALTER TABLE command DROP FOREIGN KEY FK_8ECAEAD4AD5287F3');
        $this->addSql('ALTER TABLE command DROP FOREIGN KEY FK_8ECAEAD4F1786611');
        $this->addSql('ALTER TABLE player_activation DROP FOREIGN KEY FK_43CDE44A99E6F5DF');
        $this->addSql('ALTER TABLE player_detail DROP FOREIGN KEY FK_B106E94D99E6F5DF');
        $this->addSql('ALTER TABLE player_notification DROP FOREIGN KEY FK_3F6926E899E6F5DF');
        $this->addSql('ALTER TABLE player_profile DROP FOREIGN KEY FK_E0A3554A99E6F5DF');
        $this->addSql('ALTER TABLE player_token DROP FOREIGN KEY FK_E045DA7D99E6F5DF');
        $this->addSql('ALTER TABLE player_village DROP FOREIGN KEY FK_2F9880EF99E6F5DF');
        $this->addSql('ALTER TABLE command DROP FOREIGN KEY FK_8ECAEAD422B924A6');
        $this->addSql('ALTER TABLE command DROP FOREIGN KEY FK_8ECAEAD46CE18D13');
        $this->addSql('ALTER TABLE village_building DROP FOREIGN KEY FK_B211E2775E0D5582');
        $this->addSql('ALTER TABLE village_resource DROP FOREIGN KEY FK_EFEF77B55E0D5582');
        $this->addSql('ALTER TABLE village_unit DROP FOREIGN KEY FK_A7621B7A5E0D5582');
        $this->addSql('ALTER TABLE command_unit DROP FOREIGN KEY FK_7D11A2DEF8BD700D');
        $this->addSql('ALTER TABLE village_unit DROP FOREIGN KEY FK_A7621B7AF8BD700D');
        $this->addSql('CREATE TABLE table_name (column_1 INT DEFAULT NULL) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE building');
        $this->addSql('DROP TABLE building_output');
        $this->addSql('DROP TABLE building_requirements');
        $this->addSql('DROP TABLE command');
        $this->addSql('DROP TABLE command_type');
        $this->addSql('DROP TABLE command_unit');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE player_activation');
        $this->addSql('DROP TABLE player_detail');
        $this->addSql('DROP TABLE player_notification');
        $this->addSql('DROP TABLE player_profile');
        $this->addSql('DROP TABLE player_token');
        $this->addSql('DROP TABLE player_village');
        $this->addSql('DROP TABLE player_world');
        $this->addSql('DROP TABLE report');
        $this->addSql('DROP TABLE report_type');
        $this->addSql('DROP TABLE unit');
        $this->addSql('DROP TABLE village_building');
        $this->addSql('DROP TABLE village_resource');
        $this->addSql('DROP TABLE village_unit');
        $this->addSql('DROP TABLE world');
    }
}
