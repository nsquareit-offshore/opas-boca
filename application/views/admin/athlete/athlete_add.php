<!-- bootstrap datepicker -->
<!-- daterange picker -->

<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datepicker/datepicker3.css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
              &nbsp; Add New Athlete </h3>
          </div>

        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>

            <?php echo form_open_multipart( base_url('admin/athlete/add')); ?>
            <div>
              <div>
                <div class="card">
                  <div class="card-header with-border">
                    <h3 class="card-title">Fill out the form</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="athlete_first_name" class="control-label required">First Name</label>
                                <input type="text" name="athlete_first_name" class="form-control" id="athlete_first_name" value="" placeholder="Enter First Name" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="athlete_last_name" class="control-label required">Last Name</label>
                                <input type="text" name="athlete_last_name" class="form-control" id="athlete_last_name" value="" placeholder="Enter Last Name" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="athlete_email_address" class="control-label required">Email address</label>
                                <input type="email" name="athlete_email_address" autocomplete="false" class="form-control" id="athlete_email_address" value="" placeholder="Enter Email address" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="athlete_sec_email_address" class="control-label">Secondary Email address</label>
                                <input type="email" name="athlete_sec_email_address" autocomplete="false" class="form-control" id="athlete_sec_email_address" value="" placeholder="Enter Email address">
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="athlete_contact_no" class="control-label required">Contact No</label>
                                <input type="text" name="athlete_contact_no" class="form-control" id="athlete_contact_no" value="" placeholder="Enter Contact No" pattern="[1-9]{1}[0-9]{9}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="athlete_parent_f_name" class="control-label required">Parent/Guardian's First Name</label>
                                <input type="text" name="athlete_parent_f_name" class="form-control" id="athlete_parent_f_name" value="" placeholder="Enter First Name" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="athlete_parent_l_name" class="control-label required">Parent/Guardian's Last Name</label>
                                <input type="text" name="athlete_parent_l_name" class="form-control" id="athlete_parent_l_name" value="" placeholder="Enter Last Name" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="athlete_birthdate" class="control-label required">Birthdate</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" name="athlete_brith_dd" class="form-control" id="athlete_brith_dd" value="" placeholder="DD/MM/YYYY" required>
                                    </div>
<!--                                     <div class="col-md-4">
                                        <input type="number" name="athlete_brith_mm" class="form-control" id="athlete_brith_mm" value="" placeholder="MM" required>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" name="athlete_brith_yyy" class="form-control" id="athlete_brith_yyy" value="" placeholder="YYYY" required>
                                    </div> -->
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="athlete_city" class="control-label required">City</label>
                                <input type="text" name="athlete_city" class="form-control" id="athlete_city" value="" placeholder="Enter City" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="athlete_state" class="control-label required">State</label>
                                <input type="text" name="athlete_state" class="form-control" id="athlete_state" value="" placeholder="Enter State" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="athlete_gender" class="control-label">Gender</label>
                                <select name="athlete_gender" class="form-control" id="athlete_gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="athlete_age_category" class="control-label">Age Category</label>
                                <select name="athlete_age_category" class="form-control" id="athlete_age_category">
                                    <option value="U8">U8</option>
                                    <option value="U10">U10</option>
                                    <option value="U12">U12</option>
                                    <option value="U14">U14</option>
                                    <option value="U17">U17</option>
                                    <option value="U19">U19</option>
                                    <option value="Open">Open</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="athlete_team_program" class="control-label required">Team Program</label>
                                <select name="athlete_team_program" class="form-control" id="athlete_team_program" required>
                                   <option value="">Select Team Program</option>
                                   <option value="Residential">Residential</option>
                                   <option value="Excellence">Excellence</option>
                                   <option value="Academic">Academy</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4" id="athlete_team_name_sec">
                            <div class="form-group">
                                <label for="athlete_team_name" class="control-label required">Team Name</label>
                                <select name="athlete_team_name[]" class="form-control" id="athlete_team_name" required>
                                   <option value="">Select first Team Program</option>
                                    
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 defaulthide" id="athlete_resi_team_sec">
                            <div class="form-group">                                
                                <div id="athlete_resi_team_name">
                                   <option value="">Select Residential Team</option>
                                    <?php foreach ($all_residential_team as $key => $value_team) { ?>
                                       <option value="<?= $value_team['id']; ?>"><?= $value_team['team_name']; ?></option>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                         <div class="col-md-4 defaulthide" id="athlete_exce_team_sec">
                            <div class="form-group">  
                                <div id="athlete_exce_team_name">
                                   <option value="">Select Excellence Team</option>
                                    <?php foreach ($all_excellence_team as $key => $value_team) { ?>
                                       <option value="<?= $value_team['id']; ?>"><?= $value_team['team_name']; ?></option>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 defaulthide" id="athlete_acad_team_sec">
                            <div class="form-group">
                                <div id="athlete_acad_team_name">
                                   <option value="">Select Academic Team</option>
                                    <?php foreach ($all_academic_team as $key => $value_team) { ?>
                                       <option value="<?= $value_team['id']; ?>"><?= $value_team['team_name']; ?></option>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                       

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="athlete_playing_position" class="control-label">Playing Position</label>
                                <input type="text" name="athlete_playing_position" class="form-control" id="athlete_playing_position" value="" placeholder="Enter Playing Position">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="profile_image" class="control-label">Upload a Profile Picture</label>
                                    <input type="file" id="profile_image" name="profile_image" size="33" />

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                            </div>
                        </div>

                    </div>
                </div>
                    <!-- /.card-body -->
                </div>
              </div>

            </div>
          <?php echo form_close(); ?>
        </div>  
      </div>
    </section> 

</div>

  <script src="<?= base_url() ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
  <script>
    $(document).on('change', '#athlete_team_program', function() {

        if(jQuery('#athlete_team_program').val() == 'Residential'){  

            $("#athlete_team_name_sec select").html($("#athlete_resi_team_name").html());
            

            
        } else if(jQuery('#athlete_team_program').val() == 'Excellence'){
            $("#athlete_team_name_sec select").html($("#athlete_exce_team_name").html());

          
        } else if(jQuery('#athlete_team_program').val() == 'Academic'){
            $("#athlete_team_name_sec select").html($("#athlete_acad_team_name").html());

           
        }else{
            $("#athlete_team_name_sec select").html('<option value="">Select first Team Program</option>');

        }

    });
       // $('[data-mask]').inputmask();

    $('#invoices').addClass('active');
   
    var startDate = new Date('1990-01-01'),
        endDate = new Date();

    $("#athlete_brith_dd").datepicker( {
    format: "dd/mm/yyyy",
    minViewMode: 3,
    startDate: startDate, //set start date
    endDate: endDate, //set end date
});

    $("#athlete_brith_mm").datepicker( {
    format: "mm",
    minViewMode: 1,
        startDate: startDate, //set start date
    endDate: endDate, //set end date
});

     $("#athlete_brith_yyy").datepicker( {
    minViewMode: 2,
     format: 'yyyy',
         startDate: startDate, //set start date
    endDate: endDate, //set end date
});
  </script>