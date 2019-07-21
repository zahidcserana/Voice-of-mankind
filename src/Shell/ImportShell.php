<?php

namespace App\Shell;

use Cake\Console\ConsoleOptionParser;
use Cake\Console\Shell;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;
use Psy\Shell as PsyShell;

class ImportShell extends Shell
{


    public function main()
    {

    }

    public function states($filename = '')
    {
        require_once ROOT . DS . 'vendor' . DS . 'excel' . DS . 'PHPExcel.php';
        require_once ROOT . DS . 'vendor' . DS . 'excel' . DS . 'PHPExcel' . DS . 'IOFactory.php';
        $dir = WWW_ROOT . 'files' . DS;
        $file = $dir . $filename;
        $excel_obj = \PHPExcel_IOFactory::createReaderForFile($file);
        $excel_obj->setReadDataOnly(true);
        $obj_excel = $excel_obj->load($file);
        $worksheet = $obj_excel->getSheet(0);
        foreach ($worksheet->getRowIterator() as $i => $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            foreach ($cellIterator as $j => $cell) {
                $sheet_data[$i][$j] = $newValue = strip_tags($cell->getValue());
            }
        }
        $statesObj = TableRegistry::get('States');
        $countiesObj = TableRegistry::get('Counties');
        $cityObj = TableRegistry::get('Cities');
        $zipcodeObj = TableRegistry::get('Zipcodes');
        $statezipsObj = TableRegistry::get('Statezips');
        foreach ($sheet_data as $i => $sh) {
            if ($i > 0) {
                $state = $statesObj->find()->where(['name' => $sh[15]])->first();
                $data = array('name' => $sh[15]);
                if (empty($state)) {
                    $state = $statesObj->newEntity();
                }
                $state = $statesObj->patchEntity($state, $data);
                $statesObj->save($state);
                $state_id = $state->id;

                // county
                $county = $countiesObj->find()->where(['state_id' => $state_id, 'name' => $sh[21]])->first();
                $data = array('state_id' => $state_id, 'name' => $sh[21]);
                if (empty($county)) {
                    $county = $countiesObj->newEntity();
                }
                $county = $countiesObj->patchEntity($county, $data);
                $countiesObj->save($county);
                $county_id = $county->id;

                // city
                $city = $cityObj->find()->where(['county_id' => $county_id, 'name' => $sh[14]])->first();
                $data = array('county_id' => $county_id, 'name' => $sh[14]);
                if (empty($city)) {
                    $city = $cityObj->newEntity();
                }
                $city = $cityObj->patchEntity($city, $data);
                $cityObj->save($city);
                $city_id = $city->id;

                //zipcode
                $zip = $zipcodeObj->find()->where(['zip' => $sh[16]])->first();
                $data = array('zip' => $sh[16]);
                if (empty($zip)) {
                    $zip = $zipcodeObj->newEntity();
                }
                $zip = $zipcodeObj->patchEntity($zip, $data);
                $zipcodeObj->save($zip);
                $zip_id = $zip->id;

                // state zipcode
                $zipstat = $statezipsObj->find()->where(['state_id' => $state_id, 'county_id' => $county_id,
                    'city_id' => $city_id, 'zip_id' => $zip_id])->first();
                $data = array('state_id' => $state_id, 'county_id' => $county_id,
                    'city_id' => $city_id, 'zip_id' => $zip_id);
                if (empty($zipstat)) {
                    $zipstat = $statezipsObj->newEntity();
                }
                $zipstat = $statezipsObj->patchEntity($zipstat, $data);
                $statezipsObj->save($zipstat);
            }
            //pr($sheet_data);
        }
    }


    public function agency($filename = '')
    {
        require_once ROOT . DS . 'vendor' . DS . 'excel' . DS . 'PHPExcel.php';
        require_once ROOT . DS . 'vendor' . DS . 'excel' . DS . 'PHPExcel' . DS . 'IOFactory.php';
        $dir = WWW_ROOT . 'files' . DS;
        $file = $dir . $filename;
        $excel_obj = \PHPExcel_IOFactory::createReaderForFile($file);
        $excel_obj->setReadDataOnly(true);
        $obj_excel = $excel_obj->load($file);
        $worksheet = $obj_excel->getSheet(0);
        foreach ($worksheet->getRowIterator() as $i => $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            foreach ($cellIterator as $j => $cell) {
                $sheet_data[$i][$j] = $newValue = strip_tags($cell->getValue());
            }
        }
        $statesObj = TableRegistry::get('States');
        $countiesObj = TableRegistry::get('Counties');
        $cityObj = TableRegistry::get('Cities');
        $zipcodeObj = TableRegistry::get('Zipcodes');
        $agenciesObj = TableRegistry::get('Agencies');
        foreach ($sheet_data as $i => $sh) {
            if ($i > 1) {
                $address = '';
                $agency_name = $sh[6];
                if (!empty($agency_name)) {
                    $agency = $agenciesObj->find()->where(['name' => $agency_name])->first();
                    $state = $statesObj->find()->where(['name' => $sh[15]])->first();
                    if (!empty($state)) {
                        $county = $countiesObj->find()->where(['state_id' => $state->id, 'name' => $sh[21]])->first();
                    }
                    if (!empty($county)) {
                        $city = $cityObj->find()->where(['county_id' => $county->id, 'name' => $sh[14]])->first();
                    }
                    $zip = $zipcodeObj->find()->where(['zip' => $sh[16]])->first();
                    $address = !empty($sh[7]) ? $sh[7] : '';
                    $address = !empty($sh[8]) ? $address . ', ' . $sh[8] : $address;
                    $agency_data = array(
                        'user_id' => 1,
                        'type' => 1,
                        'name' => $agency_name,
                        'sub_title' => $sh[1],
                        'email' => '',
                        'phone' => $sh[17],
                        'address' => $address,
                        'county_id' => !empty($county)? $county->id: NULL,
                        'city_id' => !empty($city) ? $city->id : NULL,
                        'state_id' => !empty($state) ? $state->id : NULL,
                        'zip_code' => $sh[16],
                        'website' => '',
                        'head_title' => $sh[5],
                        'head_fname' => $sh[2],
                        'head_lname' => !empty($sh[3]) ? $sh[3] . ' ' . $sh[4] : $sh[4],
                        'is_active' => 1,
                        'status' => 1
                    );
                    if (empty($agency)) {
                        $agency = $agenciesObj->newEntity();
                    }

                    $agency = $agenciesObj->patchEntity($agency, $agency_data);
                    $agenciesObj->save($agency);
                    pr($agency->id);
                 //   if($i==10) exit();
                }


            }
            //pr($sheet_data);
        }
    }
}
