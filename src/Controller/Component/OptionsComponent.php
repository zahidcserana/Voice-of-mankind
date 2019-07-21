<?php
/**
 * Created by PhpStorm.
 * User: Mushfique
 * Date: 2/7/2018
 * Time: 12:12 PM
 */

namespace App\Controller\Component;


use Cake\Controller\Component;

class OptionsComponent extends Component {

    /**
     * @desc A story is usally a complain against one of the following types
     * @return array
     */
    public function getAgencyTypes(){
        return array(
            1 => 'Government Agency',
            2 => 'Local Business',
            3 => 'Citizen'
        );
    }

    public function getAgencyTypesForRadioField(){
        return [
            ['value' => 1, 'text' => 'Government Agency'],
            ['value' => 2, 'text' => 'Local Business'],
            ['value' => 3, 'text' => 'Citizen'],
        ];
    }

    public function getCategoryTypes(){
        return array(
            1 => 'Story',
            2 => 'List'
        );
    }
    
    public function getCategoryTypeByTitle($title){
        return array_search($title, $this->getCategoryTypes());
    }

    public function getCategoryByType($type = null){
        if($type){
            return array_search($type, $this->getCategoryTypes());
        }
    }

    public function getMediaTypes(){
        return array(
            1 => 'Image',
            2 => 'Youtube',
            3 => 'Others'
        );
    }
    
    public function getAdTypes(){
        return array(
            'Basic' => 'Basic',
            'Premium' => 'Premium',
            'Default' => 'Default'
        );
    }
    
    public function pagesForAd(){
        return array(
            'Users_login' => 'Login',
            'Users_signup' => 'Signup',
            'Stories_index' => 'Story Listing',
            'Stories_add' => 'Story Creation',
            'Stories_view' => 'Story Details',
            'ReformIdeas_index' => 'Reform Ideas'
        );
    }
    
    public function positionsForAd(){
        return array(
            'Users_login' => [
                1 => 'Page Center (550px x 400px)'
            ],
            'Users_signup' => [
                2 => 'Page Center (550px x 400px)'
            ],
            'Stories_index' => [
                3 => 'Top Right (270px x 270px)',
                4 => 'Page Middle Banner (845px x 200px)'
            ],
            'Stories_add' => [
                5 => 'Top Right (375px x 250px)',
                6 => 'Middle Right (375px x 250px)',
                7 => 'Bottom Right (375px x 250px)'
            ],
            'Stories_view' => [
                8 => 'Top Right (270px x 270px)',
                9 => 'Bottom Banner (1170px x 200px)'
            ] ,
            'ReformIdeas_index' => [
                10 => 'Right Side(250px x 750px)'
            ]           
        );
    }

    public function getMediaTypesForRadioField(){
        $mediaTypes = $this->getMediaTypes();
        $options = array();
        foreach($mediaTypes as $k => $v){
            $options[] = ['value' => $k, 'text' => $v];
        }
        return $options;
    }

    public function getStoryStatuses(){
        return array(
            1 => 'Active',
            2 => 'Inactive',
            3 => 'Pending',
            4 => 'Delete'
        );
    }

    public function getUserType(){
        return array(
            1 => 'Admin',
            2 => 'Member',
            3 => 'Citizen'
        );
    }

    public function getUserStatus(){
        return array(
            1 => 'Active',
            2 => 'Inactive',
            3 => 'Pending',
            4 => 'Delete'
        );
    }

}