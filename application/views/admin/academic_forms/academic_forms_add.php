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
              &nbsp; Create/Update Report </h3>
          </div>

        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php 
            $admin_role_id = $this->session->userdata('admin_role_id');

            $this->load->view('admin/includes/_messages.php') ?>

            <?php echo form_open_multipart( base_url('admin/academic_forms')); ?>
                
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
                                        <label class="required" for="ball_manipulation">Ball manipulation</label>
                                        <select class="form-control" name="ball_manipulation" id="ball_manipulation" required="">
                                            <option value="">Select between Level 1-4</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" for="">Ball manipulation comments</label>
                                        
                                        <textarea class="form-control" rows="3" placeholder="Enter Ball manipulation comments" spellcheck="false" name="ball_manipulation_cmt" id="ball_manipulation_cmt"></textarea>
                                                                    
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="receiving_and_ball_control">Receiving and ball control</label>
                                        <select class="form-control" id="receiving_and_ball_control" name="receiving_and_ball_control" required="">
                                            <option value="">Select between Level 1-4</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" for="">Receiving and ball control comments</label>
                                        
                                        <textarea class="form-control" rows="3" placeholder="Enter Receiving and ball comments" spellcheck="false" name="receiving_and_ball_control_cmt" id="receiving_and_ball_control_cmt"></textarea>
                                                                    
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="quality_of_first_touch">Quality of First Touch</label>
                                        <select class="form-control" id="quality_of_first_touch" name="quality_of_first_touch" required="">
                                            <option value="">Select between Level 1-4</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" for="">Quality of First Touch comments</label>
                                        
                                        <textarea class="form-control" rows="3" placeholder="Enter Receiving and ball control comments" spellcheck="false" name="quality_of_first_touch_cmt" id="quality_of_first_touch_cmt"></textarea>
                                                                    
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="turning_with_the_ball">Turning with the ball</label>
                                        <select class="form-control" id="turning_with_the_ball" name="turning_with_the_ball" required="">
                                            <option value="">Select between Level 1-4</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" for="">Turning with the ball comments</label>
                                        
                                        <textarea class="form-control" rows="3" placeholder="Enter Turning with the ball comments" spellcheck="false" name="turning_with_the_ball_cmt" id="turning_with_the_ball_cmt"></textarea>
                                                                    
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="passing_short_range">Passing short range</label>
                                        <select class="form-control" id="passing_short_range" name="passing_short_range" required="">
                                            <option value="">Select between Level 1-4</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" for="">Passing short range comments</label>
                                        
                                        <textarea class="form-control" rows="3" placeholder="Enter Passing short range comments" spellcheck="false" name="passing_short_range_cmt" id="passing_short_range_cmt"></textarea>
                                                                    
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="passing_long_range">Passing long range</label>
                                        <select class="form-control" name="passing_long_range" id="passing_long_range" required="">
                                            <option value="">Select between Level 1-4</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" for="">Passing long range comments</label>
                                        
                                        <textarea class="form-control" rows="3" placeholder="Enter Passing long range comments" spellcheck="false" name="passing_long_range_cmt" id="passing_long_range_cmt"></textarea>
                                                                    
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="running_with_the_ball">Running with the ball</label>
                                        <select class="form-control" id="running_with_the_ball" name="running_with_the_ball" required="">
                                            <option value="">Select between Level 1-4</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" for="">Running with the ball comments</label>
                                        
                                        <textarea class="form-control" rows="3" placeholder="Enter Running with the ball comments" spellcheck="false" name="running_with_the_ball_cmt" id="running_with_the_ball_cmt"></textarea>
                                                                    
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="dribbling_technique">Dribbling technique</label>
                                        <select class="form-control" id="dribbling_technique" name="dribbling_technique" required="">
                                            <option value="">Select between Level 1-4</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" for="">Dribbling technique comments</label>
                                        
                                        <textarea class="form-control" rows="3" placeholder="Enter Dribbling technique comments" spellcheck="false" name="dribbling_technique_cmt" id="dribbling_technique_cmt"></textarea>
                                                                    
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="shooting">Shooting</label>
                                        <select class="form-control" id="shooting" name="shooting" required="">
                                            <option value="">Select between Level 1-4</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" for="">Shooting comments</label>
                                        
                                        <textarea class="form-control" rows="3" placeholder="Enter Shooting comments" spellcheck="false" name="shooting_cmt" id="shooting_cmt"></textarea>
                                                                    
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="heading">Heading</label>
                                        <select class="form-control" id="heading" name="heading" required="">
                                            <option value="">Select between Level 1-4</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" for="">Heading comments</label>
                                        
                                        <textarea class="form-control" rows="3" placeholder="Enter Heading comments" spellcheck="false" name="heading_cmt" id="heading_cmt"></textarea>
                                                                    
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="tackling">Tackling</label>
                                        <select class="form-control" id="tackling" name="tackling" required="">
                                            <option value="">Select between Level 1-4</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" for="">Tackling comments</label>
                                        
                                        <textarea class="form-control" rows="3" placeholder="Enter tackling comments" spellcheck="false" name="tackling_cmt" id="tackling_cmt"></textarea>
                                                                    
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="agility_balance_coordination">Agility, Balance, Co-ordination</label>
                                        <select class="form-control" id="agility_balance_coordination" name="agility_balance_coordination" required="">
                                            <option value="">Select between Level 1-4</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" for="">Agility, Balance, Co-ordination comments</label>
                                        
                                        <textarea class="form-control" rows="3" placeholder="Enter Agility, Balance, Co-ordination comments comments" spellcheck="false" name="agility_balance_coordination_cmt" id="agility_balance_coordination_cmt"></textarea>
                                                                    
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="speed">Speed</label>
                                        <select class="form-control" id="speed" name="speed" required="">
                                            <option value="">Select between Level 1-4</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" for="">Speed comments</label>
                                        
                                        <textarea class="form-control" rows="3" placeholder="Enter Speed comments comments" spellcheck="false" name="speed_cmt" id="speed_cmt"></textarea>
                                                                    
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="" for="">Further comments</label>
                                        
                                        <textarea class="form-control" rows="3" placeholder="Enter Further comments comments" spellcheck="false" name="further_cmt" id="further_cmt"></textarea>
                                                                    
                                    </div>
                                </div>

                            </div>
                        </div>
                        
                        
                        
                        <div class="card-footer">1=Excellent &nbsp;&nbsp;  2=Good &nbsp;&nbsp; 3=Satisfactory &nbsp;&nbsp; 4=Area for improvement</div>
                    </div>
                </div>
            </section>
            <!-- End Technical Overview -->
            
            <input type="submit" name="save_draft" id="save_btn" value="Save Draft" class="btn btn-primary" style="display: none;" formnovalidate>
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
        url:"<?php echo base_url(); ?>admin/academic_forms/form_v_json",
        dataType: 'json',
        data: "id_athle="+athlete_name+"&key_per="+performance_indicator+"&id_year="+year_val,
        success:function(result){
            $('#forms_id_save').val('');
            // $('#te_runn_ball option,#te_feinting option,#te_quality_toch option,#te_rec_under_pres option,#te_ball_manipu option').prop('selected', false);
            if(result.academic_forms_d_id){ 
                var forms_a_id = result.academic_forms_d_id; 
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
    

            $('#ball_manipulation_cmt').val('');
            $('#receiving_and_ball_control_cmt').val('');
            $('#quality_of_first_touch_cmt').val('');
            $('#turning_with_the_ball_cmt').val('');
            $('#passing_short_range_cmt').val('');
            $('#passing_long_range_cmt').val('');
            $('#running_with_the_ball_cmt').val('');
            $('#dribbling_technique_cmt').val('');
            $('#shooting_cmt').val('');
            $('#heading_cmt').val('');
            $('#tackling_cmt').val('');
            $('#agility_balance_coordination_cmt').val('');
            $('#speed_cmt').val('');
            $('#further_cmt').val('');

            $('#ball_manipulation option, #receiving_and_ball_control option,#quality_of_first_touch option,#turning_with_the_ball option,#passing_short_range option, #passing_long_range option, #running_with_the_ball option, #dribbling_technique option, #shooting option, #heading option, #tackling option, #agility_balance_coordination option, #speed option').prop('selected', false);

            if(result.techical_overview){
                var ball_manipulation = result.techical_overview['ball_manipulation'];
                var receiving_and_ball_control = result.techical_overview['receiving_and_ball_control'];
                var quality_of_first_touch = result.techical_overview['quality_of_first_touch'];
                var turning_with_the_ball = result.techical_overview['turning_with_the_ball'];
                var passing_short_range = result.techical_overview['passing_short_range'];
                var passing_long_range = result.techical_overview['passing_long_range'];
                var running_with_the_ball = result.techical_overview['running_with_the_ball'];
                var dribbling_technique = result.techical_overview['dribbling_technique'];
                var shooting = result.techical_overview['shooting'];
                var heading = result.techical_overview['heading'];
                var tackling = result.techical_overview['tackling'];
                var agility_balance_coordination = result.techical_overview['agility_balance_coordination'];
                var speed = result.techical_overview['speed'];

                var ball_manipulation_cmt = result.techical_overview['ball_manipulation_cmt'];
                var receiving_and_ball_control_cmt = result.techical_overview['receiving_and_ball_control_cmt'];
                var quality_of_first_touch_cmt = result.techical_overview['quality_of_first_touch_cmt'];
                var turning_with_the_ball_cmt = result.techical_overview['turning_with_the_ball_cmt'];
                var passing_short_range_cmt = result.techical_overview['passing_short_range_cmt'];
                var passing_long_range_cmt = result.techical_overview['passing_long_range_cmt'];
                var running_with_the_ball_cmt = result.techical_overview['running_with_the_ball_cmt'];
                var dribbling_technique_cmt = result.techical_overview['dribbling_technique_cmt'];
                var shooting_cmt = result.techical_overview['shooting_cmt'];
                var heading_cmt = result.techical_overview['heading_cmt'];
                var tackling_cmt = result.techical_overview['tackling_cmt'];
                var agility_balance_coordination_cmt = result.techical_overview['agility_balance_coordination_cmt'];
                var speed_cmt = result.techical_overview['speed_cmt'];
                var further_cmt = result.techical_overview['further_cmt'];


                $('#ball_manipulation option[value="'+ball_manipulation+'"]').prop('selected', true);        
                $('#receiving_and_ball_control option[value="'+receiving_and_ball_control+'"]').prop('selected', true);
                $('#quality_of_first_touch option[value="'+quality_of_first_touch+'"]').prop('selected', true);
                $('#turning_with_the_ball option[value="'+turning_with_the_ball+'"]').prop('selected', true);
                $('#passing_short_range option[value="'+passing_short_range+'"]').prop('selected', true);
                $('#passing_long_range option[value="'+passing_long_range+'"]').prop('selected', true);
                $('#running_with_the_ball option[value="'+running_with_the_ball+'"]').prop('selected', true);
                $('#dribbling_technique option[value="'+dribbling_technique+'"]').prop('selected', true);
                $('#shooting option[value="'+shooting+'"]').prop('selected', true);
                $('#heading option[value="'+heading+'"]').prop('selected', true);
                $('#tackling option[value="'+tackling+'"]').prop('selected', true);
                $('#agility_balance_coordination option[value="'+agility_balance_coordination+'"]').prop('selected', true);
                $('#speed option[value="'+speed+'"]').prop('selected', true);

                $('#ball_manipulation_cmt').val(ball_manipulation_cmt);
                $('#receiving_and_ball_control_cmt').val(receiving_and_ball_control_cmt);
                $('#quality_of_first_touch_cmt').val(quality_of_first_touch_cmt);
                $('#turning_with_the_ball_cmt').val(turning_with_the_ball_cmt);
                $('#passing_short_range_cmt').val(passing_short_range_cmt);
                $('#passing_long_range_cmt').val(passing_long_range_cmt);
                $('#running_with_the_ball_cmt').val(running_with_the_ball_cmt);
                $('#dribbling_technique_cmt').val(dribbling_technique_cmt);
                $('#shooting_cmt').val(shooting_cmt);
                $('#heading_cmt').val(heading_cmt);
                $('#tackling_cmt').val(tackling_cmt);
                $('#agility_balance_coordination_cmt').val(agility_balance_coordination_cmt);
                $('#speed_cmt').val(speed_cmt);
                $('#further_cmt').val(further_cmt);
                
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