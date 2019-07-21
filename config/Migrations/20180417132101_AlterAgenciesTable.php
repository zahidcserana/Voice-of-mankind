<?php
use Migrations\AbstractMigration;

class AlterAgenciesTable extends AbstractMigration
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
        $this->execute('ALTER TABLE `reform_ideas` CHANGE `agency_id` `agency_id` INT(11) NULL');
    }
}
