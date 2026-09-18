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

            <?php echo form_open_multipart( base_url('admin/goalkeeper_forms')); ?>
                
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="hidden" name="forms_id" id="forms_id_save">

                                        <select class="form-control" name="key_performance_indicator" id="key_performance_indicator" required="" style="display: none;">
                                            <option value="">Select Key Performance Indicator</option>
                                            <?php foreach ($get_key_perf as $key => $key_value) { ?>
                                                   
                                            <option value="<?= $key_value['id']; ?>"><?= $key_value['name']; ?></option> 

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
                <h3 class="card-title forms_title_sup">Technical Overview</h3>
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Catching/Handling</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="ground_balls">Ground balls(scoop/smother)</label>
                                        <select class="form-control" name="ground_balls" id="ground_balls" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="chest_high_balls">Chest-high balls ("W")</label>
                                        <select class="form-control" id="chest_high_balls" name="chest_high_balls" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="bouncing_balls">Bouncing balls</label>
                                        <select class="form-control" id="bouncing_balls" name="bouncing_balls" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="tipping">Tipping</label>
                                        <select class="form-control" id="tipping" name="tipping" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="deflect_ball">Deflect Ball</label>
                                        <select class="form-control" id="deflect_ball" name="deflect_ball" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="reaction_saves">Reaction saves (point blank)</label>
                                        <select class="form-control" id="reaction_saves" name="reaction_saves" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-header">
                            <h3 class="card-title">Diving</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="to_the_left">To the left</label>
                                        <select class="form-control" name="to_the_left" id="to_the_left" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="to_the_right">To the right</label>
                                        <select class="form-control" id="to_the_right" name="to_the_right" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <div class="card-header">
                            <h3 class="card-title">Distribution</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="feet">Feet</label>
                                        <select class="form-control" id="feet" name="feet" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="drop_kick">Drop kick</label>
                                        <select class="form-control" name="drop_kick" id="drop_kick" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="goal_kick">Goal kick</label>
                                        <select class="form-control" name="goal_kick" id="goal_kick" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer">*Players scored on each Attribute Rating from 1 To 10.With 1 being the Lowest & 10 being the Highest</div>
                    </div>
                </div>
            </section>
            <!-- End Technical Overview -->
            

            <!-- Tactical Overview -->
            <section class="content">
                <h3 class="card-title forms_title_sup">Tactical Overview</h3>
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Positioning</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="stance">Stance</label>
                                        <select class="form-control" name="stance" id="stance" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="angle">Angle (effectiveness at narrowing)</label>
                                        <select class="form-control" id="angle" name="angle" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="card-header">
                                <h3 class="card-title">Defending</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="crossed_ball">Crossed Ball</label>
                                                <select class="form-control" id="crossed_ball" name="crossed_ball" required="">
                                                    <option value="">Select between Level 1-10</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="penalty_kick">Penalty kick</label>
                                                <select class="form-control" id="penalty_kick" name="penalty_kick" required="">
                                                    <option value="">Select between Level 1-10</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="corner_kick">Corner kick</label>
                                                <select class="form-control" id="corner_kick" name="corner_kick" required="">
                                                    <option value="">Select between Level 1-10</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="direct_indirect_free_kick">Direct/Indirect free kick</label>
                                                <select class="form-control" id="direct_indirect_free_kick" name="direct_indirect_free_kick" required="">
                                                    <option value="">Select between Level 1-10</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                                </select>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="card-header">
                                <h3 class="card-title">Decision Making</h3>
                            </div>
                            <div class="card-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="anticipation">Anticipation</label>
                                        <select class="form-control" id="anticipation" name="anticipation" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="coming_off_goal_line">Coming off goal line(timing)</label>
                                        <select class="form-control" id="coming_off_goal_line" name="coming_off_goal_line" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="using_the_back_pass_effectively">Using the back pass effectively</label>
                                        <select class="form-control" id="using_the_back_pass_effectively" name="using_the_back_pass_effectively" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="commanding_the_box">Commanding the box</label>
                                        <select class="form-control" id="commanding_the_box" name="commanding_the_box" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="organize_defense">Organize defense (ball far from goal)</label>
                                        <select class="form-control" id="organize_defense" name="organize_defense" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="handling_crosses">Handling crosses("Keeper"/"away")</label>
                                        <select class="form-control" id="handling_crosses" name="handling_crosses" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="vision_of_the_field">Vision of the field</label>
                                        <select class="form-control" id="vision_of_the_field" name="vision_of_the_field" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="control_pace">Control pace (quick counter/slow)</label>
                                        <select class="form-control" id="control_pace" name="control_pace" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="set_position_at_time_of_shot">"Set" position at time of shot</label>
                                        <select class="form-control" id="set_position_at_time_of_shot" name="set_position_at_time_of_shot" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">*Players scored on each Attribute Rating from 1 To 10.With 1 being the Lowest & 10 being the Highest</div>
                </div>
                
            </section>
            <!-- End Tactical Overview -->

            <!-- Physical Overview -->
            <section class="content">
                <h3 class="card-title forms_title_sup">Physical Overview</h3>
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="footwork">Footwork</label>
                                        <select class="form-control" id="footwork" name="footwork" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="agility">Agility(gracefulness)</label>
                                        <select class="form-control" id="agility" name="agility" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="explosiveness">Explosiveness (quickness)</label>
                                        <select class="form-control" id="explosiveness" name="explosiveness" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="coordination_and_body_control">Coordination and body control</label>
                                        <select class="form-control" id="coordination_and_body_control" name="coordination_and_body_control" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="reflex_speed">Reflex speed</label>
                                        <select class="form-control" id="reflex_speed" name="reflex_speed" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="card-footer">*Players performance on each Matric is Measured in Seconds</div>
                    </div>
                </div>
            </section>
            <!-- End Physical Overview -->

            <!-- Psychological Overview -->
            <section class="content">
                <h3 class="card-title forms_title_sup">Psychological Overview</h3>
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="composure">Composure (under pressure)</label>
                                        <select class="form-control" name="composure" id="composure" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="leadership">Leadership</label>
                                        <select class="form-control" name="leadership" id="leadership" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="bravery">Bravery</label>
                                        <select class="form-control" name="bravery" id="bravery" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="self_confidence">Self-confidence</label>
                                        <select class="form-control" name="self_confidence" id="self_confidence" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="game_mentality">Game mentality (Football Brain) S/W</label>
                                        <select class="form-control" name="game_mentality" id="game_mentality" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="work_rate">Work rate (effort)</label>
                                        <select class="form-control" name="work_rate" id="work_rate" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="communication_skills">Communication skills</label>
                                        <select class="form-control" name="communication_skills" id="communication_skills" required="">
                                            <option value="">Select between Level 1-10</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                                
                        <div class="card-footer">*Players scored on each Attribute Rating from 1 To 10.With 1 being the Lowest & 10 being the Highest</div>
                    </div>
                </div>
            </section>
            <!-- End Psychological Overview -->
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
        $("#key_performance_indicator").hide();   
    } else{
        $("#select_qt_year").hide();
        $("#key_performance_indicator").hide(); 
    }

});
$(document).on('change', '#select_qt_year', function() {
    $(".form_contend").hide();
    $('#view_only_msg').hide();
    $('#key_performance_indicator').prop('selectedIndex',0);
    if(jQuery('#select_qt_year').val() != ''){
        $("#key_performance_indicator").show();
    } else{
        $("#key_performance_indicator").hide();
    }
    
});

// $(document).on('change', '#select_athlete_name', function() {
//     var athlete_name = $('#select_athlete_name').val();
//     // console.log(athlete_name);
//      $.ajax({
//         type:'POST',
//         url:"<?php //echo base_url(); ?>admin/goalkeeper_forms/get_athlete_details",
//         dataType: 'json',
//         data: "id_athle="+athlete_name,
//         success:function(result){
            
//             if(result.athlet_details['team_program'] && result.athlet_details['team_program'] != null && result.athlet_details['team_program'] == "Residential"){
//                  //$(".residencewarden").show();   
//                 //console.log(result.athlet_details['team_program']);
//                 //$('#notes_frm_resi_war_education,#notes_frm_resi_war_discipline,#notes_frm_resi_war_hygiene,#notes_frm_resi_war_teamwork,#notes_frm_resi_war_diet,#notes_frm_resi_war_conduct').prop('disabled',false);

//             }else{
//                 //$('#notes_frm_resi_war_education,#notes_frm_resi_war_discipline,#notes_frm_resi_war_hygiene,#notes_frm_resi_war_teamwork,#notes_frm_resi_war_diet,#notes_frm_resi_war_conduct').prop('disabled',true);
//                 //$(".residencewarden").hide();  
             

//             }
//         },
//         error: function(result){
//             $("#div_result").html("Error"); 
//         },
//         fail:(function(status) {
//             $("#div_result").html("Fail");
//         }),
       
//     });
// });

$(document).on('change', '#key_performance_indicator, #select_qt_year,  #select_athlete_name', function() {
    var tokenHash=jQuery("input[name=csrf_test_name]").val();
    var performance_indicator = $('#key_performance_indicator').val();
    var athlete_name = $('#select_athlete_name').val();
    var year_val = $('#select_qt_year').val();
    /*
    $("#key_performance_indicator option[value=1]").removeAttr('disabled');
    $("#key_performance_indicator option[value=2]").removeAttr('disabled');
    $("#key_performance_indicator option[value=3]").removeAttr('disabled');
    $("#key_performance_indicator option[value=4]").removeAttr('disabled');

    if(athlete_name != '' && year_val != ''){
        $.ajax({
            type:'POST',
            url:"<?php //echo base_url(); ?>admin/goalkeeper_forms/submit_q_report",
            dataType: 'json',
            data: "id_athle="+athlete_name+"&id_year="+year_val,
            success:function(result){
                if(result == 1){
                    $("#key_performance_indicator option[value=2]").attr('disabled', 'disabled');
                    $("#key_performance_indicator option[value=3]").attr('disabled', 'disabled');
                    $("#key_performance_indicator option[value=4]").attr('disabled', 'disabled');
                }
                if(result == 2){
                    $("#key_performance_indicator option[value=3]").attr('disabled', 'disabled');
                    $("#key_performance_indicator option[value=4]").attr('disabled', 'disabled');
                }
                if(result == 3){
                    $("#key_performance_indicator option[value=4]").attr('disabled', 'disabled');
                }
            }
        });
    }*/

    if(performance_indicator != '' && athlete_name != '' && year_val != ''){
     $(".form_contend").hide();   

    $('.form_contend select,.form_contend input').prop('disabled',false);
    $.ajax({
        type:'POST',
        url:"<?php echo base_url(); ?>admin/goalkeeper_forms/form_v_json",
        dataType: 'json',
        data: "id_athle="+athlete_name+"&key_per="+performance_indicator+"&id_year="+year_val,
        success:function(result){
            $('#forms_id_save').val('');
            // $('#te_runn_ball option,#te_feinting option,#te_quality_toch option,#te_rec_under_pres option,#te_ball_manipu option').prop('selected', false);
            if(result.goalkeeper_forms_d_id){ 
                var forms_a_id = result.goalkeeper_forms_d_id; 
                $('#forms_id_save').val(forms_a_id);
            }
            if(result.is_active_form == 1){
                  $('.form_contend select,.form_contend input').prop('disabled',true);
               // $('#update_btn').show();
               $('#view_only_msg').show();
               
                $('#save_btn, #sub_btn').hide();
            } else{
                $('#view_only_msg').hide();
                $('#update_btn').hide();
                $('#save_btn, #sub_btn').show();
            }
            console.log(result.techical_overview);
    

            $('#ground_balls option, #chest_high_balls option,#bouncing_balls option, #tipping option,#deflect_ball option,#reaction_saves option, #to_the_left option, #to_the_right option, #feet option, #drop_kick option, #goal_kick option').prop('selected', false);

            if(result.techical_overview){
                var ground_balls = result.techical_overview['ground_balls'];
                var chest_high_balls = result.techical_overview['chest_high_balls'];
                var bouncing_balls = result.techical_overview['bouncing_balls'];
                var tipping = result.techical_overview['tipping'];
                var deflect_ball = result.techical_overview['deflect_ball'];
                var reaction_saves = result.techical_overview['reaction_saves'];
                var to_the_left = result.techical_overview['to_the_left'];
                var to_the_right = result.techical_overview['to_the_right'];
                var feet = result.techical_overview['feet'];
                var drop_kick = result.techical_overview['drop_kick'];
                var goal_kick = result.techical_overview['goal_kick'];
               

                $('#ground_balls option[value="'+ground_balls+'"]').prop('selected', true);;        
                $('#chest_high_balls option[value="'+chest_high_balls+'"]').prop('selected', true);;
                $('#bouncing_balls option[value="'+bouncing_balls+'"]').prop('selected', true);;
                $('#tipping option[value="'+tipping+'"]').prop('selected', true);;
                $('#deflect_ball option[value="'+deflect_ball+'"]').prop('selected', true);;
                $('#reaction_saves option[value="'+reaction_saves+'"]').prop('selected', true);;
                $('#to_the_left option[value="'+to_the_left+'"]').prop('selected', true);;
                $('#to_the_right option[value="'+to_the_right+'"]').prop('selected', true);;
                $('#feet option[value="'+feet+'"]').prop('selected', true);;
                $('#drop_kick option[value="'+drop_kick+'"]').prop('selected', true);;
                $('#goal_kick option[value="'+goal_kick+'"]').prop('selected', true);;
                
            }

            $('#stance option,#angle option,#crossed_ball option,#penalty_kick option,#corner_kick option,#direct_indirect_free_kick option,#anticipation option,#coming_off_goal_line option,#using_the_back_pass_effectively option,#commanding_the_box option,#organize_defense option,#handling_crosses option,#vision_of_the_field option,#control_pace option,#set_position_at_time_of_shot option').prop('selected', false);
            if(result.tactical_overview){
                var stance = result.tactical_overview['stance'];
                var angle = result.tactical_overview['angle'];
                var crossed_ball = result.tactical_overview['crossed_ball'];
                var penalty_kick = result.tactical_overview['penalty_kick'];
                var corner_kick = result.tactical_overview['corner_kick'];
                var direct_indirect_free_kick = result.tactical_overview['direct_indirect_free_kick'];
                var anticipation = result.tactical_overview['anticipation'];
                var coming_off_goal_line = result.tactical_overview['coming_off_goal_line'];
                var using_the_back_pass_effectively = result.tactical_overview['using_the_back_pass_effectively'];
                var commanding_the_box = result.tactical_overview['commanding_the_box'];
                var organize_defense = result.tactical_overview['organize_defense'];
                var handling_crosses = result.tactical_overview['handling_crosses'];
                var vision_of_the_field = result.tactical_overview['vision_of_the_field'];
                var control_pace = result.tactical_overview['control_pace'];
                var set_position_at_time_of_shot = result.tactical_overview['set_position_at_time_of_shot'];
               

                $('#stance option[value="'+stance+'"]').prop('selected', true);;
                $('#angle option[value="'+angle+'"]').prop('selected', true);;
                $('#crossed_ball option[value="'+crossed_ball+'"]').prop('selected', true);;
                $('#penalty_kick option[value="'+penalty_kick+'"]').prop('selected', true);;
                $('#corner_kick option[value="'+corner_kick+'"]').prop('selected', true);;
                $('#direct_indirect_free_kick option[value="'+direct_indirect_free_kick+'"]').prop('selected', true);;
                $('#anticipation option[value="'+anticipation+'"]').prop('selected', true);;
                $('#coming_off_goal_line option[value="'+coming_off_goal_line+'"]').prop('selected', true);;
                $('#using_the_back_pass_effectively option[value="'+using_the_back_pass_effectively+'"]').prop('selected', true);;
                $('#commanding_the_box option[value="'+commanding_the_box+'"]').prop('selected', true);;
                $('#organize_defense option[value="'+organize_defense+'"]').prop('selected', true);;
                $('#handling_crosses option[value="'+handling_crosses+'"]').prop('selected', true);;
                $('#vision_of_the_field option[value="'+vision_of_the_field+'"]').prop('selected', true);;
                $('#control_pace option[value="'+control_pace+'"]').prop('selected', true);;
                $('#set_position_at_time_of_shot option[value="'+set_position_at_time_of_shot+'"]').prop('selected', true);;
                
            }

            $('#footwork option,#agility option,#explosiveness option,#coordination_and_body_control option,#reflex_speed option').prop('selected', false);
            if(result.physical_overview){
                var footwork = result.physical_overview['footwork'];
                var agility = result.physical_overview['agility'];
                var explosiveness = result.physical_overview['explosiveness'];
                var coordination_and_body_control = result.physical_overview['coordination_and_body_control'];
                var reflex_speed = result.physical_overview['reflex_speed'];

                $('#footwork option[value="'+footwork+'"]').prop('selected', true);;
                $('#agility option[value="'+agility+'"]').prop('selected', true);;
                $('#explosiveness option[value="'+explosiveness+'"]').prop('selected', true);;
                $('#coordination_and_body_control option[value="'+coordination_and_body_control+'"]').prop('selected', true);;
                $('#reflex_speed option[value="'+reflex_speed+'"]').prop('selected', true);;
               
                
            }

            $('#composure option,#leadership option,#bravery option,#self_confidence option,#game_mentality option,#work_rate option,#communication_skills option').prop('selected', false);
            if(result.psychological_overview){
                var composure = result.psychological_overview['composure'];
                var leadership = result.psychological_overview['leadership'];
                var bravery = result.psychological_overview['bravery'];
                var self_confidence = result.psychological_overview['self_confidence'];
                var game_mentality = result.psychological_overview['game_mentality'];
                var work_rate = result.psychological_overview['work_rate'];
                var communication_skills = result.psychological_overview['communication_skills'];
                

                $('#composure option[value="'+composure+'"]').prop('selected', true);;
                $('#leadership option[value="'+leadership+'"]').prop('selected', true);;
                $('#bravery option[value="'+bravery+'"]').prop('selected', true);; 
                $('#self_confidence option[value="'+self_confidence+'"]').prop('selected', true);;
                $('#game_mentality option[value="'+game_mentality+'"]').prop('selected', true);;
                $('#work_rate option[value="'+work_rate+'"]').prop('selected', true);;
                $('#communication_skills option[value="'+communication_skills+'"]').prop('selected', true);;
               

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