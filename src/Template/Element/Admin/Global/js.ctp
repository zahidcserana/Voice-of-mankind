<?php
$prefix = !empty($this->request->params['prefix']) ? $this->request->params['prefix'] . '_' : '';
$action = $prefix . $this->name . '_' . $this->template;
//pr($this->request->params);exit;
switch ($action) {
    case 'Home_index':
       // echo $this->Html->script(array('/js/data-ajax.js'));
        break;
    case 'admin_Stories_addDetails':
    case 'admin_Stories_view':
        echo $this->Html->script('dropzone.js');
        //echo $this->Html->script('/plugins/summernote/summernote.js');
        break;

    case 'admin_Comments_viewComments':
    case 'admin_ReformIdeas_view':
        echo $this->Html->script('jquery.twbsPagination.min.js');
        break;

    case 'admin_Statezips_index':
    case 'admin_Zipcodes_index':
    case 'admin_Counties_index':
    case 'admin_Cities_index':
    case 'admin_States_index':
    case 'admin_Categories_listCategories':
    case 'admin_Categories_index':
    case 'admin_Stories_storiesByCategory':
    case 'admin_Stories_pending':
    case 'admin_Stories_todays':
    case 'admin_Stories_index':
    case 'admin_Users_inactiveUser':
    case 'admin_Users_todaysUser':
    case 'admin_Users_index':
    case 'admin_Agencies_index':
    case 'admin_Referrals_index':
    case 'admin_ReformIdeas_index':
    case 'admin_Referrals_todaysReferrals':
        echo $this->Html->script(array('bootstrap-datepicker.js'));
        ?>

        <script src="/plugins/datatable/jquery.dataTables.min.js"></script>
        <script src="/plugins/datatable/dataTables.responsive.min.js"></script>
        <?php
        echo $this->Datatable->load();
        ?>
        <script type="text/javascript">
            getData();
            $("#searchButton").click(function(){
                getData();
            });
        </script>
        <?php
        break;
    case 'admin_Ads_add':
        echo $this->Html->script(array('bootstrap-datepicker.js'));
        break;
    case 'admin_Ads_index':
        echo $this->Html->script(array('bootstrap-datepicker.js'));
        ?>

        <script src="/plugins/datatable/jquery.dataTables.min.js"></script>
        <script src="/plugins/datatable/dataTables.responsive.min.js"></script>
        <?php
        echo $this->Datatable->load();
        ?>
        <script type="text/javascript">
            getData();
            $("#searchButton").click(function(){
                getData();
            });
        </script>
        <?php
        break;
    default:
        break;
}
?>

