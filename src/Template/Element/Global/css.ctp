<?php
$prefix = !empty($this->request->params['prefix']) ? $this->request->params['prefix'] . '_' : '';
$action = $prefix . $this->name . '_' . $this->template;
switch ($action) {
    case 'Stories_addDetails':
    case 'ReformIdeas_add':
    case 'ReformIdeas_edit':
        echo $this->Html->css('dropzone.css');
        echo $this->Html->css('/plugins/summernote/summernote.css');
        break;

    case 'Stories_index':
        echo $this->Html->css('bs-rating.css');
        break;

    case 'Stories_view':
        echo $this->Html->css('bs-rating.css');
        break;
    
    case 'Users_myStories':
        echo $this->Html->css('bs-rating.css');
        break;
    
    case 'Users_registerSuccess':
        ?>
        <style>
            .col-md-offset-3 {
                    margin-left: 0!important;
                }
        </style>
<?php
        break;
    case 'Stories_add':
        ?>

        <style>
            .postcontent, .sidebar, .col_full, .col_half, .col_one_third, .col_two_third, .col_three_fourth, .col_one_fourth, .col_one_fifth, .col_two_fifth, .col_three_fifth, .col_four_fifth, .col_one_sixth, .col_five_sixth {
                display: block;
                position: relative;
                margin-right: 4%;
                margin-bottom: 25px;
                float: left;
            }
        </style>
    <?php
    default:
        break;
}
?>