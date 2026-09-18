<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datepicker/datepicker3.css">
 <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
  <link rel="stylesheet" href="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css"> 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <?php
     $admin_role_id = $this->session->userdata('admin_role_id');
    if($is_supper == 1 || (isset($coach['is_head_coach']) && $coach['is_head_coach'] == 1)){?>
    <section class="content">
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
              <select class="form-control" name="year" id="year" onchange="this.form.submit()">
                <option value="">Select Year</option>
                <?php 
                  foreach($all_quarter_year as $qyears): ?>
                  <option value="<?= $qyears['id']; ?>" <?= (isset($_GET['year']) && $qyears['id'] == $_GET['year']) ? 'selected' : ''; ?>><?= $qyears['ci_year'] ?></option>
                <?php endforeach; ?>           
              </select>
            </form>
            </div>
            <?php
            if(!empty($_GET['year']) && isset($_GET['year'])){ ?>         

            <form id="frm-example" action="/path/to/your/script.php" method="POST">
          <input type="hidden" name="year_id" id="year_id" value="<?= $_GET['year']; ?>">
                
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
                    $team_arr = array();

                    $coach = get_coach_by_userid($this->session->userdata('user_id'));
                    $team_arr = unserialize($coach['assign_team']); 
                    
                    foreach($all_athlete_qt as $data_athlete):

                        $athlete_team_arr = unserialize($data_athlete['team_name']);
                        $match_team2=array_intersect($team_arr,$athlete_team_arr);

                        $qtr = get_quarter_data($data_athlete['id'],$_GET['year']);
                      
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


                        $qtr = get_quarter_data($data_athlete['id'],$_GET['year']);
                      
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
    <?php } ?>

    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
              &nbsp; Download Report </h3>
          </div>

        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>

            <?php echo form_open( base_url('admin/download_academic_report/report_pdf_download')); ?>
            
            <!-- Select Key -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php 
                                        
                                            if($admin_role_id == 6){
                                                $coach = get_coach_by_userid($this->session->userdata('user_id'));
                                                $team_arr = unserialize($coach['assign_team']); 
                                                ?>
                                                 <select class="form-control" name="select_athlete" id="select_athlete" required="">
                                                    <option value="">Select Athlete</option>
                                                    <?php 
                                                    foreach ($athlete_list as $key => $value_alt) { 
                                                        $athlete_team_arr = unserialize($value_alt['team_name']);
                                                        $match_team=array_intersect($team_arr,$athlete_team_arr);
                                                       
                                                        if(count($match_team) > 0){ ?>
                                                             <option value="<?= $value_alt['id']; ?>"><?= $value_alt['first_name']; ?> <?= $value_alt['last_name']; ?></option>
                                                        <?php }
                                                     } ?>
                                                </select>
                                                <?php
                                            }else{
                                                ?>
                                                 <select class="form-control" name="select_athlete" id="select_athlete" required="">
                                                    <option value="">Select Athlete</option>
                                                    <?php 
                                                    foreach ($athlete_list as $key => $value_alt) { 
                                                       ?>
                                                             <option value="<?= $value_alt['id']; ?>"><?= $value_alt['first_name']; ?> <?= $value_alt['last_name']; ?></option>
                                                    <?php 
                                                     } ?>
                                                </select>
                                                <?php
                                            }
                                        ?>

                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control" name="select_year" id="select_year" required="" style="display: none;">
                                        <option value="">Select Year</option>
                                        
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control" name="key_performance_indicator" id="key_performance_indicator" required="" style="display: none;">
                                        <option value="5">Select Key Performance Indicator</option>
                                        
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" name="submit" value="Download" class="btn btn-primary" id="btn_download" style="display: none;">
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--End Select Key -->



            <!-- End Functional Movement Screen  -->

            <!-- Ball Control -->
            <!-- End Ball Control -->

          <?php echo form_close(); ?>
        </div>  
      </div>
    </section> 

</div>

 <!-- bootstrap datepicker -->
  <script src="<?= base_url() ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script><script src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>
  
  <script>
    $('#invoices').addClass('active');

    $(document).on('change', '#select_athlete', function() {
        var select_athlete = $('#select_athlete').val();
        $('#select_year').hide();
        $('#key_performance_indicator').hide();
        $('#btn_download').hide();
        

    $.ajax({
        type:'POST',
        url:"<?php echo base_url(); ?>admin/download_academic_report/year_by_athlete",
        dataType: 'json',
        data: "athlete_id="+select_athlete,
        success:function(result){
            var options = '';
            options += '<option value="">Select Year</option>';
            for(var i=0; i<result.length; i++) { // Loop through the data & construct the options
                options += '<option value="'+result[i].id+'">'+result[i].year+'</option>';
            }
            $('#select_year').html(options);
            console.log(options);
            if(result.length >= 1){
                $('#select_year').show();
            }
        }
    });
  });

// $(document).on('change', '#select_year', function() {
//         var year_id = $('#select_year').val();
//         var select_athlete = $('#select_athlete').val();
//         $('#key_performance_indicator').hide();
//         $('#btn_download').hide();

//     $.ajax({
//         type:'POST',
//         url:"<?php echo base_url(); ?>admin/download_academic_report/select_year",
//         dataType: 'json',
//         data: "year_id="+year_id+'&athlete_id='+select_athlete,
//         success:function(result){
//             var options = '';
//             options += '<option value="">Select Key Performance Indicator</option>';
//             for(var i=0; i<result.length; i++) { // Loop through the data & construct the options
//                 options += '<option value="'+result[i].id+'">'+result[i].name+'</option>';
//             }   
//             $('#key_performance_indicator').html(options);
//             console.log(result.length);
//             if(result.length >= 1){
//                 $('#key_performance_indicator').show();
//             }
//         }
//     });
// });
$(document).on('change', '#select_year', function() {
    var key_id = $('#select_year').val();
    if(key_id.length >= 1){
        $('#btn_download').show();
    } else{
        $('#btn_download').hide();
    }
});

  </script>
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