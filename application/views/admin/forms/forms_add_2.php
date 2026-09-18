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

            <?php echo form_open_multipart( base_url('admin/forms')); ?>
                
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
                                                        $athlete_playing_position = $key_value['playing_position'];
                                                         // if (strpos($athlete_playing_position, "goal") !== FALSE || strpos($athlete_playing_position, "Goal") !== FALSE) {
                                                         //   break;
                                                         // }
                                                        if (!preg_match("/goal/i", $athlete_playing_position)) {
                                                       

                                                        $match_team=array_intersect($team_arr,$athlete_team_arr);
                                                       
                                                        if(count($match_team) > 0){ ?>
                                                             <option value="<?= $key_value['id']; ?>"><?= $key_value['first_name']; ?> <?= $key_value['last_name']; ?></option>
                                                        <?php }
                                                         }
                                                     } ?>
                                                </select>
                                                <?php
                                            }else{
                                                ?>
                                                  <select class="form-control select2" name="select_athlete_name" id="select_athlete_name" required="">
                                                    <option value="">Select Athlete</option>
                                                    <?php foreach ($get_athlete as $key => $key_value) { 
                                                         echo $athlete_playing_position = $key_value['playing_position'];

                                                        if (!preg_match("/goal/i", $athlete_playing_position)) { ?>
                                                            <option value="<?= $key_value['id']; ?>"><?= $key_value['first_name']; ?> <?= $key_value['last_name']; ?></option> 
                                                        <?php }

                                                       
                                                         ?>
                                                           
                                                  

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
                            <h3 class="card-title">Dribbling</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="running_with_the_ball">Running With The Ball</label>
                                        <select class="form-control" name="running_with_the_ball" id="running_with_the_ball" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="feinting">Feinting</label>
                                        <select class="form-control" id="feinting" name="feinting" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            <h3 class="card-title">Ball Control</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="quality_of_first_touch">Quality Of First Touch</label>
                                        <select class="form-control" name="quality_of_first_touch" id="quality_of_first_touch" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="receiving_under_pressure">Receiving Under Pressure</label>
                                        <select class="form-control" id="receiving_under_pressure" name="receiving_under_pressure" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="ball_manipulation">Ball Manipulation</label>
                                        <select class="form-control" id="ball_manipulation" name="ball_manipulation" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            <h3 class="card-title">Passing</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="short_passing">Short Passing</label>
                                        <select class="form-control" name="short_passing" id="short_passing" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="long_passing">Long Passing</label>
                                        <select class="form-control" name="long_passing" id="long_passing" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="crossing">Crossing</label>
                                        <select class="form-control" name="crossing" id="crossing" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            <h3 class="card-title">Shooting</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="finishing_inside_the_penalty_area">Finishing Inside The Penalty Area</label>
                                        <select class="form-control" name="finishing_inside_the_penalty_area" id="finishing_inside_the_penalty_area" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="finishing_outside_the_penalty_area">Finishing Outside The Penalty Area</label>
                                        <select class="form-control" name="finishing_outside_the_penalty_area" id="finishing_outside_the_penalty_area" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="heading_at_goal">Heading At Goal</label>
                                        <select class="form-control" name="heading_at_goal" id="heading_at_goal" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
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
                                        <label class="required" for="tackling">Tackling</label>
                                        <select class="form-control" name="tackling" id="tackling" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="defensive_stance">Defensive Stance</label>
                                        <select class="form-control" name="defensive_stance" id="defensive_stance" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="defensive_heading">Defensive Heading</label>
                                        <select class="form-control" name="defensive_heading" id="defensive_heading" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="non_dominant_foot_ability">Non-dominant Foot Ability</label>
                                        <select class="form-control" name="non_dominant_foot_ability" id="non_dominant_foot_ability" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">*Players scored on each Attribute Rating from 1 To 5.With 1 being the Lowest & 5 being the Highest</div>
                    </div>
                </div>
            </section>
            <!-- End Technical Overview -->
            

            <!-- Tactical Overview -->
            <section class="content">
                <h3 class="card-title forms_title_sup">Tactical Overview</h3>
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="reading_of_the_game">Reading Of The Game</label>
                                        <select class="form-control" name="ta_reading_game" id="ta_reading_game" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="team_philosophy">Team Philosophy</label>
                                        <select class="form-control" id="team_philosophy" name="team_philosophy" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="attacking_principles">Attacking Principles</label>
                                        <select class="form-control" id="attacking_principles" name="attacking_principles" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="negative_transition_principles">Negative Transition Principles</label>
                                        <select class="form-control" id="negative_transition_principles" name="negative_transition_principles" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="defending_principles">Defending Principles</label>
                                        <select class="form-control" id="defending_principles" name="defending_principles" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="positive_transition_principles">Positive Transition Principles</label>
                                        <select class="form-control" id="positive_transition_principles" name="positive_transition_principles" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="player_position_role">Player Position & Role</label>
                                        <select class="form-control" id="player_position_role" name="player_position_role" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="set_piece_strategies">Set-piece Strategies</label>
                                        <select class="form-control" id="set_piece_strategies" name="set_piece_strategies" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">*Players scored on each Attribute Rating from 1 To 5.With 1 being the Lowest & 5 being the Highest</div>
                    </div>
                </div>
            </section>
            <!-- End Tactical Overview -->

            <!-- Physical Overview -->
            <section class="content">
                <h3 class="card-title forms_title_sup">Physical Overview</h3>
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Assessment With The Ball</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="with_speed_20m">Speed 20m.</label>
                                        <input class="form-control" name="with_speed_20m" id="with_speed_20m" min="0" required="" type="number" placeholder="Enter Value" step="any">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="with_speed_40m">Speed 40m.</label>
                                        <input class="form-control" name="with_speed_40m" id="with_speed_40m" min="0" required="" type="number" placeholder="Enter Value" step="any">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="with_arrowhead_agility_left_side">Arrowhead Agility (Left Side)</label>
                                        <input class="form-control" name="with_arrowhead_agility_left_side" id="with_arrowhead_agility_left_side" min="0" required="" type="number" placeholder="Enter Value" step="any">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="with_arrowhead_agility_right_side">Arrowhead Agility (Right Side)</label>
                                        <input class="form-control" name="with_arrowhead_agility_right_side" id="with_arrowhead_agility_right_side" min="0" required="" type="number" placeholder="Enter Value" step="any">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            <h3 class="card-title">Assessment Without The Ball</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="without_speed_20m">Speed 20m.</label>
                                        <input class="form-control" name="without_speed_20m" id="without_speed_20m" min="0" required="" type="number" placeholder="Enter Value" step="any">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="without_speed_40m">Speed 40m.</label>
                                        <input class="form-control" name="without_speed_40m" id="without_speed_40m" min="0" required="" type="number" placeholder="Enter Value" step="any">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="yo_yo_intermittent_recovery_test">Yo-yo Intermittent Recovery Test</label>
                                        <input class="form-control" name="yo_yo_intermittent_recovery_test" id="yo_yo_intermittent_recovery_test" min="0" required="" type="number" placeholder="Enter Value" step="any">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="without_arrowhead_agility_left_side">Arrowhead Agility (Left Side)</label>
                                        <input class="form-control" name="without_arrowhead_agility_left_side" id="without_arrowhead_agility_left_side" min="0" required="" type="number" placeholder="Enter Value" step="any">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="without_arrowhead_agility_right_side">Arrowhead Agility (Right Side)</label>
                                        <input class="form-control" name="without_arrowhead_agility_right_side" id="without_arrowhead_agility_right_side" min="0" required="" type="number" placeholder="Enter Value" step="any">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="vertical_jump">Vertical Jump</label>
                                        <input class="form-control" name="vertical_jump" id="vertical_jump" min="0" required="" type="number" placeholder="Enter Value">
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
                        <div class="card-header">
                            <h3 class="card-title">During Training</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="training_concentration_attention_span">Concentration & Attention Span</label>
                                        <select class="form-control" name="training_concentration_attention_span" id="training_concentration_attention_span" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="training_emotional_control">Emotional Control</label>
                                        <select class="form-control" name="training_emotional_control" id="training_emotional_control" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="training_self_confidence">Self-confidence</label>
                                        <select class="form-control" name="training_self_confidence" id="training_self_confidence" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="training_attitude_work_ethic">Attitude & Work Ethic</label>
                                        <select class="form-control" name="training_attitude_work_ethic" id="training_attitude_work_ethic" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="training_ability_to_understand_instructions">Ability To Understand Instructions</label>
                                        <select class="form-control" name="training_ability_to_understand_instructions" id="training_ability_to_understand_instructions" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="training_creativity_improvisation">Creativity & Improvisation</label>
                                        <select class="form-control" name="training_creativity_improvisation" id="training_creativity_improvisation" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="training_decision_making">Decision-making</label>
                                        <select class="form-control" name="training_decision_making" id="training_decision_making" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="training_leadership_responsibility">Leadership & Responsibility</label>
                                        <select class="form-control" name="training_leadership_responsibility" id="training_leadership_responsibility" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="training_preparations">Training Preparations</label>
                                        <select class="form-control" name="training_preparations" id="training_preparations" required="">
                                            <option value="">Select between Level 1-5</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                                <div class="card-header">
                                    <h3 class="card-title">During Matches</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="matches_concentration_task_focus">Concentration & Task Focus</label>
                                                <select class="form-control" name="matches_concentration_task_focus" id="matches_concentration_task_focus" required="">
                                                    <option value="">Select between Level 1-5</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="matches_emotional_control">Emotional Control</label>
                                                <select class="form-control" name="matches_emotional_control" id="matches_emotional_control" required="">
                                                    <option value="">Select between Level 1-5</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="matches_self_confidence">Self-confidence</label>
                                                <select class="form-control" name="matches_self_confidence" id="matches_self_confidence" required="">
                                                    <option value="">Select between Level 1-5</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="matches_attitude_work_ethic">Attitude & Work Ethic</label>
                                                <select class="form-control" name="matches_attitude_work_ethic" id="matches_attitude_work_ethic" required="">
                                                    <option value="">Select between Level 1-5</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="matches_ability_to_understand_instructions">Ability To Understand Instructions</label>
                                                <select class="form-control" name="matches_ability_to_understand_instructions" id="matches_ability_to_understand_instructions" required="">
                                                    <option value="">Select between Level 1-5</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="matches_creativity_improvisation">Creativity & Improvisation</label>
                                                <select class="form-control" name="matches_creativity_improvisation" id="matches_creativity_improvisation" required="">
                                                    <option value="">Select between Level 1-5</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="matches_decision_making">Decision-making</label>
                                                <select class="form-control" name="matches_decision_making" id="matches_decision_making" required="">
                                                    <option value="">Select between Level 1-5</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="matches_leadership_responsibility">Leadership & Responsibility</label>
                                                <select class="form-control" name="matches_leadership_responsibility" id="matches_leadership_responsibility" required="">
                                                    <option value="">Select between Level 1-5</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="match_preparation">Match Preparation</label>
                                                <select class="form-control" name="match_preparation" id="match_preparation" required="">
                                                    <option value="">Select between Level 1-5</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <div class="card-footer">*Players scored on each Attribute Rating from 1 To 5.With 1 being the Lowest & 5 being the Highest</div>
                    </div>
                </div>
            </section>
            <!-- End Psychological Overview -->

            <!-- Functional Movement Screen  -->
            <section class="content">
                <h3 class="card-title forms_title_sup">Functional Movement Screen</h3>
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="deep_squat">Deep Squat</label>
                                        <select class="form-control" name="deep_squat" id="deep_squat" required="">
                                            <option value="">Select between Level 1-3</option>
                                            <option value="NA">N/A</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="inline_lunge">Inline Lunge</label>
                                        <select class="form-control" name="inline_lunge" id="inline_lunge" required="">
                                            <option value="">Select between Level 1-3</option>
                                            <option value="NA">N/A</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="hurdle_crossing">Hurdle Crossing</label>
                                        <select class="form-control" name="hurdle_crossing" id="hurdle_crossing" required="">
                                            <option value="">Select between Level 1-3</option>
                                            <option value="NA">N/A</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="active_single_leg_raise">Active Single-Leg Raise</label>
                                        <select class="form-control" name="active_single_leg_raise" id="active_single_leg_raise" required="">
                                            <option value="">Select between Level 1-3</option>
                                            <option value="NA">N/A</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="trunk_stability_push_ups">Trunk Stability Push-Ups</label>
                                        <select class="form-control" name="trunk_stability_push_ups" id="trunk_stability_push_ups" required="">
                                            <option value="">Select between Level 1-3</option>
                                            <option value="NA">N/A</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="rotatory_stability">Rotatory Stability</label>
                                        <select class="form-control" name="rotatory_stability" id="rotatory_stability" required="">
                                            <option value="">Select between Level 1-3</option>
                                            <option value="NA">N/A</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">*Players scored on each Attribute Rating from 1 To 3.With 1 being the Lowest & 3 being the Highest</div>
                    </div>
                </div>
            </section>
            <!-- End Functional Movement Screen  -->
      
            <!-- Body Composition Analysis  -->
                        
            <section class="content">
                <h3 class="card-title forms_title_sup">Body Composition Analysis</h3>
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" for="">Height (cm.)</label>
                                        
                                        
                                        <input type="hidden" class="form-control" name="boday_com_hei_id_range" id="boday_height_range" placeholder="Enter Ideal Range" >
                                       
                                       
                                        <input type="number" class="form-control" min="1" name="boday_com_hei_val" id="boday_height_val" placeholder="Enter Value" > 
                                                                       
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" for="">Weight (kg.)</label>
                                        
                                        <input type="hidden" class="form-control" name="boday_com_weig_id_range" id="boday_weight_range" placeholder="Enter Ideal Range" >
                                        
                                        
                                        <input type="number" min="1" class="form-control" name="boday_com_weig_val" id="boday_weight_val" placeholder="Enter Value" > 
                                                                        
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="" for="">BMI (Body Mass Index)</label>
                                        <div class="row">
                                        <div class="col-md-6">
                                        <input type="text" class="form-control" name="boday_com_bmi_id_range" id="boday_bmi_range" placeholder="Enter Ideal Range" >
                                        </div>
                                        <div class="col-md-6">
                                        <input type="text" class="form-control" name="boday_com_bmi_val" id="boday_bmi_val" placeholder="Enter Value" >  </div>  
                                        </div>                                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </section>
            <!-- End Body Composition Analysis  -->

           <!-- Body Composition Analysis  -->
                        
            <section class="content">
                <h3 class="card-title forms_title_sup">Body Composition Analysis</h3>
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="body_composition_pdf" class="control-label">Upload a Body Composition Analysis PDF</label>
                                            <input type="file" id="body_composition_pdf" name="body_composition_pdf" accept=".pdf"  onchange="return fileValidation()" />
                                            <input type="hidden" name="body_composition_pdf2" id="body_composition_pdf2" value="">
                                            <a href="" class="view_body_composition_pdf"></a>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                   
                    
                </div>
            </section>
            <!-- End Body Composition Analysis  -->

             <!-- NOTES FROM RESIDENCE WARDEN  -->
            <section class="content residencewarden">
                <h3 class="card-title forms_title_sup">Notes From Residence Warden</h3>
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="notes_frm_resi_war_education">Education</label>
                                        <select class="form-control" name="notes_frm_resi_war_education" id="notes_frm_resi_war_education" required="">
                                                    <option value="">Select between Level 1-5</option>
                                                    <option value="0">N/A</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="notes_frm_resi_war_discipline">Discipline</label>
                                         <select class="form-control" name="notes_frm_resi_war_discipline" id="notes_frm_resi_war_discipline" required="">
                                                    <option value="">Select between Level 1-5</option>
                                                    <option value="0">N/A</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="notes_frm_resi_war_hygiene">Hygiene</label>
                                         <select class="form-control" name="notes_frm_resi_war_hygiene" id="notes_frm_resi_war_hygiene" required="">
                                                    <option value="">Select between Level 1-5</option>
                                                    <option value="0">N/A</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="notes_frm_resi_war_teamwork">Teamwork</label>
                                         <select class="form-control" name="notes_frm_resi_war_teamwork" id="notes_frm_resi_war_teamwork" required="">
                                                    <option value="">Select between Level 1-5</option>
                                                    <option value="0">N/A</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="notes_frm_resi_war_diet">Diet</label>
                                        <select class="form-control" name="notes_frm_resi_war_diet" id="notes_frm_resi_war_diet" required="">
                                                    <option value="">Select between Level 1-5</option>
                                                    <option value="0">N/A</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="notes_frm_resi_war_conduct">Conduct</label>
                                         <select class="form-control" name="notes_frm_resi_war_conduct" id="notes_frm_resi_war_conduct" required="">
                                                    <option value="">Select between Level 1-5</option>
                                                    <option value="0">N/A</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="" for="">Notes from residence warden</label>
                                        
                                        <textarea class="form-control" rows="3" placeholder="Enter notes from residence warden" spellcheck="false" name="notes_frm_resi_war_key_observ" id="notes_frm_resi_war_key_observ"></textarea>
                                                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </section>
            <!-- End NOTES FROM RESIDENCE WARDEN  -->

             <!-- NOTES FROM COACHING STAFF  -->
                        
            <section class="content">
                <h3 class="card-title forms_title_sup">Notes From Coaching Staff</h3>
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="" for="">Notes from technical director</label>
                                        
                                        <textarea class="form-control" rows="3" placeholder="Enter notes from technical director" spellcheck="false" name="notes_frm_tech_dir" id="notes_frm_tech_dir"></textarea>
                                                                    
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="" for="">Notes from head coach</label>
                                       
                                        <textarea class="form-control" rows="3" placeholder="Enter notes from head coach" spellcheck="false" name="notes_frm_head_coach" id="notes_frm_head_coach"></textarea>
                                        </div>
                                                                   
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <input type="submit" name="save_draft" id="save_btn" value="Save Draft" class="btn btn-primary" style="display: none;" formnovalidate>
                    <input type="submit" name="submit" id="sub_btn" value="Submit" class="btn btn-primary" style="display: none;">
                    <input type="submit" name="submit" id="update_btn" value="Update" class="btn btn-primary" style="display: none;">
                    
                </div>
            </section>
            <!-- End NOTES FROM COACHING STAFF  -->

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
//         url:"<?php //echo base_url(); ?>admin/forms/get_athlete_details",
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
            url:"<?php //echo base_url(); ?>admin/forms/submit_q_report",
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
        url:"<?php echo base_url(); ?>admin/forms/form_v_json",
        dataType: 'json',
        data: "id_athle="+athlete_name+"&key_per="+performance_indicator+"&id_year="+year_val,
        success:function(result){
            $('#forms_id_save').val('');
            $('#te_runn_ball option,#te_feinting option,#te_quality_toch option,#te_rec_under_pres option,#te_ball_manipu option').prop('selected', false);
            if(result.forms_d_id){ 
                var forms_a_id = result.forms_d_id; 
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
    

            $('#running_with_the_ball option, #feinting option, #quality_of_first_touch option, #receiving_under_pressure option, #ball_manipulation option, #short_passing option, #long_passing option, #crossing option, #finishing_inside_the_penalty_area option, #finishing_outside_the_penalty_area option, #heading_at_goal option, #tackling option, #defensive_stance option, #defensive_heading option, #non_dominant_foot_ability option').prop('selected', false);

            if(result.techical_overview){
                var running_with_the_ball = result.techical_overview['running_with_the_ball'];
                var feinting = result.techical_overview['feinting'];
                var quality_of_first_touch = result.techical_overview['quality_of_first_touch'];
                var receiving_under_pressure = result.techical_overview['receiving_under_pressure'];
                var ball_manipulation = result.techical_overview['ball_manipulation'];
                var short_passing = result.techical_overview['short_passing'];
                var long_passing     = result.techical_overview['long_passing'];
                var crossing = result.techical_overview['crossing'];
                var finishing_inside_the_penalty_area = result.techical_overview['finishing_inside_the_penalty_area'];
                var finishing_outside_the_penalty_area = result.techical_overview['finishing_outside_the_penalty_area'];
                var heading_at_goal = result.techical_overview['heading_at_goal'];
                var tackling = result.techical_overview['tackling'];
                var defensive_stance = result.techical_overview['defensive_stance'];
                var defensive_heading  = result.techical_overview['defensive_heading'];
                var non_dominant_foot_ability = result.techical_overview['non_dominant_foot_ability'];

                $('#running_with_the_ball option[value="'+running_with_the_ball+'"]').prop('selected', true);        
                $('#feinting option[value="'+feinting+'"]').prop('selected', true);
                $('#quality_of_first_touch option[value="'+quality_of_first_touch+'"]').prop('selected', true);
                $('#receiving_under_pressure option[value="'+receiving_under_pressure+'"]').prop('selected', true);
                $('#ball_manipulation option[value="'+ball_manipulation+'"]').prop('selected', true);
                $('#short_passing option[value="'+short_passing+'"]').prop('selected', true);
                $('#long_passing option[value="'+long_passing+'"]').prop('selected', true);
                $('#crossing option[value="'+crossing+'"]').prop('selected', true);
                $('#finishing_inside_the_penalty_area option[value="'+finishing_inside_the_penalty_area+'"]').prop('selected', true);
                $('#finishing_outside_the_penalty_area option[value="'+finishing_outside_the_penalty_area+'"]').prop('selected', true);
                $('#heading_at_goal option[value="'+heading_at_goal+'"]').prop('selected', true);
                $('#tackling option[value="'+tackling+'"]').prop('selected', true);
                $('#defensive_stance option[value="'+defensive_stance+'"]').prop('selected', true);
                $('#defensive_heading option[value="'+defensive_heading+'"]').prop('selected', true);
                $('#non_dominant_foot_ability option[value="'+non_dominant_foot_ability+'"]').prop('selected', true);
            }

            $('#ta_reading_game option,#team_philosophy option,#attacking_principles option,#negative_transition_principles option,#defending_principles option,#positive_transition_principles option,#player_position_role option,#set_piece_strategies option').prop('selected', false);
            if(result.tactical_overview){
                var ta_reading_game = result.tactical_overview['ta_reading_game'];
                var team_philosophy = result.tactical_overview['team_philosophy'];
                var attacking_principles = result.tactical_overview['attacking_principles'];
                var negative_transition_principles = result.tactical_overview['negative_transition_principles'];
                var defending_principles = result.tactical_overview['defending_principles'];
                var positive_transition_principles = result.tactical_overview['positive_transition_principles'];
                var player_position_role = result.tactical_overview['player_position_role'];
                var set_piece_strategies = result.tactical_overview['set_piece_strategies'];

                $('#ta_reading_game option[value="'+ta_reading_game+'"]').prop('selected', true);
                $('#team_philosophy option[value="'+team_philosophy+'"]').prop('selected', true);
                $('#attacking_principles option[value="'+attacking_principles+'"]').prop('selected', true);
                $('#negative_transition_principles option[value="'+negative_transition_principles+'"]').prop('selected', true);
                $('#defending_principles option[value="'+defending_principles+'"]').prop('selected', true);
                $('#positive_transition_principles option[value="'+positive_transition_principles+'"]').prop('selected', true);
                $('#player_position_role option[value="'+player_position_role+'"]').prop('selected', true);
                $('#set_piece_strategies option[value="'+set_piece_strategies+'"]').prop('selected', true);
            }

            $('#with_speed_20m,with_speed_40m,#with_arrowhead_agility_left_side,#with_arrowhead_agility_right_side,#without_speed_20m,#without_speed_40m,#yo_yo_intermittent_recovery_test,#without_arrowhead_agility_left_side,#without_arrowhead_agility_right_side,#vertical_jump').val('');
            if(result.physical_overview){
                var with_speed_20m = result.physical_overview['with_speed_20m'];
                var with_speed_40m = result.physical_overview['with_speed_40m'];
                var with_arrowhead_agility_left_side = result.physical_overview['with_arrowhead_agility_left_side'];
                var with_arrowhead_agility_right_side = result.physical_overview['with_arrowhead_agility_right_side'];
                var without_speed_20m = result.physical_overview['without_speed_20m'];
                var without_speed_40m = result.physical_overview['without_speed_40m'];
                var yo_yo_intermittent_recovery_test = result.physical_overview['yo_yo_intermittent_recovery_test'];
                var without_arrowhead_agility_left_side = result.physical_overview['without_arrowhead_agility_left_side'];
                var without_arrowhead_agility_right_side = result.physical_overview['without_arrowhead_agility_right_side'];
                var vertical_jump = result.physical_overview['vertical_jump'];

                $('#with_speed_20m').val(with_speed_20m);
                $('#with_speed_40m').val(with_speed_40m);
                $('#with_arrowhead_agility_left_side').val(with_arrowhead_agility_left_side);
                $('#with_arrowhead_agility_right_side').val(with_arrowhead_agility_right_side);
                $('#without_speed_20m').val(without_speed_20m);
                $('#without_speed_40m').val(without_speed_40m);
                $('#yo_yo_intermittent_recovery_test').val(yo_yo_intermittent_recovery_test);
                $('#without_arrowhead_agility_left_side').val(without_arrowhead_agility_left_side);
                $('#without_arrowhead_agility_right_side').val(without_arrowhead_agility_right_side);
                $('#vertical_jump').val(vertical_jump);
            }

            $('#training_concentration_attention_span option,#training_emotional_control option,#training_self_confidence option,#training_attitude_work_ethic option,#training_ability_to_understand_instructions option,#training_creativity_improvisation option,#training_decision_making option,#training_leadership_responsibility option,#training_preparations option,#matches_concentration_task_focus option,#matches_emotional_control option,#matches_self_confidence option,#matches_attitude_work_ethic option,#matches_ability_to_understand_instructions option,#matches_creativity_improvisation option,#matches_decision_making option,#matches_leadership_responsibility option,#match_preparation option').prop('selected', false);
            if(result.psychological_overview){
                var training_concentration_attention_span = result.psychological_overview['training_concentration_attention_span'];
                var training_emotional_control = result.psychological_overview['training_emotional_control'];
                var training_self_confidence = result.psychological_overview['training_self_confidence'];
                var training_attitude_work_ethic = result.psychological_overview['training_attitude_work_ethic'];
                var training_ability_to_understand_instructions = result.psychological_overview['training_ability_to_understand_instructions'];
                var training_creativity_improvisation = result.psychological_overview['training_creativity_improvisation'];
                var training_decision_making = result.psychological_overview['training_decision_making'];
                var training_leadership_responsibility = result.psychological_overview['training_leadership_responsibility'];
                var training_preparations = result.psychological_overview['training_preparations'];
                var matches_concentration_task_focus = result.psychological_overview['matches_concentration_task_focus'];
                var matches_emotional_control = result.psychological_overview['matches_emotional_control'];
                var matches_self_confidence = result.psychological_overview['matches_self_confidence'];
                var matches_attitude_work_ethic = result.psychological_overview['matches_attitude_work_ethic'];
                var matches_ability_to_understand_instructions = result.psychological_overview['matches_ability_to_understand_instructions'];
                var matches_creativity_improvisation = result.psychological_overview['matches_creativity_improvisation'];
                var matches_decision_making = result.psychological_overview['matches_decision_making'];
                var matches_leadership_responsibility = result.psychological_overview['matches_leadership_responsibility'];
                var match_preparation = result.psychological_overview['match_preparation'];



                $('#training_concentration_attention_span option[value="'+training_concentration_attention_span+'"]').prop('selected', true);
                $('#training_emotional_control option[value="'+training_emotional_control+'"]').prop('selected', true);
                $('#training_self_confidence option[value="'+training_self_confidence+'"]').prop('selected', true); 
                $('#training_attitude_work_ethic option[value="'+training_attitude_work_ethic+'"]').prop('selected', true);
                $('#training_ability_to_understand_instructions option[value="'+training_ability_to_understand_instructions+'"]').prop('selected', true);
                $('#training_creativity_improvisation option[value="'+training_creativity_improvisation+'"]').prop('selected', true);
                $('#training_decision_making option[value="'+training_decision_making+'"]').prop('selected', true);
                $('#training_leadership_responsibility option[value="'+training_leadership_responsibility+'"]').prop('selected', true);
                $('#training_preparations option[value="'+training_preparations+'"]').prop('selected', true);
                $('#matches_concentration_task_focus option[value="'+matches_concentration_task_focus+'"]').prop('selected', true);
                $('#matches_emotional_control option[value="'+matches_emotional_control+'"]').prop('selected', true);
                $('#matches_self_confidence option[value="'+matches_self_confidence+'"]').prop('selected', true);
                $('#matches_attitude_work_ethic option[value="'+matches_attitude_work_ethic+'"]').prop('selected', true);
                $('#matches_ability_to_understand_instructions option[value="'+matches_ability_to_understand_instructions+'"]').prop('selected', true);
                $('#matches_creativity_improvisation option[value="'+matches_ability_to_understand_instructions+'"]').prop('selected', true);
                $('#matches_decision_making option[value="'+matches_ability_to_understand_instructions+'"]').prop('selected', true);
                $('#matches_leadership_responsibility option[value="'+matches_ability_to_understand_instructions+'"]').prop('selected', true);
                $('#match_preparation option[value="'+matches_ability_to_understand_instructions+'"]').prop('selected', true);

            }

            $('#deep_squat option,#inline_lunge option,#hurdle_crossing option,#active_single_leg_raise option,#trunk_stability_push_ups option,#rotatory_stability option').prop('selected', false);
            if(result.functional_overview){
                var deep_squat = result.functional_overview['deep_squat'];
                var inline_lunge = result.functional_overview['inline_lunge'];
                var hurdle_crossing = result.functional_overview['hurdle_crossing'];
                var active_single_leg_raise = result.functional_overview['active_single_leg_raise'];
                var trunk_stability_push_ups = result.functional_overview['trunk_stability_push_ups'];
                var rotatory_stability = result.functional_overview['rotatory_stability'];


                $('#deep_squat option[value="'+deep_squat+'"]').prop('selected', true);
                $('#inline_lunge option[value="'+inline_lunge+'"]').prop('selected', true);
                $('#hurdle_crossing option[value="'+hurdle_crossing+'"]').prop('selected', true);
                $('#active_single_leg_raise option[value="'+active_single_leg_raise+'"]').prop('selected', true);
                $('#trunk_stability_push_ups option[value="'+trunk_stability_push_ups+'"]').prop('selected', true);
                $('#rotatory_stability option[value="'+rotatory_stability+'"]').prop('selected', true);



            }
            
            $('#boday_height_range,#boday_height_range,#boday_height_val,#boday_weight_range,#boday_weight_val,#boday_bmi_range,#boday_bmi_val').val('');
            if(result.boday_overview){
                var boday_height_range = result.boday_overview['boday_height_range'];
                var boday_height_val = result.boday_overview['boday_height_val'];
                var boday_weight_range = result.boday_overview['boday_weight_range'];
                var boday_weight_val = result.boday_overview['boday_weight_val'];
                var boday_bmi_range = result.boday_overview['boday_bmi_range'];
                var boday_bmi_val = result.boday_overview['boday_bmi_val'];   

                $('#boday_height_range').val(boday_height_range);
                $('#boday_height_val').val(boday_height_val);
                $('#boday_weight_range').val(boday_weight_range);
                $('#boday_weight_val').val(boday_weight_val);
                $('#boday_bmi_range').val(boday_bmi_range);
                $('#boday_bmi_val').val(boday_bmi_val);
            }

            $('#body_composition_pdf').val('');
            if(result.body_overview){
                var body_composition_pdf = result.body_overview['body_composition_pdf'];   
              
                 $('.view_body_composition_pdf').attr("href", "<?= base_url() ?>uploads/bodycomposition_pdf/"+body_composition_pdf);
                 $('.view_body_composition_pdf').text(body_composition_pdf);
                 $('#body_composition_pdf2').val(body_composition_pdf);

                // $('#body_composition_pdf').val(body_composition_pdf);
            }
            
            
            $('#notes_frm_resi_war_key_observ').val('');
            $('#notes_frm_resi_war_education option,#notes_frm_resi_war_discipline option,#notes_frm_resi_war_hygiene option,#notes_frm_resi_war_teamwork option,#notes_frm_resi_war_diet option,#notes_frm_resi_war_conduct option').prop('selected', false);

            if(result.athlet_details['team_program'] && result.athlet_details['team_program'] != null && result.athlet_details['team_program'] == "Residential"){

                $(".residencewarden").show();   
                console.log(result.athlet_details['team_program']);
                $('#notes_frm_resi_war_education,#notes_frm_resi_war_discipline,#notes_frm_resi_war_hygiene,#notes_frm_resi_war_teamwork,#notes_frm_resi_war_diet,#notes_frm_resi_war_conduct').prop('disabled',false);

                if(result.residence_notes_overview){
                    var notes_frm_resi_war_education = result.residence_notes_overview['notes_frm_resi_war_education'];
                    var notes_frm_resi_war_discipline = result.residence_notes_overview['notes_frm_resi_war_discipline'];
                    var notes_frm_resi_war_hygiene = result.residence_notes_overview['notes_frm_resi_war_hygiene'];
                    var notes_frm_resi_war_teamwork = result.residence_notes_overview['notes_frm_resi_war_teamwork'];
                    var notes_frm_resi_war_diet = result.residence_notes_overview['notes_frm_resi_war_diet'];
                    var notes_frm_resi_war_conduct = result.residence_notes_overview['notes_frm_resi_war_conduct'];
                    var notes_frm_resi_war_key_observ = result.residence_notes_overview['notes_frm_resi_war_key_observ'];

                    $('#notes_frm_resi_war_education option[value="'+notes_frm_resi_war_education+'"]').prop('selected', true);
                    $('#notes_frm_resi_war_discipline option[value="'+notes_frm_resi_war_discipline+'"]').prop('selected', true);
                    $('#notes_frm_resi_war_hygiene option[value="'+notes_frm_resi_war_hygiene+'"]').prop('selected', true);
                    $('#notes_frm_resi_war_teamwork option[value="'+notes_frm_resi_war_teamwork+'"]').prop('selected', true);
                    $('#notes_frm_resi_war_diet option[value="'+notes_frm_resi_war_diet+'"]').prop('selected', true);
                    $('#notes_frm_resi_war_conduct option[value="'+notes_frm_resi_war_conduct+'"]').prop('selected', true);
                     $('#notes_frm_resi_war_key_observ').val(notes_frm_resi_war_key_observ);


                }

            }else{
                $('#notes_frm_resi_war_education,#notes_frm_resi_war_discipline,#notes_frm_resi_war_hygiene,#notes_frm_resi_war_teamwork,#notes_frm_resi_war_diet,#notes_frm_resi_war_conduct').prop('disabled',true);
                $(".residencewarden").hide();  
             

            }
            
            $(' #notes_frm_tech_dir,#notes_frm_head_coach').val('');
            if(result.staff_notes_overview){
                var notes_frm_tech_dir = result.staff_notes_overview['notes_frm_tech_dir'];
                var notes_frm_head_coach = result.staff_notes_overview['notes_frm_head_coach'];
                
                $('#notes_frm_tech_dir').val(notes_frm_tech_dir);
                $('#notes_frm_head_coach').val(notes_frm_head_coach);
              
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

function fileValidation() {
    var fileInput = 
        document.getElementById('body_composition_pdf');
      
    var filePath = fileInput.value;
  
    // Allowing file type
    var allowedExtensions = 
            /(\.pdf)$/i;
      
    if (!allowedExtensions.exec(filePath)) {
        alert('Invalid file type');
        fileInput.value = '';
        return false;
    } 
    
}
/*
var table = $('#na_datatable').DataTable( {
  "processing": true,
  "serverSide": false,
  "ajax": "<?=base_url('admin/form/form_v_json')?>",
  "order": [[4,'desc']],
  "columnDefs": [
  { "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
  { "targets": 1, "name": "username", 'searchable':true, 'orderable':true},
  { "targets": 2, "name": "email", 'searchable':true, 'orderable':true},
  { "targets": 3, "name": "mobile_no", 'searchable':true, 'orderable':true},
  { "targets": 4, "name": "created_at", 'searchable':false, 'orderable':false},
  { "targets": 5, "name": "is_active", 'searchable':true, 'orderable':true},
  ]
});
*/
</script>