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
              &nbsp; Edit Team </h3>
          </div>

        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>

            <?php 
             $team_detail = $team_detail[0];
            echo form_open( base_url('admin/team/edit/'.$team_detail['id'])); ?>
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

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="team_name" class="control-label required">Team Name</label>
                                <input type="text" name="team_name" class="form-control" id="team_first_name" value="<?= $team_detail['team_name']; ?>" placeholder="Enter Team Name" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                               <label for="team_program" class="control-label">Team Program</label>
                                <select name="team_program" class="form-control" id="team_program">
                                    <option value="residential"  <?= ($team_detail['team_program'] == "residential")? 'selected' : ''; ?>>Residential</option>
                                    <option value="excellence"  <?= ($team_detail['team_program'] == "excellence")? 'selected' : ''; ?>>Excellence</option>
                                     <option value="Academic"  <?= ($team_detail['team_program'] == "Academic")? 'selected' : ''; ?>>Academy</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="team_age_category" class="control-label">Age Category</label>
                                <select name="team_age_category" class="form-control" id="team_age_category">
                                    <option value="U9" <?= ($team_detail['age_cat'] == "U9")? 'selected' : ''; ?>>U9</option>
                                    <option value="U11" <?= ($team_detail['age_cat'] == "U11")? 'selected' : ''; ?>>U11</option>
                                    <option value="U13" <?= ($team_detail['age_cat'] == "U13")? 'selected' : ''; ?>>U13</option>
                                    <option value="U15" <?= ($team_detail['age_cat'] == "U15")? 'selected' : ''; ?>>U15</option>
                                    <option value="U17" <?= ($team_detail['age_cat'] == "U17")? 'selected' : ''; ?>>U17</option>
                                    <option value="U19" <?= ($team_detail['age_cat'] == "U19")? 'selected' : ''; ?>>U19</option>
                                    <option value="Open">Open</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="team_location" class="control-label required">Location</label>
                                <input type="text" name="team_location" class="form-control" id="team_location" value="<?= $team_detail['location']; ?>" placeholder="Enter Location" required>
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
  
  <script>
    $('#invoices').addClass('active');
  </script>