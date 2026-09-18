<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card">
      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; List of Athlete</h3>
        </div>
        <div class="d-inline-block float-right">
          <?php if($this->rbac->check_operation_permission('add')): ?>
            <a href="<?= base_url('admin/athlete/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Athlete</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body table-responsive">
        <table id="na_datatable" class="table table-bordered table-striped" width="100%">
          <thead>
            <tr>
              
              <th>Profile Image</th>
              <th>Name</th>
              <th>Email Address</th>
              <th>Contact No</th>
              <th>Team Name</th>
              <th>Age Category</th>
              <th>Playing Position</th>
              <th width="100" class="text-right">Action</th>
            </tr>
          </thead>
        <tbody>
            <?php 
            foreach($athlete_detail as $data):
              $upload_data = $data['upload_data'] ? $data['upload_data'] : 'profilepic_default.png';
              $team_arr = unserialize($data['team_name']);
              $team_names = get_team_names_by_id_array(implode(",", $team_arr));  
              if(!isset($team_names[0])){
                $team_names[0]['team_name'] = "";
              }
             ?>
            <tr>
              
              <td><img src="<?= base_url()."/uploads/".$upload_data; ?>" class="athimage"></td>  
              <td><?= $data['first_name']; ?> <?= $data['last_name']; ?></td>
              <td><?= $data['email_address']; ?></td>
              <td><?= ($data['contact_no']); ?></td>
              <td><?= $team_names[0]['team_name']; ?></td>
              <td><?= ($data['age_category']); ?></td>
              <td><?= ($data['playing_position']); ?></td>
              <td>
                <a href="<?= base_url('admin/athlete/edit/'.$data['id']); ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                <a href="<?= base_url('admin/athlete/delete/'.$data['id']); ?>" class="btn btn-danger"><i class="fa fa-remove"></i></a>
              </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>  
</div>


<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>
  //---------------------------------------------------
  var table = $('#na_datatable').DataTable();
</script>

