<?php
use Migrations\AbstractMigration;

class AlterMedia extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $this->execute('ALTER TABLE `media` CHANGE `file_name` `file_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL');
    }
}
