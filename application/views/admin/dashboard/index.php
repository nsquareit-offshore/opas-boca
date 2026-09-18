  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
  <link rel="stylesheet" href="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css"> 
<?php
     $admin_role_id = $this->session->userdata('admin_role_id');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Welcome to Alchemy International Football Academy Dashboard</h1>
          </div><!-- /.col -->
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?= trans('home') ?></a></li>
              <li class="breadcrumb-item active"><?= trans('dashboard') ?> v1</li>
            </ol>
          </div> -->
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $all_athlete; ?></h3>

                <p>No of Athlete</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $all_coach; ?></h3>

                <p>No of Coach</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $all_team; ?></h3>

                <p>No of Team</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $send_email; ?></h3>

                <p>Sent Reports</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->


   <section class="mt-5">
    <div class="card">
      <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
              &nbsp; Send Report to Athlete </h3>
          </div>

      </div>
      <div class="card-body table-responsive">
        <div class="col-lg-4 mb-5">
        <h3 class="card-title mb-3">Select a year</h3>
        <form name="send_year_to_report">
          <select class="form-control" name="select_year" id="select_year" onchange="this.form.submit()">
            <option value="">Select Year</option>
            <?php 
              foreach($all_quarter_year as $qyears): ?>
              <option value="<?= $qyears['id']; ?>" <?= (isset($_GET['select_year']) && $qyears['id'] == $_GET['select_year']) ? 'selected' : ''; ?>><?= $qyears['ci_year'] ?></option>
            <?php endforeach; ?>           
          </select>
        </form>
        </div>
        <?php
        if(!empty($_GET['select_year']) && isset($_GET['select_year'])){ ?>         

        <form id="frm-example" action="/path/to/your/script.php" method="POST">
          <input type="hidden" name="year_id" id="year_id" value="<?= $_GET['select_year']; ?>">
        <table id="na_datatable_team" class="table table-bordered table-striped" width="100%">
          <thead>
            <tr>
                <th></th>
              <th>Name</th>
              <th>Quarter</th>
            </tr>
          </thead>
        <tbody>
            <?php 
                if($admin_role_id == 6){
                    $coach = get_coach_by_userid($this->session->userdata('user_id'));
                    $team_arr = unserialize($coach['assign_team']); 
                    
                    foreach($all_athlete_qt as $data_athlete):

                        $athlete_team_arr = unserialize($data_athlete['team_name']);
                        $match_team2=array_intersect($team_arr,$athlete_team_arr);

                        $qtr = get_quarter_data($data_athlete['id'],$_GET['select_year']);
                      
                        if(empty($qtr)){
                            continue;
                        }

                        if(count($match_team2) > 0){ ?>
                           <tr>
                        <td><?= $data_athlete['id']; ?></td>
                        <td><?= $data_athlete['first_name']; ?> <?= $data_athlete['last_name']; ?></td>
                        <td>
                        <select class="form-control" id="qrt_sele_<?= $data_athlete['id']; ?>" name="qtr_name[<?= $data_athlete['id']; ?>]">
                        <?php foreach ($qtr as $key => $value_qtr) {

                        //print_r($value_qtr); ?>

                           <option value="<?= $value_qtr['id']; ?>"><?= $value_qtr['name'] ?></option>
                        <?php }
                        ?></select></td>
                    </tr>
                        <?php }

                    endforeach;                     
                }else{
                    
                    foreach($all_athlete_qt as $data_athlete):


                        $qtr = get_quarter_data($data_athlete['id'],$_GET['select_year']);
                      
                        if(empty($qtr)){
                            continue;
                        }
                    ?>
                    <tr>
                        <td><?= $data_athlete['id']; ?></td>
                        <td><?= $data_athlete['first_name']; ?> <?= $data_athlete['last_name']; ?></td>
                        <td>
                        <select class="form-control" id="qrt_sele_<?= $data_athlete['id']; ?>" name="qtr_name[<?= $data_athlete['id']; ?>]">
                        <?php foreach ($qtr as $key => $value_qtr) {

                        //print_r($value_qtr); ?>

                           <option value="<?= $value_qtr['id']; ?>"><?= $value_qtr['name'] ?></option>
                        <?php }
                        ?></select></td>
                    </tr>
                    <?php endforeach; ?>
                  
                <?php } ?>
          </tbody>
        </table>
        <p>
          <div id="div_result"></div>
          <button class="btn btn-primary" id="btn_send_email">Send</button></p>

        </form>
      <?php }?>
      </div>
    </div>
    </section>


        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?= base_url() ?>assets/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url() ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?= base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url() ?>assets/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?= base_url() ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?= base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>


<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url() ?>assets/dist/js/pages/dashboard.js"></script>


<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>

<script>
  //---------------------------------------------------

$(document).ready(function() {  

    var table = $('#na_datatable_team').DataTable({     
      'columnDefs': [
         {
            'targets': 0,
            'checkboxes': {
               'selectRow': true
            }
         }
      ],
      'select': {
         'style': 'multi'
      },
      'order': [[1, 'asc']]
    });

     // Handle form submission event 
   $('#frm-example').on('submit', function(e){
        var form = this;
        var obj = {};
        var inc = 0;
      var rows_selected = table.column(0).checkboxes.selected();

      // Iterate over all selected checkboxes
      $.each(rows_selected, function(index, rowId){
         // Create a hidden element 
        console.log("rowId",rowId);
       var qt_sele = jQuery('#qrt_sele_'+rowId).val();
       var year_id = jQuery('#year_id').val();

        obj[rowId] = {'q_id' : qt_sele,'f_id' : rowId,'year_id' : year_id};
      
         $(form).append(
             $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'id[12345]')
                .val(rowId)
         );

       console.log(obj);
        inc += 1

      });
      console.log(inc);
    //  console.log(rows_selected.join(","));

      // FOR DEMONSTRATION ONLY
      // The code below is not needed in production
      
      // Output form data to a console    
 if(inc != 0 && inc >= 0){
   $.ajax({
        type:'POST',
        url:"<?php echo base_url(); ?>admin/dashboard/get_dash_send_email",
        data: "id_form="+JSON.stringify(obj),
        success:function(result){
           $('#div_result').html("<center><strong style='color:green'>Report sent successfully!<br></strong></center>");
            setTimeout(function() {
             window.location.href = result;
            }, 300); 
        },
        error: function(result){
            $("#div_result").html("Error"); 
            jQuery('#btn_send_email').show();
        },
        fail:(function(status) {
            $("#div_result").html("Fail");
            jQuery('#btn_send_email').show();
        }),
        beforeSend:function(d){
          jQuery('#btn_send_email').hide();
        $('#div_result').html("<center><strong style='color:red'>Please Wait...<br></strong></center>");
        }
    });
  }else{
     $("#div_result").html("<center><strong style='color:red'>Please select any athlete</strong></center>");
     jQuery('#btn_send_email').show();
  }

      $('#example-console-rows').text(rows_selected.join(","));
      
      // Output form data to a console     
      $('#example-console-form').text($(form).serialize());
       
      // Remove added elements
      $('input[name="id\[\]"]', form).remove();
       
      // Prevent actual form submission
      e.preventDefault();
   });   

});

</script>