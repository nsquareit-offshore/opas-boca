<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2/select2.min.css">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
              &nbsp; Add New Coach </h3>
          </div>

        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>

            <?php echo form_open_multipart( base_url('admin/coach/add')); ?>
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
                                <label for="coach_first_name" class="control-label required">First Name</label>
                                <input type="text" name="coach_first_name" class="form-control" id="coach_first_name" value="" placeholder="Enter First Name" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="coach_last_name" class="control-label required">Last Name</label>
                                <input type="text" name="coach_last_name" class="form-control" id="coach_last_name" value="" placeholder="Enter Last Name" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="coach_email_address" class="control-label required">Email address</label>
                                <input type="email" name="coach_email_address" class="form-control" id="coach_email_address" value="" placeholder="Enter Email address" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password" class="control-label required">Password</label>
                                <input type="password" name="password" class="form-control" id="password" value="" placeholder="" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="coach_contact_no" class="control-label required">Contact No</label>
                                <input type="text" name="coach_contact_no" class="form-control" id="coach_contact_no" value="" placeholder="Enter Contact No" pattern="[1-9]{1}[0-9]{9}" required>
                                

                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="coach_city" class="control-label required">City</label>
                                <input type="text" name="coach_city" class="form-control" id="coach_city" value="" placeholder="Enter City" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="coach_state" class="control-label required">State</label>
                                <input type="text" name="coach_state" class="form-control" id="coach_state" value="" placeholder="Enter State" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="coach_gender" class="control-label">Gender</label>
                                <select name="coach_gender" class="form-control" id="coach_gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="coach_assign_team" class="control-label">Academy Assign Team</label>
                                
                                <select name="coach_assign_team[]" class="form-control select2" multiple="multiple" id="coach_assign_team" data-placeholder="Select a Team">
                                    <?php foreach ($all_academic_team as $key => $value_team) { ?>
                                       <option value="<?= $value_team['id']; ?>"><?= $value_team['team_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="coach_assign_team" class="control-label">Excellence Assign Team</label>
                                
                                <select name="coach_assign_team[]" class="form-control select2" multiple="multiple" id="coach_assign_team" data-placeholder="Select a Team">
                                    <?php foreach ($all_excellence_team as $key => $value_team) { ?>
                                       <option value="<?= $value_team['id']; ?>"><?= $value_team['team_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="coach_assign_team" class="control-label">Residential Assign Team</label>
                                
                                <select name="coach_assign_team[]" class="form-control select2" multiple="multiple" id="coach_assign_team" data-placeholder="Select a Team">
                                    <?php foreach ($all_residential_team as $key => $value_team) { ?>
                                       <option value="<?= $value_team['id']; ?>"><?= $value_team['team_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="is_head_coach" class="control-label">Is Head coach?</label>
                                <select name="is_head_coach" class="form-control" id="is_head_coach">
                                    <option value="1">Yes</option>
                                    <option value="0" selected>No</option>
                                </select>
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

 <!-- bootstrap datepicker -->
  <script src="<?= base_url() ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
  <script src="<?= base_url() ?>assets/plugins/select2/select2.full.min.js"></script>
  
  <script>
    $('#invoices').addClass('active');
     $('.select2').select2();
  </script>