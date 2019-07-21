<?php
namespace App\Model\Table;

use App\Controller\Component\OptionsComponent;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class StatezipsTable extends Table
{

    /**
     * Initialize method
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('statezips');
        //$this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->belongsTo('states', [
            'foreignKey' => 'state_id'
        ]);
        $this->belongsTo('Counties', [
            'foreignKey' => 'county_id'
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id'
        ]);
        $this->belongsTo('Zipcodes', [
            'foreignKey' => 'zip_id'
        ]);

    }
}
