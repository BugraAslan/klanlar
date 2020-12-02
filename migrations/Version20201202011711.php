<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201202011711 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE building_description CHANGE building_id building_id INT UNSIGNED DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F0187FE64D2A7E12 ON building_description (building_id)');
        $this->addSql('ALTER TABLE building_icon CHANGE building_id building_id INT UNSIGNED DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C3B05E8F4D2A7E12 ON building_icon (building_id)');
        $this->addSql('ALTER TABLE building_output CHANGE building_id building_id INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE building_requirements CHANGE building_id building_id INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE command CHANGE source_village_id source_village_id INT UNSIGNED DEFAULT NULL, CHANGE target_village_id target_village_id INT UNSIGNED DEFAULT NULL, CHANGE target_player_id target_player_id INT UNSIGNED DEFAULT NULL, CHANGE source_player_id source_player_id INT UNSIGNED DEFAULT NULL, CHANGE command_type_id command_type_id INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE player_activation CHANGE player_id player_id INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE player_detail CHANGE player_id player_id INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE player_notification CHANGE player_id player_id INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE player_token CHANGE player_id player_id INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE player_village CHANGE loyalty loyalty SMALLINT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE player_world DROP FOREIGN KEY player_world_worl_id_fk');
        $this->addSql('ALTER TABLE player_world DROP FOREIGN KEY player_worl_player_id_fk');
        $this->addSql('DROP INDEX player_worl_player_id_fk ON player_world');
        $this->addSql('DROP INDEX player_world_worl_id_fk ON player_world');
        $this->addSql('ALTER TABLE player_world CHANGE player_id player_id INT NOT NULL, CHANGE world_id world_id INT NOT NULL');
        $this->addSql('ALTER TABLE unit_command CHANGE village_id village_id INT UNSIGNED DEFAULT NULL, CHANGE unit_id unit_id INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE unit_icon CHANGE unit_id unit_id INT UNSIGNED DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E952C881F8BD700D ON unit_icon (unit_id)');
        $this->addSql('ALTER TABLE unit_manufacturer CHANGE unit_id unit_id INT UNSIGNED DEFAULT NULL, CHANGE building_id building_id INT UNSIGNED DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EF9C044BF8BD700D ON unit_manufacturer (unit_id)');
        $this->addSql('ALTER TABLE village_building CHANGE village_id village_id INT UNSIGNED DEFAULT NULL, CHANGE building_id building_id INT UNSIGNED DEFAULT NULL, CHANGE building_level building_level SMALLINT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE village_resource CHANGE village_id village_id INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE village_unit CHANGE village_id village_id INT UNSIGNED DEFAULT NULL, CHANGE unit_id unit_id INT UNSIGNED DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_F0187FE64D2A7E12 ON building_description');
        $this->addSql('ALTER TABLE building_description CHANGE building_id building_id INT UNSIGNED NOT NULL');
        $this->addSql('DROP INDEX UNIQ_C3B05E8F4D2A7E12 ON building_icon');
        $this->addSql('ALTER TABLE building_icon CHANGE building_id building_id INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE building_output CHANGE building_id building_id INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE building_requirements CHANGE building_id building_id INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE command CHANGE source_village_id source_village_id INT UNSIGNED NOT NULL, CHANGE target_village_id target_village_id INT UNSIGNED NOT NULL, CHANGE command_type_id command_type_id INT UNSIGNED NOT NULL, CHANGE target_player_id target_player_id INT UNSIGNED NOT NULL, CHANGE source_player_id source_player_id INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE player_activation CHANGE player_id player_id INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE player_detail CHANGE player_id player_id INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE player_notification CHANGE player_id player_id INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE player_token CHANGE player_id player_id INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE player_village CHANGE loyalty loyalty SMALLINT UNSIGNED DEFAULT 100 NOT NULL');
        $this->addSql('ALTER TABLE player_world CHANGE player_id player_id INT UNSIGNED NOT NULL, CHANGE world_id world_id INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE player_world ADD CONSTRAINT player_world_worl_id_fk FOREIGN KEY (world_id) REFERENCES world (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE player_world ADD CONSTRAINT player_worl_player_id_fk FOREIGN KEY (player_id) REFERENCES player (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX player_worl_player_id_fk ON player_world (player_id)');
        $this->addSql('CREATE INDEX player_world_worl_id_fk ON player_world (world_id)');
        $this->addSql('ALTER TABLE unit_command CHANGE unit_id unit_id INT UNSIGNED NOT NULL, CHANGE village_id village_id INT UNSIGNED NOT NULL');
        $this->addSql('DROP INDEX UNIQ_E952C881F8BD700D ON unit_icon');
        $this->addSql('ALTER TABLE unit_icon CHANGE unit_id unit_id INT UNSIGNED NOT NULL');
        $this->addSql('DROP INDEX UNIQ_EF9C044BF8BD700D ON unit_manufacturer');
        $this->addSql('ALTER TABLE unit_manufacturer CHANGE unit_id unit_id INT UNSIGNED NOT NULL, CHANGE building_id building_id INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE village_building CHANGE building_id building_id INT UNSIGNED NOT NULL, CHANGE village_id village_id INT UNSIGNED NOT NULL, CHANGE building_level building_level SMALLINT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE village_resource CHANGE village_id village_id INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE village_unit CHANGE unit_id unit_id INT UNSIGNED NOT NULL, CHANGE village_id village_id INT UNSIGNED NOT NULL');
    }
}
