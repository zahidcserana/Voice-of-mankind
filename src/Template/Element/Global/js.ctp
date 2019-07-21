<?php
$prefix = !empty($this->request->params['prefix']) ? $this->request->params['prefix'] . '_' : '';
$action = $prefix . $this->name . '_' . $this->template;
switch ($action) {
    case 'Users_signup':
        ?>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <?php
        break;

    case 'Stories_addDetails':
    case 'ReformIdeas_add':
    case 'ReformIdeas_edit':
        echo $this->Html->script('dropzone.js');
        echo $this->Html->script('/plugins/summernote/summernote.js');
        break;

    case 'Stories_index':
        echo $this->Html->script('star-rating.js');
        break;

    case 'Users_myStories':
        echo $this->Html->script('star-rating.js');
        break;

    case 'ReformIdeas_view':
    case 'Stories_view':
        echo $this->Html->script('jquery.twbsPagination.min.js');
        echo $this->Html->script('star-rating.js');
        break;

    default:
        break;
}
?>

<script>
    function formatRepoAddr(repo) {
        if (repo.loading) return repo.text;

        return '<div style="margin-left:10px;"><i class="fa fa-address-card"></i>&nbsp;&nbsp;' + repo.text.address + '</div>';
    }

    function formatRepoSelectionAddr(repo) {
        var selected = $('#selectZipCode').select2('data');
        var zip = selected[0].name;
        $("#user_zip_code").val(zip);
        if (zip != '') {
            $.ajax({
                url: '/home/get-location-by-zip',
                type: 'POST',
                data: {zipcode: zip},
                success: function (response) {
                    //var parsed = $.parseJSON(response);
                    if (response.response == false) {
                        $("#zip-code-msg").show();
                    } else {
                        $("#zip-code-msg").hide();
                        $("#userLocationDiv").html(response);
                    }
                }
            });
        } else {
            $("#zip-code-msg").show();
        }
        return selected[0].name;
    }

    referrals = [];
    $("#selectZipCode").select2({
        placeHolder: '-- Select Location --',
        allowClear: true,
        ajax: {
            url: '/States/get-location-by-zip',
            dataType: 'json',
            data: function (params) {
                return {
                    term: params.term || '',
                    page: params.page || 1
                }
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                return {
                    results: $.map(data.results, function (item, i) {
                        referrals.push({id: i, val: item});
                        return {
                            text: item,
                            name: item.zip,
                            id: i
                        }
                    }),
                    pagination: {
                        more: (params.page * 10) < data.total_count
                    },
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) {
            var selected = $('#selectReferral').select2('data');
            return markup;
        },
        templateResult: formatRepoAddr,
        templateSelection: formatRepoSelectionAddr
    });

    jQuery(document).ready(function () {
        $("form[name='user-location-form']").validate({
            onkeyup: false,
            onfocusout: false,
            errorElement: false,
            rules: {
                state_id: {
                    required: true
                },
                county_id: {
                    required: true
                },
                city_id: {
                    required: true
                }
            },
            messages: {
                state_id: {required: 'Please Select a State'},
                county_id: {required: 'Please Select a County'},
                city_id: {required: 'Please Select a City'},
            },
            submitHandler: function (form) {
                $.ajax({
                    url: '/users/user-location',
                    type: 'POST',
                    data: $("#user-location-form").serialize(),
                    success: function (response) {
                        if (response.response) {
                            location.reload();
                            //$(".alert-info").show();
                            //$(".alert-info").html(response.msg);
                        }
                    }
                });
            }
        });
    });

    $(document.body).delegate('#state-id', 'change', function() {
        var state_id = $(this).val();
        $('#selectZipCode').select2();
        $("#user_zip_code").val('');
        if(state_id==''){
            state_id = 0;
        }
        $.ajax({
            url: '/users/get-county-by-state/' + state_id,
            type: 'POST',
            success: function (response) {
                //alert(response);
                $("#county-div").html(response);
            }
        });
    });
    $(document.body).delegate('#county-id', 'change', function() {
        var county_id = $(this).val();
        if(county_id==''){
            county_id = 0;
        }
        $.ajax({
            url: '/users/get-city-by-county/' + county_id,
            type: 'POST',
            success: function (response) {
                $("#city-div").html(response);
            }
        });
    });

</script>


