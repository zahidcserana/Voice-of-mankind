<?php
use Migrations\AbstractMigration;

class AlterAgencies extends AbstractMigration
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
        $table=$this->table('agencies');
        $table->addColumn('sub_title','string',[
            'after'=> 'name',
            'default'=> null,
            'limit'=> 255,
            'null'=> true
        ]);
        $table->addColumn('head_title','string',[
            'after'=> 'website',
            'default'=> null,
            'limit'=> 100,
            'null'=> true
        ]);
        $table->addColumn('head_fname','string',[
            'after'=> 'head_title',
            'default'=> null,
            'limit'=> 255,
            'null'=> true
        ]);
        $table->addColumn('head_lname','string',[
            'after'=> 'head_fname',
            'default'=> null,
            'limit'=> 255,
            'null'=> true
        ]);
        $table->update();
    }
}
