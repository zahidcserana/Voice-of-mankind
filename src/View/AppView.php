<?php
namespace App\View;

use Cake\View\View;

class AppView extends View
{
    /**
     * Initialization hook method.
     */
    public function initialize()
    {
        $prefix = !empty($this->request->params['prefix']) ? $this->request->params['prefix'] . '_' : '';
        $page = $prefix.$this->request->params['controller'].'_'.$this->request->params['action'];
        $tableId = '';
        $ajax['url'] = '';
        $columns = [];
        $order = [];
        $searchParamsID = [];
        if ($page == 'admin_Stories_index'){
            $tableId = 'StoriesTable';
            $ajax['url'] = '/admin/stories/getDataCake';
            $columns = ['id', 'title', 'user_id', 'created', 'agency_id','status', 'action'];
            $searchParamsID = ['id','title','user_id','created','agency_id','status','m_datepicker_1','agency_type','selectUser'];
            $order = '[[3,"DESC"]]';

        }
        else if ($page == 'admin_Stories_todays'){
            $tableId = 'StoriesTable';
            $ajax['url'] = '/admin/stories/getDataTodays';
            $columns = ['id', 'title', 'user_id', 'created', 'agency_id','status', 'action'];
            $searchParamsID = ['id','title','user_id','created','agency_id','status','m_datepicker_1','agency_type','selectUser'];
            $order = '[[3,"DESC"]]';

        }
        else if ($page == 'admin_Stories_storiesByCategory'){
            $tableId = 'StoriesTable';
            $ajax['url'] = '/admin/stories/getstoriesByCategory';
            $columns = ['id','category', 'title', 'user_id', 'created', 'agency_id','status'];
            $searchParamsID = ['id','title','user_id','created','agency_id','status','m_datepicker_1','agency_type','selectUser','category'];
            $order = '[[3,"DESC"]]';

        }
        else if ($page == 'admin_Stories_pending'){
            $tableId = 'StoriesTable';
            $ajax['url'] = '/admin/stories/getPending';
            $columns = ['id', 'title', 'user_id', 'created', 'agency_id','status', 'action'];
            $searchParamsID = ['id','title','user_id','created','agency_id','status','m_datepicker_1','agency_type','selectUser'];
            $order = '[[3,"DESC"]]';

        }
        elseif ($page == 'admin_Users_index'){
            $tableId = 'UsersTable';
            $ajax['url'] = '/admin/users/getDataCake';
            $columns = ['id', 'username', 'email','created','total_story','status', 'action'];
            $searchParamsID = ['username','email','created','status','m_datepicker_1'];
            $order = '[[0,"DESC"]]';
        }
        elseif ($page == 'admin_Users_todaysUser'){
            $tableId = 'UsersTable';
            $ajax['url'] = '/admin/users/getTodaysUser';
            $columns = ['id', 'username', 'email','created','total_story','status', 'action'];
            $searchParamsID = ['username','email','created','status','m_datepicker_1'];
            $order = '[[0,"DESC"]]';
        }
        elseif ($page == 'admin_Users_inactiveUser'){
            $tableId = 'UsersTable';
            $ajax['url'] = '/admin/users/getInactiveUser';
            $columns = ['id', 'username', 'email','created','total_story','status', 'action'];
            $searchParamsID = ['username','email','created','status','m_datepicker_1'];
            $order = '[[0,"DESC"]]';
        }
        elseif ($page == 'admin_Agencies_index'){
            //var_dump($page);exit();
            $tableId = 'AgenciesTable';
            $ajax['url'] = '/admin/agencies/getDataCake';
            $columns = ['id', 'name', 'email','type','status', 'action'];
            $searchParamsID = ['id','name','email','type','status'];
            $order = '[[0,"DESC"]]';
        }
        elseif ($page == 'admin_Referrals_index'){
            //var_dump($page);exit();
            $tableId = 'ReferralsTable';
            $ajax['url'] = '/admin/referrals/getDataCake';
            $columns = ['id','profession', 'name', 'email','state','status', 'action'];
            $searchParamsID = ['id','profession','name','email','state','status'];
            $order = '[[0,"DESC"]]';
        }
        elseif ($page == 'admin_Referrals_todaysReferrals'){
            $tableId = 'ReferralsTable';
            $ajax['url'] = '/admin/referrals/ajaxTodaysReferrals';
            $columns = ['id','profession','name','phone','email','address', 'state','status', 'pursue', 'story'];
            $searchParamsID = ['id','profession','name','phone','email','address', 'state','status'];
            $order = '[[0,"DESC"]]';
        }
        elseif ($page == 'admin_ReformIdeas_index'){
            //var_dump($page);exit();
            $tableId = 'ReformIdeasTable';
            $ajax['url'] = '/admin/reform-ideas/getDataCake';
            $columns = ['id','user_id', 'agency_id', 'idea','status', 'action'];
            $searchParamsID = ['id','selectUser','agency','idea','status'];
            $order = '[[0,"DESC"]]';
        }
        elseif ($page == 'admin_Categories_index'){
            //var_dump($page);exit();
            $tableId = 'CategoriesTable';
            $ajax['url'] = '/admin/categories/getDataCake';
            $columns = ['id','parent_id', 'title', 'type','created','status', 'action'];
            $searchParamsID = ['id', 'title', 'type','created','status', 'action','m_datepicker_1','parent'];
            $order = '[[0,"DESC"]]';
        }

        elseif ($page == 'admin_Categories_listCategories'){
            //var_dump($page);exit();
            $tableId = 'CategoriesTable';
            $ajax['url'] = '/admin/categories/getListDataCake';
            $columns = ['id','parent_id', 'title', 'type','created','status', 'action'];
            $searchParamsID = ['id', 'title', 'type','created','status', 'action','m_datepicker_1','parent'];
            $order = '[[0,"DESC"]]';
        }
        elseif ($page == 'admin_States_index'){
            //var_dump($page);exit();
            $tableId = 'StatesTable';
            $ajax['url'] = '/admin/states/getDataCake';
            $columns = ['name', 'latitude', 'longitude','created', 'action'];
           // $searchParamsID = ['id','name', 'latitude', 'longitude','created'];
            $order = '[[0,"DESC"]]';
        }
        elseif ($page == 'admin_Ads_index'){
            $tableId = 'AdsTable';
            $ajax['url'] = '/admin/ads/getAdlist';
            $columns = ['createdby','createdfor', 'page_name', 'ad_type','start_date','end_date','created','action'];
            // $searchParamsID = ['id','profession','name','email','state','status'];
            $order = '[[0,"DESC"]]';
        }
        elseif ($page == 'admin_Cities_index'){
            //var_dump($page);exit();
            $tableId = 'CitiesTable';
            $ajax['url'] = '/admin/cities/getDataCake';
            $columns = ['name','state','county', 'latitude', 'longitude', 'action'];
            // $searchParamsID = ['id','name', 'latitude', 'longitude','created'];
            $order = '[[0,"DESC"]]';
        }
        elseif ($page == 'admin_Counties_index'){
            //var_dump($page);exit();
            $tableId = 'CountiesTable';
            $ajax['url'] = '/admin/counties/getDataCake';
            $columns = ['name','state', 'latitude', 'longitude', 'action'];
            // $searchParamsID = ['id','name', 'latitude', 'longitude','created'];
            $order = '[[0,"DESC"]]';
        }
        elseif ($page == 'admin_Zipcodes_index'){
            //var_dump($page);exit();
            $tableId = 'ZipcodesTable';
            $ajax['url'] = '/admin/zipcodes/getDataCake';
            $columns = ['zip','latitude', 'longitude', 'action'];
            // $searchParamsID = ['id','name', 'latitude', 'longitude','created'];
            $order = '[[0,"DESC"]]';
        }
        elseif ($page == 'admin_Statezips_index'){
            //var_dump($page);exit();
            $tableId = 'StatezipsTable';
            $ajax['url'] = '/admin/statezips/getDataCake';
            $columns = ['zipcode','state', 'county','city', 'action'];
            // $searchParamsID = ['id','name', 'latitude', 'longitude','created'];
            $order = '[[0,"DESC"]]';
        }


        $searching = 'false';
        $ordering = 'true';
         //order by specific column. column serial starts from 0
        $pageLength = 10;
        // $lengthMenu = '[[10, 20, 25, 50, -1], [10, 20, 25, 50, "All"]]';
        $lengthMenu = '[[10, 20, 25, 50, -1], [10, 20, 25, 50, "All"]]';
        $lengthChange = 'false';
        $filter = '';
        $processing = 'true';
        $language = '{"processing":"loading.. <img src=\"/admin/img/loading-spinner-default.gif\">"}';
        // $columnSearch = [0,1,2];
        // $theadIdCoulmnSearch = 'searchColumn';

        $config = array('tableId' => $tableId, 'ajax' => $ajax, 'columns' => $columns, 'searching' => $searching, 'ordering' => $ordering, 'order' => $order,'pageLength' => $pageLength,'lengthMenu' => $lengthMenu,'filter' => $filter,'processing' => $processing,'language' => $language,'searchParamsID' => $searchParamsID,'lengthChange' => $lengthChange);
        $this->loadHelper('Datatable', $config);
    }
}
