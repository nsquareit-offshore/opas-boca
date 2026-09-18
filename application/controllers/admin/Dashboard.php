<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Dashboard extends My_Controller {



	public function __construct(){

		parent::__construct();

		auth_check(); // check login auth

		$this->rbac->check_module_access();

		if($this->uri->segment(3) != '')
		$this->rbac->check_operation_access();

		$this->load->model('admin/dashboard_model', 'dashboard_model');
		$this->load->model('admin/download_report_model', 'download_report_model');
		$this->load->model('admin/download_goalkeeper_report_model', 'download_goalkeeper_report_model');
		$this->load->model('admin/download_academic_report_model', 'download_academic_report_model');
		$this->load->model('admin/team_model', 'team_model');

	}

	//--------------------------------------------------------------------------

	public function get_dash_send_email(){
		foreach (json_decode($_POST['id_form']) as $key => $value) {
			// $rep_send = '';
			# code...
			$athlete_id =$value->f_id;
			$id = $value->q_id;
			$year_id = $value->year_id;
        	$year_name = (get_year_name_by_id($year_id));

			//print_r($value->q_id);
			//print_r($value->f_id);
			$data['count_q'] = count(explode(',', $id));
			$data['techical_overview'] = $this->download_report_model->get_techical_overview_repo($id);
			$data['tactical_overview'] = $this->download_report_model->get_tactical_overview_repo($id);
			$data['staff_notes_overview'] = $this->download_report_model->get_staff_notes_overview_repo($id);
			$data['physical_overview'] = $this->download_report_model->get_physical_overview_repo($id);
			$data['psychological_overview'] = $this->download_report_model->get_psychological_overview_repo($id);
			$data['functional_overview'] = $this->download_report_model->get_functional_overview_repo($id);
			$data['boday_overview'] = $this->download_report_model->get_boday_overview_repo($id);
			$data['body_overview'] = $this->download_report_model->get_body_overview_repo($id);
			$v_report_name = $this->download_report_model->get_report_name($id);
			$data['athlete_name'] = $v_report_name['first_name'].' '.$v_report_name['last_name'];
			$data['athlete_playing_position'] = $v_report_name['playing_position'];
			$data['athlete_age_Category'] = $v_report_name['age_category'];
			$data['residence_notes_overview'] = $this->download_report_model->get_residence_notes_overview_repo($id);

			$key_performance_indicator_ids = $this->download_report_model->get_key_performance_indicator_by_form($id);

			$first_half = 0;
			$second_half = 0;
			$yearly = 0;

			foreach ($key_performance_indicator_ids as $key => $value_per) {

				if($value_per['key_performance_indicator'] == 1 || $value_per['key_performance_indicator'] == 2){
					//$first_half++;	
					$yearly++;		
					

				}

				if($value_per['key_performance_indicator'] == 3 || $value_per['key_performance_indicator'] == 4){
					//$second_half++;	
					$yearly++;
					
				}
			}

			$data['d_default_q_name'] = 'CYCLE 1';
			
			if($yearly == 2){
				$data['report_name'] = $v_report_name['first_name'].' '.$v_report_name['last_name'].' '.$year_name['year'].' Yearly Report';
				$data['report_type'] = 3;
				$data['report_heading'] = $year_name['year'].' Yearly Report';

			}else if($first_half == 2){
				$data['report_name'] = $v_report_name['first_name'].' '.$v_report_name['last_name'].' '.$year_name['year'].' First Yearly Half Report';
				$data['report_type'] = 1;
				$data['report_heading'] = $year_name['year'].' First Half Yearly Report';

			}else if($second_half == 2){
				$data['report_name'] = $v_report_name['first_name'].' '.$v_report_name['last_name'].' '.$year_name['year'].' Second Yearly Half Report';
				$data['report_type'] = 2;
				$data['report_heading'] = $year_name['year'].' Second Half Yearly Report';
				
			}else{
				$data['report_name'] = $v_report_name['first_name'].' '.$v_report_name['last_name'].' '.$year_name['year'].' '.$v_report_name['name'];
				$data['report_type'] = 0;
				$data['report_heading'] = $year_name['year'].' '.$v_report_name['name'];

				if($v_report_name['key_performance_indicator'] == 1){
					$data['d_default_q_name'] = 'CYCLE 1';
				} else if($v_report_name['key_performance_indicator'] == 2){
					$data['d_default_q_name'] = 'CYCLE 2';
				} else if($v_report_name['key_performance_indicator'] == 3){
					$data['d_default_q_name'] = 'Q3';
				} else if($v_report_name['key_performance_indicator'] == 4){
					$data['d_default_q_name'] = 'Q4';
				}

			}

			// if(count(explode(',', $id)) == 4){
			// 	$report_type_name = 'Yearly Report -'.$v_report_name['first_name'].' '.$v_report_name['last_name'];
			// } else if(count(explode(',', $id)) == 2){
			// 	$report_type_name = 'Half Yearly Report -'.$v_report_name['first_name'].' '.$v_report_name['last_name'];
			// } else{
			// 	$report_type_name = $v_report_name['name'].' - '.$v_report_name['first_name'].' '.$v_report_name['last_name'];
			// }

			// $data['report_name'] = $report_type_name.' - '.$v_report_name['first_name'].' '.$v_report_name['last_name'];
			$data['email_id'] = $v_report_name['email_address'];
			$data['report_subject'] = $data['report_name'].' ';
		
				
			$rep_send = pdf_report_sent($data);

			$data_email_report = array(
				'user_id'=> $athlete_id,
				'form_id'=> $id,
				'send_date' => date('Y-m-d h:m:s'),
			);

			$x_email_report = $this->security->xss_clean($data_email_report);
			email_report_sent_count($x_email_report);

		}
		if($rep_send){
			$this->session->set_flashdata('success', 'Sent Successfully!');
			echo (base_url('admin/dashboard'));
		}


	}

	public function get_dash_send_email_goalkeeper(){
		foreach (json_decode($_POST['id_form']) as $key => $value) {
			// $rep_send = '';
			# code...
			$athlete_id =$value->f_id;
			$id = $value->q_id;
			$year_id = $value->year_id;
        	$year_name = (get_year_name_by_id($year_id));

			//print_r($value->q_id);
			//print_r($value->f_id);
			$data['count_q'] = count(explode(',', $id));
			$data['techical_overview'] = $this->download_goalkeeper_report_model->get_techical_overview_repo($id);
			$data['tactical_overview'] = $this->download_goalkeeper_report_model->get_tactical_overview_repo($id);
			
			$data['physical_overview'] = $this->download_goalkeeper_report_model->get_physical_overview_repo($id);
			$data['psychological_overview'] = $this->download_goalkeeper_report_model->get_psychological_overview_repo($id);
			
			$v_report_name = $this->download_goalkeeper_report_model->get_report_name($id);
			$data['athlete_name'] = $v_report_name['first_name'].' '.$v_report_name['last_name'];
			$data['athlete_playing_position'] = $v_report_name['playing_position'];
			$data['athlete_age_Category'] = $v_report_name['age_category'];
			

			$key_performance_indicator_ids = $this->download_goalkeeper_report_model->get_key_performance_indicator_by_form($id);

			$first_half = 0;
			$second_half = 0;
			$yearly = 0;

			foreach ($key_performance_indicator_ids as $key => $value_per) {

				if($value_per['key_performance_indicator'] == 1 || $value_per['key_performance_indicator'] == 2){
					//$first_half++;	
					$yearly++;		
					

				}

				if($value_per['key_performance_indicator'] == 3 || $value_per['key_performance_indicator'] == 4){
					//$second_half++;	
					$yearly++;
					
				}
			}

			$data['d_default_q_name'] = 'CYCLE 1';
			
			if($yearly == 2){
				$data['report_name'] = $v_report_name['first_name'].' '.$v_report_name['last_name'].' '.$year_name['year'].' Yearly Report';
				$data['report_type'] = 3;
				$data['report_heading'] = $year_name['year'].' Yearly Report';

			}else if($first_half == 2){
				$data['report_name'] = $v_report_name['first_name'].' '.$v_report_name['last_name'].' '.$year_name['year'].' First Yearly Half Report';
				$data['report_type'] = 1;
				$data['report_heading'] = $year_name['year'].' First Half Yearly Report';

			}else if($second_half == 2){
				$data['report_name'] = $v_report_name['first_name'].' '.$v_report_name['last_name'].' '.$year_name['year'].' Second Yearly Half Report';
				$data['report_type'] = 2;
				$data['report_heading'] = $year_name['year'].' Second Half Yearly Report';
				
			}else{
				$data['report_name'] = $v_report_name['first_name'].' '.$v_report_name['last_name'].' '.$year_name['year'].' '.$v_report_name['name'];
				$data['report_type'] = 0;
				$data['report_heading'] = $year_name['year'].' '.$v_report_name['name'];

				if($v_report_name['key_performance_indicator'] == 1){
					$data['d_default_q_name'] = 'CYCLE 1';
				} else if($v_report_name['key_performance_indicator'] == 2){
					$data['d_default_q_name'] = 'CYCLE 2';
				} else if($v_report_name['key_performance_indicator'] == 3){
					$data['d_default_q_name'] = 'Q3';
				} else if($v_report_name['key_performance_indicator'] == 4){
					$data['d_default_q_name'] = 'Q4';
				}

			}

			// if(count(explode(',', $id)) == 4){
			// 	$report_type_name = 'Yearly Report -'.$v_report_name['first_name'].' '.$v_report_name['last_name'];
			// } else if(count(explode(',', $id)) == 2){
			// 	$report_type_name = 'Half Yearly Report -'.$v_report_name['first_name'].' '.$v_report_name['last_name'];
			// } else{
			// 	$report_type_name = $v_report_name['name'].' - '.$v_report_name['first_name'].' '.$v_report_name['last_name'];
			// }

			// $data['report_name'] = $report_type_name.' - '.$v_report_name['first_name'].' '.$v_report_name['last_name'];
			$data['email_id'] = $v_report_name['email_address'];
			$data['report_subject'] = $data['report_name'].' - Boca';
		
				
			$rep_send = pdf_report_sent_goalkeeper($data);

			$data_email_report = array(
				'user_id'=> $athlete_id,
				'form_id'=> $id,
				'send_date' => date('Y-m-d h:m:s'),
			);

			$x_email_report = $this->security->xss_clean($data_email_report);
			email_report_sent_count($x_email_report);

		}
		if($rep_send){
			$this->session->set_flashdata('success', 'Sent Successfully!');
			echo (base_url('admin/dashboard'));
		}


	}

	public function get_dash_send_email_academic(){
		foreach (json_decode($_POST['id_form']) as $key => $value) {
			// $rep_send = '';
			# code...
			$athlete_id =$value->f_id;
			$id = $value->q_id;
			$year_id = $value->year_id;
        	$year_name = (get_year_name_by_id($year_id));

			//print_r($value->q_id);
			//print_r($value->f_id);
			$data['count_q'] = count(explode(',', $id));
			$data['techical_overview'] = $this->download_academic_report_model->get_techical_overview_repo($id);
			
			$v_report_name = $this->download_academic_report_model->get_report_name($id);
			
			$team_ids = unserialize($v_report_name['team_name']);			
			$data['team_name'] = $this->team_model->get_team_by_id(implode(",", $team_ids));

			$data['athlete_name'] = $v_report_name['first_name'].' '.$v_report_name['last_name'];
			$data['athlete_playing_position'] = $v_report_name['playing_position'];
			$data['athlete_age_Category'] = $v_report_name['age_category'];
			

			$key_performance_indicator_ids = $this->download_academic_report_model->get_key_performance_indicator_by_form($id);

			$data['report_name'] = $v_report_name['first_name'].' '.$v_report_name['last_name'].' '.$year_name['year'].' Yearly Report';
			$data['report_type'] = 3;
			$data['report_heading'] = 'ANNUAL ASSESSMENT FORM '. $year_name['year'];


			$data['d_default_q_name'] = 'CYCLE 1';
			

			$data['email_id'] = $v_report_name['email_address'];
			$data['report_subject'] = $data['report_name'].' - Boca';
		
				
			$rep_send = pdf_report_sent_academic($data);

			$data_email_report = array(
				'user_id'=> $athlete_id,
				'form_id'=> $id,
				'send_date' => date('Y-m-d h:m:s'),
			);

			$x_email_report = $this->security->xss_clean($data_email_report);
			email_report_sent_count($x_email_report);

		}
		if($rep_send){
			$this->session->set_flashdata('success', 'Sent Successfully!');
			echo (base_url('admin/dashboard'));
		}


	}

	public function index(){

		if($this->session->userdata('admin_role_id') && $this->session->userdata('admin_role_id') != 3 ){
			$data['coach'] = get_coach_by_userid($this->session->userdata('user_id'));
			$team_id = $data['coach']['assign_team'];
		}
		
		$data['is_supper'] = $this->session->userdata('is_supper');

		
		if(isset($team_id)){
		   $team_arr = unserialize($team_id);  
		}else{
		    $team_arr = array();
		}
		
		
		$data['team'] = $this->team_model->get_team_by_id(implode(",", $team_arr));
		
		$data['all_athlete'] = $this->dashboard_model->get_all_athlete();

		$data['all_coach'] = $this->dashboard_model->get_all_coach();

		$data['all_team'] = $this->dashboard_model->get_all_team();

		$data['all_send_mail'] = $this->dashboard_model->get_send_mail();

		$data['all_athlete_qt'] = $this->dashboard_model->get_all_athlete_qt();

		$data['all_quarter_year'] = $this->dashboard_model->get_all_quarter_year();
		
		$data['send_email'] = $this->dashboard_model->get_send_mail();

		$data['title'] = 'Dashboard';

		$this->load->view('admin/includes/_header', $data);

		if($this->session->userdata('is_supper')){
    		redirect(base_url('admin/dashboard/index_1'));
		}
		else{

			if($this->session->userdata('admin_role_id') && $this->session->userdata('admin_role_id') != 3 ){
				$this->load->view('admin/dashboard/general');
			}else{
				$this->load->view('admin/dashboard/parent');
			}
		}

    	$this->load->view('admin/includes/_footer');

	}

	//--------------------------------------------------------------------------

	public function index_1(){

		$data['all_athlete'] = $this->dashboard_model->get_all_athlete();

		$data['all_coach'] = $this->dashboard_model->get_all_coach();

		$data['all_team'] = $this->dashboard_model->get_all_team();

		$data['send_email'] = $this->dashboard_model->get_send_mail();

		$data['all_athlete_qt'] = $this->dashboard_model->get_all_athlete_qt();

		$data['all_quarter_year'] = $this->dashboard_model->get_all_quarter_year();

		$data['title'] = 'Dashboard';

		$this->load->view('admin/includes/_header', $data);

    	$this->load->view('admin/dashboard/index', $data);

    	$this->load->view('admin/includes/_footer');

	}



	//--------------------------------------------------------------------------

	public function index_2(){

		$data['title'] = 'Dashboard';


		$this->load->view('admin/includes/_header', $data);

    	$this->load->view('admin/dashboard/index2');

    	$this->load->view('admin/includes/_footer');

	}



	//--------------------------------------------------------------------------

	public function index_3(){

		$data['title'] = 'Dashboard';

		$this->load->view('admin/includes/_header', $data);

    	$this->load->view('admin/dashboard/index3');

    	$this->load->view('admin/includes/_footer');

	}


}
?>	