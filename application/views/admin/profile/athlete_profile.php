<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard/'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Athlete Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                    <?php  $upload_data = $athlete_detail['upload_data'] ? $athlete_detail['upload_data'] : 'profilepic_default.png'; ?>
                  <img src="<?= base_url(); ?>/uploads/<?= $upload_data; ?>" class="profile-user-img img-fluid img-circle">
                </div>

                <h3 class="profile-username text-center"><?= $athlete_detail['first_name']; ?> <?= $athlete_detail['last_name']; ?></h3>

                <p class="text-muted text-center"><?= $athlete_detail['contact_no']; ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Gender</b> <a class="float-right"><?= $athlete_detail['gender']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Age Category</b> <a class="float-right"><?= $athlete_detail['age_category']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Team Program</b> <a class="float-right"><?= $athlete_detail['team_program']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Team Name</b> <a class="float-right">
                       <?php 
                            $team_arr = unserialize($athlete_detail['team_name']);
                            $team_names = get_team_names_by_id_array(implode(",", $team_arr));  
                            if(!isset($team_names[0])){
                                $team_names[0]['team_name'] = "";
                            }

                            echo $team_names[0]['team_name'];
                        ?>
                    </a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

         
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong><i class="fa fa-user mr-1"></i> Name</strong>

                        <p class="text-muted">
                          <?= $athlete_detail['first_name']; ?> <?= $athlete_detail['last_name']; ?>
                        </p>
                        <hr>
                    </div>    
                
                    <div class="col-md-6">
                        <strong><i class="fa fa-user mr-1"></i> Parent/Guardian's Name</strong>
                        <p class="text-muted"><?= $athlete_detail['parent_f_name']; ?> <?= $athlete_detail['parent_l_name']; ?></p>
                        <hr>
                    </div>

                    <div class="col-md-6">
                        <strong><i class="fa fa-envelope mr-1"></i> Email address</strong>
                        <p class="text-muted"><?= $athlete_detail['email_address']; ?></p>
                        <hr>
                    </div>

                    <div class="col-md-6">
                        <strong><i class="fa fa-calendar mr-1"></i> Birthdate</strong>
                        <p class="text-muted"><?= $athlete_detail['brith_dd']; ?></p>
                        <hr>
                    </div>

                    <div class="col-md-6">
                        <strong><i class="fa fa-map-marker mr-1"></i> City</strong>
                        <p class="text-muted"><?= $athlete_detail['city']; ?></p>
                        <hr>
                    </div>

                    <div class="col-md-6">
                        <strong><i class="fa fa-map-marker mr-1"></i> State</strong>
                        <p class="text-muted"><?= $athlete_detail['state']; ?></p>
                        <hr>
                    </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>

           
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

