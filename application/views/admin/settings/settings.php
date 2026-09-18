
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
              &nbsp; Settings </h3>
          </div>

        </div>
        <div class="card-body">
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>

            <?php 
            echo form_open_multipart( base_url('admin/settings/')); 
             
            ?>
            <div>
              <div>
                <div class="card">
                  <div class="card-header with-border">
                    <h3 class="card-title">Change Superadmin password</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password" class="control-label required">Password</label>
                                <input type="password" name="password" class="form-control" id="password" value="" placeholder="Enter new password" required>
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

  
  
 