<?php
$prefix = !empty($this->request->params['prefix']) ? $this->request->params['prefix'] . '_' : '';
$action = $prefix . $this->name . '_' . $this->template;
switch ($action) {
    case 'admin_Stories_addDetails':
    case 'admin_Stories_view':
        echo $this->Html->css('dropzone.css');
        //echo $this->Html->css('/plugins/summernote/summernote.css');
        break;

    case 'admin_Stories_userStory':
        ?>
        <style>
            .active {
                background: #716aca!important;
                border-radius: 50%!important;
                color: #ffffff!important;
            }
            .active a {
                color: #ffffff!important;
                text-decoration: none;
                background-color: transparent;
                -webkit-text-decoration-skip: objects;
            }
            .m-datatable.m-datatable--default > .m-datatable__pager > .m-datatable__pager-nav > li {
                padding: 8px;
                margin-right: 5px;
                display: inline-block;
            }
        </style>
        <?php
        break;

    case 'admin_Stories_view':
        ?>
        <style>
            .heading-block {
                color: #212529!important;
            }
            .panel-heading {
                color: turquoise;
            }
            .panel-heading h3 {
                font-size: 1.5rem!important;
            }
        </style>
        <?php
        break;

    case 'admin_Stories_add':
    case 'admin_Stories_edit':
        ?>
        <style>
            .m-form .m-form__group .form-control-label, .m-form .m-form__group label {
                font-weight: 400;
                font-size: 1rem;
                padding-left: 36px;
            }
        </style>
        <?php
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
        echo $this->Html->css('/plugins/datatable/jquery.dataTables.min.css');
        ?>
        <style>
            table.dataTable thead th, table.dataTable thead td {
                /*padding: 10px 18px;*/
                border-bottom: 1px solid #ffffff !important;
            }
            table.dataTable.no-footer {
                border-bottom: 1px solid #ffffff !important;
            }
            table.dataTable thead th {
                background-color  : #eee
            }

        </style>
        <?php
        break;

    case 'admin_Ads_index':
        echo $this->Html->css('/plugins/datatable/jquery.dataTables.min.css');
        ?>
        <style>
            table.dataTable thead th, table.dataTable thead td {
                /*padding: 10px 18px;*/
                border-bottom: 1px solid #ffffff !important;
            }
            table.dataTable.no-footer {
                border-bottom: 1px solid #ffffff !important;
            }
            table.dataTable thead th {
                background-color  : #eee
            }

        </style>
        <?php
        break;

    default:
        break;
}
?>

 <style>
    .th-15 {
        width: 15%;
    }
    .th-5 {
        width: 5%;
    }
    .th-10 {
        width: 10%;
    }
    .th-20 {
        width: 20%;
    }
</style>