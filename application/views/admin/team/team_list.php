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
          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; List of Team</h3>
        </div>
        <div class="d-inline-block float-right">
          <?php if($this->rbac->check_operation_permission('add')): ?>
            <a href="<?= base_url('admin/team/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Team</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body table-responsive">
        <table id="na_datatable" class="table table-bordered table-striped" width="100%">
          <thead>
            <tr>
              <th>#<?= trans('id') ?></th>
              <th>Team Name</th>
              <th>Team Program</th>
              <th>Age Category</th>
              <th>Location</th>
              <th width="100" class="text-right">Action</th>
            </tr>
          </thead>
        <tbody>
            <?php 
            foreach($team_detail as $data): ?>
            <tr>
              <td><?= $data['id']; ?></td>  
              <td><?= $data['team_name']; ?></td>
              <td><?php 
              if($data['team_program']=="Academic"){
                echo str_replace("Academic","Academy",$data['team_program']);
              }else{
                echo $data['team_program'];
              }
               ?></td>
              <td><?= $data['age_cat']; ?></td>
              <td><?= ($data['location']); ?></td>
              <td>
                <a href="<?= base_url('admin/team/edit/'.$data['id']); ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                <a href="<?= base_url('admin/team/delete/'.$data['id']); ?>" class="btn btn-danger"><i class="fa fa-remove"></i></a>
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

