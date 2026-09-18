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
            <center id="view_only_msg" style="display: none;"><strong style='color:green'>View Only Not Editable<br></strong></center>
            <div class="form_contend" style="display: none;">
            <!-- Technical Overview -->
            <section class="content">
               
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Technical Skill</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="development_area_1" class="control-label required">Development Area 1</label>
                                        <input type="text" name="development_area_1" class="form-control" id="development_area_1" value="" placeholder="Development Area 1" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="development_area_2" class="control-label required">Development Area 2</label>
                                        <input type="text" name="development_area_2" class="form-control" id="development_area_2" value="" placeholder="Development Area 2" required>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="" for="">Individual Development Plan</label>
                                        
                                        <textarea class="form-control" rows="6" placeholder="Individual Development Plan" spellcheck="false" name="individual_development_plan" id="individual_development_plan"></textarea>
                                                                    
                                    </div>
                                </div>
                                 <input type="hidden" name="forms_id" id="forms_id_save">
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </section>
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
    $('#select_qt_year').prop('selectedIndex',0);
    $(".form_contend").hide();
    $('#view_only_msg').hide();
    if(jQuery('#select_athlete_name').val() != ''){
       
        $("#select_qt_year").show();
        
    } else{
        $("#select_qt_year").hide();
        
    }

});
$(document).on('change', '#select_qt_year', function() {
    $(".form_contend").hide();
    $('#view_only_msg').hide();
    
});


$(document).on('change', '#key_performance_indicator, #select_qt_year,  #select_athlete_name', function() {
    var tokenHash=jQuery("input[name=csrf_test_name]").val();
    var performance_indicator = 5;
    var athlete_name = $('#select_athlete_name').val();
    var year_val = $('#select_qt_year').val();
    

    if(performance_indicator != '' && athlete_name != '' && year_val != ''){
     $(".form_contend").hide();   

    $('.form_contend select,.form_contend input').prop('disabled',false);
    $('.form_contend select,.form_contend textarea').prop('disabled',false);
    $.ajax({
        type:'POST',
        url:"<?php echo base_url(); ?>admin/development_plan_form/form_v_json",
        dataType: 'json',
        data: "id_athle="+athlete_name+"&key_per="+performance_indicator+"&id_year="+year_val,
        success:function(result){

            $('#forms_id_save').val('');
            // $('#te_runn_ball option,#te_feinting option,#te_quality_toch option,#te_rec_under_pres option,#te_ball_manipu option').prop('selected', false);
            if(result.development_plan_form_d_id){ 
                var forms_a_id = result.development_plan_form_d_id; 
                $('#forms_id_save').val(forms_a_id);
            }
            if(result.is_active_form == 1){
                  $('.form_contend select,.form_contend input').prop('disabled',true);
                  $('.form_contend select,.form_contend textarea').prop('disabled',true);
               // $('#update_btn').show();
               $('#view_only_msg').show();
               
                $('#save_btn, #sub_btn').hide();
            } else{
                $('#view_only_msg').hide();
                $('#update_btn').hide();
                $('#save_btn, #sub_btn').show();
            }
            console.log(result.techical_overview);
    
            $('#development_area_1').val('');
            $('#development_area_2').val('');
            $('#individual_development_plan').val('');
           

            if(result.techical_overview){
          
                var development_area_1 = result.techical_overview['development_area_1'];
                var development_area_2 = result.techical_overview['development_area_2'];
                var individual_development_plan = result.techical_overview['individual_development_plan'];
               
                $('#development_area_1').val(development_area_1);
                $('#development_area_2').val(development_area_2);
                $('#individual_development_plan').val(individual_development_plan);
              
            }

           
            $(".form_contend").show();
        },
        error: function(result){
            $("#div_result").html("Error"); 
        },
        fail:(function(status) {
            $("#div_result").html("Fail");
        }),
        beforeSend:function(d){
        $('#div_result').html("<center><strong style='color:red'>Please Wait...<br></strong></center>");
        }
    });

    }
});


</script>