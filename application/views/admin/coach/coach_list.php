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
          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; List of Coach</h3>
        </div>
        <div class="d-inline-block float-right">
          <?php if($this->rbac->check_operation_permission('add')): ?>
            <a href="<?= base_url('admin/coach/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Coach</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body table-responsive">
        <table id="na_datatable" class="table table-bordered table-striped" width="100%">
          <thead>
            <tr>
           
              <th style="width: 95px;">Profile Image</th>
              <th>Name</th>
              <th>Team name</th>
              <th>Contact No</th>
              <th>Gender</th>
              <th width="100" class="text-right">Action</th>
            </tr>
          </thead>
        <tbody>
            <?php 
            foreach($coach_detail as $data): 
              $upload_data = $data['upload_data'] ? $data['upload_data'] : 'profilepic_default.png';
              $team_id = $data['assign_team'];
              if(isset($team_id)){
                   $team_arr = unserialize($team_id);  
                }else{
                    $team_arr = array();
                }
               $teamnames = get_team_names_by_id_array(implode(",", $team_arr));    
              
              ?>
            <tr>
             
              <td style="text-align: center!important;"><img src="<?= base_url()."/uploads/coach/".$upload_data; ?>" class="athimage"></td>  
              <td><?= $data['first_name']; ?> <?= $data['last_name']; ?></td>
              <td><?php 
              foreach ($teamnames as $key => $value) {
                  echo $value['team_name']."<br>";

              }
              ?></td>
              <td><?= ($data['contact_no']); ?></td>
              <td><?= ($data['gender']); ?></td>
              <td>
                <a href="<?= base_url('admin/coach/edit/'.$data['id']); ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                <a href="<?= base_url('admin/coach/delete/'.$data['id']); ?>" class="btn btn-danger"><i class="fa fa-remove"></i></a>
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

