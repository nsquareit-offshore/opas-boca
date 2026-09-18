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
              &nbsp; Edit Athlete </h3>
          </div>

        </div>
        <div class="card-body">


   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>

            <?php 


            echo form_open_multipart( base_url('admin/athlete/edit/'.$athlete_detail['id'])); 
              $upload_data = $athlete_detail['upload_data'] ? $athlete_detail['upload_data'] : 'profilepic_default.png';
            ?>
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
                                <input type="text" name="athlete_first_name" class="form-control" id="athlete_first_name" value="<?= $athlete_detail['first_name']; ?>" placeholder="Enter First Name" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="athlete_last_name" class="control-label required">Last Name</label>
                                <input type="text" name="athlete_last_name" class="form-control" id="athlete_last_name" value="<?= $athlete_detail['last_name']; ?>" placeholder="Enter Last Name" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="athlete_email_address" class="control-label required">Email address</label>
                                <input type="email" name="athlete_email_address" class="form-control" id="athlete_email_address" value="<?= $athlete_detail['email_address']; ?>" placeholder="Enter Email address" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="athlete_sec_email_address" class="control-label">Secondary Email address</label>
                                <input type="email" name="athlete_sec_email_address" class="form-control" id="athlete_sec_email_address" value="<?= $athlete_detail['secondary_email_address']; ?>" placeholder="Enter Email address">
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="athlete_contact_no" class="control-label required">Contact No</label>
                                <input type="number" name="athlete_contact_no" class="form-control" min="1" id="athlete_contact_no" value="<?= $athlete_detail['contact_no']; ?>" placeholder="Enter Contact No" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="athlete_parent_f_name" class="control-label required">Parent/Guardian's First Name</label>
                                <input type="text" name="athlete_parent_f_name" class="form-control" id="athlete_parent_f_name" value="<?= $athlete_detail['parent_f_name']; ?>" placeholder="Enter First Name" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="athlete_parent_l_name" class="control-label required">Parent/Guardian's Last Name</label>
                                <input type="text" name="athlete_parent_l_name" class="form-control" id="athlete_parent_l_name" value="<?= $athlete_detail['parent_l_name']; ?>" placeholder="Enter Last Name" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="athlete_birthdate" class="control-label required">Birthdate</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" name="athlete_brith_dd" class="form-control" id="athlete_brith_dd" value="<?= $athlete_detail['brith_dd']; ?>" placeholder="DD/MM/YYYY" required>
                                    </div>
<!--                                     <div class="col-md-4">
                                        <input type="number" name="athlete_brith_mm" class="form-control" id="athlete_brith_mm" value="<?= $athlete_detail['brith_mm']; ?>" placeholder="MM" required>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" name="athlete_brith_yyy" class="form-control" id="athlete_brith_yyy" value="<?= $athlete_detail['brith_yyy']; ?>" placeholder="YYYY" required>
                                    </div> -->
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="athlete_city" class="control-label required">City</label>
                                <input type="text" name="athlete_city" class="form-control" id="athlete_city" value="<?= $athlete_detail['city']; ?>" placeholder="Enter City" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="athlete_state" class="control-label required">State</label>
                                <input type="text" name="athlete_state" class="form-control" id="athlete_state" value="<?= $athlete_detail['state']; ?>" placeholder="Enter State" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="athlete_gender" class="control-label required">Gender</label>
                                <select name="athlete_gender" class="form-control" id="athlete_gender">
                                    <option <?= ($athlete_detail['gender'] == 'male')? 'selected' : ''; ?> value="male">Male</option>
                                    <option <?= ($athlete_detail['gender'] == 'female')? 'selected' : ''; ?> value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="athlete_age_category" class="control-label">Age Category</label>
                                <select name="athlete_age_category" class="form-control" id="athlete_age_category">
                                    <option value="U8" <?= ($athlete_detail['age_category'] == "U8")? 'selected' : ''; ?>>U8</option>
                                    <option value="U10" <?= ($athlete_detail['age_category'] == "U10")? 'selected' : ''; ?>>U10</option>
                                    <option value="U12" <?= ($athlete_detail['age_category'] == "U12")? 'selected' : ''; ?>>U12</option>
                                    <option value="U14" <?= ($athlete_detail['age_category'] == "U14")? 'selected' : ''; ?>>U14</option>
                                    <option value="U17" <?= ($athlete_detail['age_category'] == "U17")? 'selected' : ''; ?>>U17</option>
                                    <option value="Open">Open</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="athlete_team_name" class="control-label required">Residential team Name</label>
                                <select name="athlete_team_name[]" class="form-control" id="athlete_resi_team_name" required>
                                    <option value="">Select Residential Team</option>
                                    <?php foreach ($all_residential_team as $key => $value_team) { ?>
                                       <option value="<?= $value_team['id']; ?>" <?= 
                                       (in_array($value_team['id'], unserialize($athlete_detail['team_name']))) ? 'selected' : '';
                                        ?>><?= $value_team['team_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                         <div class="col-md-4">
                            <div class="form-group">
                                <label for="athlete_team_name" class="control-label required">Excellence team Name</label>
                                <select name="athlete_team_name[]" class="form-control" id="athlete_resi_team_name" required>
                                    <option value="">Select Excellence Team</option>
                                    <?php foreach ($all_excellence_team as $key => $value_team) { ?>
                                       <option value="<?= $value_team['id']; ?>" <?= 
                                       (in_array($value_team['id'], unserialize($athlete_detail['team_name']))) ? 'selected' : '';
                                        ?>><?= $value_team['team_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="athlete_playing_position" class="control-label required">Playing Position</label>
                                <input type="text" name="athlete_playing_position" class="form-control" id="athlete_playing_position" value="<?= $athlete_detail['playing_position']; ?>" placeholder="Enter Playing Position" required>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <img src="<?= base_url(); ?>/uploads/<?= $upload_data; ?>" class="athimage">
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="profile_image" class="control-label">Upload a Profile Picture</label>
                                    <input type="file" id="profile_image" name="profile_image" />
                                    <input type="hidden" name="profile_image2" value=<?php echo $upload_data;  ?> >                                  
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
       // $('[data-mask]').inputmask();

    $('#invoices').addClass('active');
   
    var startDate = new Date('1990-01-01'),
        endDate = new Date('2010-01-30');

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