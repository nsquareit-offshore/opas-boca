<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datepicker/datepicker3.css">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
              &nbsp; Create/Update Development Plan Report </h3>
          </div>

        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php 
            $admin_role_id = $this->session->userdata('admin_role_id');

            $this->load->view('admin/includes/_messages.php') ?>

            <?php echo form_open_multipart( base_url('admin/development_plan_form')); ?>
                
            <!-- Select Key -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="row">
                            	<div class="col-md-4">
                                    <div class="form-group">
                                        <?php 
                                        
                                            if($admin_role_id == 6){
                                                $coach = get_coach_by_userid($this->session->userdata('user_id'));
                                                $team_arr = unserialize($coach['assign_team']); 
                                                ?>
                                                 <select class="form-control select2" name="select_athlete_name" id="select_athlete_name" required="">
                                                    <option value="">Select Athlete</option>
                                                    <?php 
                                                    foreach ($get_athlete as $key => $key_value) { 
                                                        $athlete_team_arr = unserialize($key_value['team_name']);
                                                        print_r($team_arr);
                                                        print_r($athlete_team_arr);
                                                        $match_team=array_intersect($team_arr,$athlete_team_arr);
                                                       
                                                        if(count($match_team) > 0){ ?>
                                                             <option value="<?= $key_value['id']; ?>"><?= $key_value['first_name']; ?> <?= $key_value['last_name']; ?></option>
                                                        <?php }
                                                     } ?>
                                                </select>
                                                <?php
                                            }else{
                                                ?>
                                                  <select class="form-control select2" name="select_athlete_name" id="select_athlete_name" required="">
                                                    <option value="">Select Athlete</option>
                                                    <?php foreach ($get_athlete as $key => $key_value) { ?>
                                                           
                                                    <option value="<?= $key_value['id']; ?>"><?= $key_value['first_name']; ?> <?= $key_value['last_name']; ?></option> 

                                                    <?php } ?>
                                                </select>
                                                <?php
                                            }
                                        ?>


                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control" name="select_qt_year" id="select_qt_year" required="" style="display: none;">
                                            <option value="">Select Year</option>
                                            <?php foreach ($get_quarter_year as $key => $key_q_value) { ?>
                                                   
                                            <option value="<?= $key_q_value['id']; ?>"><?= $key_q_value['year']; ?></option> 

                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            


                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--End Select Key -->
            <!-- <center id="view_only_msg" style="display: none;"><strong style='color:green'>View Only Not Editable<br></strong></center> -->
            <div class="form_contend" style="display: none;">
            <!-- Technical Overview -->
            <!-- Technical Overview -->
            <section class="content">
                <div class="container-fluid">

                    <div id="development_plan_items">

                        <!-- First Plan -->
                        <div class="card card-primary development-plan-item">

                            <div class="card-header">
                                <h3 class="card-title">Plan</h3>

                                <button type="button"
                                        class="btn btn-danger btn-sm float-right remove-development-plan"
                                        style="display:none;">
                                    <i class="fa fa-trash"></i> Remove
                                </button>
                            </div>

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label class="control-label required">
                                                Development Area 1
                                            </label>

                                            <input type="text"
                                                   name="development_area_1[]"
                                                   class="form-control"
                                                   placeholder="Development Area 1"
                                                   required>

                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label class="control-label required">
                                                Development Area 2
                                            </label>

                                            <input type="text"
                                                   name="development_area_2[]"
                                                   class="form-control"
                                                   placeholder="Development Area 2"
                                                   required>

                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">

                                            <label class="control-label">
                                                Individual Development Plan
                                            </label>

                                            <textarea
                                                name="individual_development_plan[]"
                                                class="form-control"
                                                rows="6"
                                                placeholder="Individual Development Plan"></textarea>

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">

                                            <label class="control-label">
                                                Remark
                                            </label>

                                            <textarea
                                                name="remark[]"
                                                class="form-control"
                                                rows="4"
                                                placeholder="Remark"></textarea>

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- Add More -->
                    <div class="mt-3 mb-3">

                        <button type="button"
                                class="btn btn-success"
                                id="add_development_plan">

                            <i class="fa fa-plus"></i>
                            Add More

                        </button>

                    </div>

                    <input type="hidden"
                           name="forms_id"
                           id="forms_id_save">

                </div>
            </section>
            <!-- End Technical Overview -->
            <!-- End Technical Overview -->
            
           
            <input type="submit" name="submit" id="sub_btn" value="Submit" class="btn btn-primary" style="display: none;">
            <input type="submit" name="submit" id="update_btn" value="Update" class="btn btn-primary" style="display: none;">
            </div>
            

            <!-- Ball Control -->
            <!-- End Ball Control -->

          <?php echo form_close(); ?>

        </div>  
      </div>
    </section> 

</div>

 <!-- bootstrap datepicker -->
  <script src="<?= base_url() ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>

<script>

$(document).on('change', '#select_athlete_name', function() {

    $('#select_qt_year').prop('selectedIndex', 0);

    $(".form_contend").hide();

    $('#view_only_msg').hide();

    if ($('#select_athlete_name').val() != '') {

        $("#select_qt_year").show();

    } else {

        $("#select_qt_year").hide();

    }

});


$(document).on('change', '#select_qt_year', function() {

    $(".form_contend").hide();

    $('#view_only_msg').hide();

});


/*
|--------------------------------------------------------------------------
| Fetch Development Plan
|--------------------------------------------------------------------------
*/
$(document).on(
    'change',
    '#key_performance_indicator, #select_qt_year, #select_athlete_name',
    function() {

        var tokenHash = $("input[name=csrf_test_name]").val();

        var performance_indicator = 5;

        var athlete_name = $('#select_athlete_name').val();

        var year_val = $('#select_qt_year').val();


        if (
            performance_indicator != '' &&
            athlete_name != '' &&
            year_val != ''
        ) {

            $(".form_contend").hide();


            /*
            |--------------------------------------------------------------------------
            | Enable form fields
            |--------------------------------------------------------------------------
            */
            // $('.form_contend select, .form_contend input')
            //     .prop('disabled', false);

            // $('.form_contend select, .form_contend textarea')
            //     .prop('disabled', false);


            /*
            |--------------------------------------------------------------------------
            | AJAX
            |--------------------------------------------------------------------------
            */
            $.ajax({

                type: 'POST',

                url: "<?php echo base_url(); ?>admin/development_plan_form/form_v_json",

                dataType: 'json',

                data:
                    "id_athle=" + athlete_name +
                    "&key_per=" + performance_indicator +
                    "&id_year=" + year_val,


                /*
                |--------------------------------------------------------------------------
                | SUCCESS
                |--------------------------------------------------------------------------
                */
                success: function(result) {


                    /*
                    |--------------------------------------------------------------------------
                    | Debug
                    |--------------------------------------------------------------------------
                    */
                    console.log('Forms ID:', result.debug_forms_id);

                    console.log(
                        'Technical Overview:',
                        result.techical_overview
                    );

                    console.log(
                        'Is Array:',
                        Array.isArray(result.techical_overview)
                    );

                    console.log(
                        'Count:',
                        result.techical_overview
                            ? result.techical_overview.length
                            : 0
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | Reset Forms ID
                    |--------------------------------------------------------------------------
                    */
                    $('#forms_id_save').val('');


                    if (result.development_plan_form_d_id) {

                        var forms_a_id =
                            result.development_plan_form_d_id;

                        $('#forms_id_save').val(forms_a_id);

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Active / Inactive Form
                    |--------------------------------------------------------------------------
                    */
                    if (result.is_active_form == 1) {

                        // $('.form_contend input:not(#forms_id_save), .form_contend textarea')
                        //     .prop('disabled', true);

                        $('#view_only_msg').show();

                        $('#sub_btn').hide();

                        $('#update_btn').show();

                    } else {

                        // $('.form_contend input, .form_contend textarea')
                        //     .prop('disabled', false);

                        $('#view_only_msg').hide();

                        $('#sub_btn').show();

                        $('#update_btn').hide();

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Get Technical Overview
                    |--------------------------------------------------------------------------
                    */
                    var technicalOverview = [];

                    if (
                        result.techical_overview &&
                        Array.isArray(result.techical_overview)
                    ) {

                        technicalOverview =
                            result.techical_overview;

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | IMPORTANT
                    |
                    | Remove all existing boxes before creating them again.
                    |--------------------------------------------------------------------------
                    */
                    $('#development_plan_items').html('');


                    /*
                    |--------------------------------------------------------------------------
                    | Create Existing Database Records
                    |--------------------------------------------------------------------------
                    */
                    if (technicalOverview.length > 0) {

                        $.each(
                            technicalOverview,
                            function(index, item) {

                                addDevelopmentPlanBox(
                                    item,
                                    index,
                                    true
                                );

                            }
                        );

                    }else {

    // No database records, show one empty box
    addDevelopmentPlanBox(
        {},
        0,
        false
    );

}


                    /*
                    |--------------------------------------------------------------------------
                    | ALWAYS CREATE ONE NEW EMPTY BOX
                    |--------------------------------------------------------------------------
                    |
                    | Example:
                    |
                    | Database = 2 records
                    |
                    | Record 1 -> Box 1
                    | Record 2 -> Box 2
                    | Empty     -> Box 3
                    |
                    |--------------------------------------------------------------------------
                    */
                    // addDevelopmentPlanBox(
                    //     {},
                    //     technicalOverview.length,
                    //     false
                    // );


                    /*
                    |--------------------------------------------------------------------------
                    | Show Form
                    |--------------------------------------------------------------------------
                    */
                    $(".form_contend").show();

                },


                /*
                |--------------------------------------------------------------------------
                | AJAX ERROR
                |--------------------------------------------------------------------------
                */
                error: function(xhr, status, error) {

                    console.log('AJAX Error:', error);

                    console.log(
                        'Response:',
                        xhr.responseText
                    );

                    $("#div_result").html("Error");


                    /*
                    |--------------------------------------------------------------------------
                    | Show one empty box
                    |--------------------------------------------------------------------------
                    */
                    $('#development_plan_items').html('');

                    addDevelopmentPlanBox(
                        {},
                        0,
                        false
                    );

                    $(".form_contend").show();

                },


                /*
                |--------------------------------------------------------------------------
                | AJAX FAIL
                |--------------------------------------------------------------------------
                */
                fail: function(status) {

                    $("#div_result").html("Fail");

                },


                /*
                |--------------------------------------------------------------------------
                | BEFORE SEND
                |--------------------------------------------------------------------------
                */
                beforeSend: function(d) {

                    $('#div_result').html(
                        "<center><strong style='color:red'>" +
                        "Please Wait...<br>" +
                        "</strong></center>"
                    );

                }

            });

        }

    }
);


/*
|--------------------------------------------------------------------------
| Add More Button
|--------------------------------------------------------------------------
*/
$(document).on('click', '#add_development_plan', function(e) {

    e.preventDefault();


    /*
    |--------------------------------------------------------------------------
    | Get current number of boxes
    |--------------------------------------------------------------------------
    */
    var index =
        $('#development_plan_items .development-plan-item').length;


    /*
    |--------------------------------------------------------------------------
    | Add new empty box
    |--------------------------------------------------------------------------
    */
    addDevelopmentPlanBox(
        {},
        index,
        false
    );

});


/*
|--------------------------------------------------------------------------
| Remove Development Plan
|--------------------------------------------------------------------------
*/
$(document).on(
    'click',
    '.remove-development-plan',
    function(e) {

        e.preventDefault();

        $(this)
            .closest('.development-plan-item')
            .remove();


        /*
        |--------------------------------------------------------------------------
        | Make sure at least one box remains
        |--------------------------------------------------------------------------
        */
        if (
            $('#development_plan_items .development-plan-item')
                .length === 0
        ) {

            addDevelopmentPlanBox(
                {},
                0,
                false
            );

        }

    }
);


/*
|--------------------------------------------------------------------------
| Function: Add Development Plan Box
|--------------------------------------------------------------------------
|
| item:
| Existing database record OR empty object
|
| index:
| Current box number
|
| isExisting:
| true  = database record
| false = new empty record
|
|--------------------------------------------------------------------------
*/
function addDevelopmentPlanBox(
    item,
    index,
    isExisting
) {

        /*
        |--------------------------------------------------------------------------
        | Make sure item exists
        |--------------------------------------------------------------------------
        */
        item = item || {};


        /*
        |--------------------------------------------------------------------------
        | Get Values
        |--------------------------------------------------------------------------
        */
        var developmentArea1 =
            item.development_area_1 || '';


        var developmentArea2 =
            item.development_area_2 || '';


        var individualDevelopmentPlan =
            item.individual_development_plan || '';

        var remark =
            item.remark || '';
            
        /*
        |--------------------------------------------------------------------------
        | Remove Button
        |--------------------------------------------------------------------------
        |
        | First box does NOT have Remove button.
        |
        | Second, third, fourth... boxes DO have Remove button.
        |--------------------------------------------------------------------------
        */
        var removeButton = '';


        if (index > 0) {

            removeButton = `
                <button type="button"
                        class="btn btn-danger btn-sm float-right remove-development-plan">
                    <i class="fa fa-trash"></i> Remove
                </button>
            `;

        }


        /*
        |--------------------------------------------------------------------------
        | Create HTML
        |--------------------------------------------------------------------------
        */
        var html = `

            <div class="card card-primary development-plan-item">

                <div class="card-header">

                    <h3 class="card-title">
                        Plan
                    </h3>

                    ${removeButton}

                </div>


                <div class="card-body">

                    <div class="row">


                        <!-- Development Area 1 -->
                        <div class="col-md-6">

                            <div class="form-group">

                                <label class="control-label required">
                                    Development Area 1
                                </label>

                                <input type="text"
                                       name="development_area_1[]"
                                       class="form-control"
                                       value="${escapeHtml(developmentArea1)}"
                                       required>

                            </div>

                        </div>


                        <!-- Development Area 2 -->
                        <div class="col-md-6">

                            <div class="form-group">

                                <label class="control-label required">
                                    Development Area 2
                                </label>

                                <input type="text"
                                       name="development_area_2[]"
                                       class="form-control"
                                       value="${escapeHtml(developmentArea2)}"
                                       required>

                            </div>

                        </div>


                        <!-- Individual Development Plan -->
                        <div class="col-md-12">

                            <div class="form-group">

                                <label class="control-label">
                                    Individual Development Plan
                                </label>

                                <textarea
                                    name="individual_development_plan[]"
                                    class="form-control"
                                    rows="6"
                                    placeholder="Individual Development Plan">${escapeHtml(individualDevelopmentPlan)}</textarea>

                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="form-group">

                                <label class="control-label">
                                    Remark
                                </label>

                                <textarea
                                    name="remark[]"
                                    class="form-control"
                                    rows="4"
                                    placeholder="Remark">${escapeHtml(remark)}</textarea>

                            </div>
                        </div>

                    </div>

                </div>

            </div>

        `;


        /*
        |--------------------------------------------------------------------------
        | Append
        |--------------------------------------------------------------------------
        */
        $('#development_plan_items').append(html);

}


/*
|--------------------------------------------------------------------------
| Escape HTML
|--------------------------------------------------------------------------
|
| Prevent values containing quotes / special characters from
| breaking the generated HTML.
|--------------------------------------------------------------------------
*/
function escapeHtml(value) {

    if (
        value === null ||
        value === undefined
    ) {

        return '';

    }

    return $('<div>')
        .text(value)
        .html();

}

</script>

