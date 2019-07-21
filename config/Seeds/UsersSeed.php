<?php
use Migrations\AbstractSeed;

class UsersSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'user_type_id' => '1',
                'first_name'=>'Leaping',
                'last_name' => 'Logic',
                'email'=> 'admin@leapinglogic.com' ,
                'password'=>'$2y$10$jiFJQjtoYCWsag/OvCmhr.A5wh6svG/Gsvn6xuM87Alfj0pr3Al5e',//siterocks
                'state_id'=>'10',
                'county_id'=>'657',
                'city_id'=>'1745',
                'zip_code'=>'35801',
                'address'=>'fa',
                'status' => '1',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],

            [
                'id' => '2',
                'user_type_id' => '1',
                'first_name'=>'John',
                'last_name' => 'Deo',
                'email'=> 'admin1@leapinglogic.com' ,
                'password'=>'$2y$10$jiFJQjtoYCWsag/OvCmhr.A5wh6svG/Gsvn6xuM87Alfj0pr3Al5e',//siterocks
                'state_id'=>'10',
                'county_id'=>'657',
                'city_id'=>'1745',
                'zip_code'=>'99501',
                'address'=>'fa',
                'status' => '1',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],
            [
                'id' => '3',
                'user_type_id' => '2',
                'first_name'=>'Viky',
                'last_name' => 'John',
                'email'=> 'user@leapinglogic.com' ,
                'password'=>'$2y$10$jiFJQjtoYCWsag/OvCmhr.A5wh6svG/Gsvn6xuM87Alfj0pr3Al5e',//siterocks
                'state_id'=>'10',
                'county_id'=>'657',
                'city_id'=>'1746',
                'zip_code'=>'35801',
                'address'=>'fa',
                'status' => '1',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],
            [
                'id' => '4',
                'user_type_id' => '2',
                'first_name'=>'Abdur',
                'last_name' => 'Rahman',
                'email'=> 'dev@leapinglogic.com' ,
                'password'=>'$2y$10$jiFJQjtoYCWsag/OvCmhr.A5wh6svG/Gsvn6xuM87Alfj0pr3Al5e',//siterocks
                'state_id'=>'10',
                'county_id'=>'657',
                'city_id'=>'1746',
                'zip_code'=>'35801',
                'address'=>'fa',
                'status' => '1',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],
        ];
        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
