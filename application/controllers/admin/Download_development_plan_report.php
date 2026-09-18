<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Download_development_plan_report extends MY_Controller {

		public function __construct(){

			parent::__construct();
			auth_check(); // check login auth
			$this->rbac->check_module_access();

			$this->load->model('admin/Download_development_plan_model', 'download_development_plan_model');
			$this->load->model('admin/Activity_model', 'activity_model');
			$this->load->model('admin/dashboard_model', 'dashboard_model');
			$this->load->model('admin/team_model', 'team_model');

		}

		//---------------------------------------------------
		// Get All Invoices
		public function index(){
			$data['coach'] = get_coach_by_userid($this->session->userdata('user_id'));
			$data['is_supper'] = $this->session->userdata('is_supper');
			
			$data['all_athlete_qt'] = $this->dashboard_model->get_all_athlete_qt();

			$data['all_quarter_year'] = $this->dashboard_model->get_all_academic_quarter_year();
			
			$data['send_email'] = $this->dashboard_model->get_send_mail();
			

			$data['forms_key_detail'] = $this->download_development_plan_model->get_report_list();
			$data['athlete_list'] =$this->download_development_plan_model->get_athlete_list();

			//$data['year_by_athlete'] =$this->download_development_plan_model->get_year_by_athlete();
			//$data['key_perfo_indicat'] =$this->download_development_plan_model->get_key_perfo_indicat();
			$data['title'] = 'Download Report';

			$this->load->view('admin/includes/_header',$data);
        	$this->load->view('admin/download_development_plan_report/download_development_plan_report_add',$data);
        	$this->load->view('admin/includes/_footer');
			
		}


		//---------------------------------------------------
		// Get All Invoices
		public function athlete(){
			$data['coach'] = get_coach_by_userid($this->session->userdata('athlete_id'));
			$data['is_supper'] = $this->session->userdata('is_supper');
			
			$data['all_athlete_qt'] = $this->dashboard_model->get_all_athlete_qt();

			$data['all_quarter_year'] = $this->dashboard_model->get_all_academic_quarter_year();
			
			$data['send_email'] = $this->dashboard_model->get_send_mail();
			

			$data['forms_key_detail'] = $this->download_development_plan_model->get_report_list();
			$data['athlete_list'] =$this->download_development_plan_model->get_athlete_list();

			//$data['year_by_athlete'] =$this->download_development_plan_model->get_year_by_athlete();
			//$data['key_perfo_indicat'] =$this->download_development_plan_model->get_key_perfo_indicat();
			$data['title'] = 'Download Report';

			$this->load->view('admin/includes/_header',$data);
        	$this->load->view('admin/download_development_plan_report/download_development_plan_report_athlete_add',$data);
        	$this->load->view('admin/includes/_footer');
			
		}

		public function year_by_athlete(){
			$athlete_id = $_POST['athlete_id'];
			$data_year = $this->download_development_plan_model->get_year_by_athlete($athlete_id);
			echo json_encode($data_year);
		}



		public function select_year(){
			$year_id = $_POST['year_id'];
			$athlete_id = $_POST['athlete_id'];
			$data_key_per = $this->download_development_plan_model->get_key_perfo_indicat($year_id,$athlete_id);

			
			echo json_encode(array_values($data_key_per));
		}

		//---------------------------------------------------
		// Download PDF report
		public function report_pdf_download(){

			if($this->input->post('submit')){
				$id = $this->input->post('key_performance_indicator');
				$select_year = $this->input->post('select_year');
        		$year_name = (get_year_name_by_id($select_year));
			

			$data['count_q'] = count(explode(',', $id));
			$data['techical_overview'] = $this->download_development_plan_model->get_techical_overview_repo($id);
			

			$v_report_name = $this->download_development_plan_model->get_report_name($id);
			
			$team_ids = unserialize($v_report_name['team_name']);			
			$data['team_name'] = $this->team_model->get_team_by_id(implode(",", $team_ids));

			$data['athlete_name'] = $v_report_name['first_name'].' '.$v_report_name['last_name'];
			$data['athlete_playing_position'] = $v_report_name['playing_position'];
			$data['athlete_age_Category'] = $v_report_name['age_category'];
						
			$key_performance_indicator_ids = $this->download_development_plan_model->get_key_performance_indicator_by_form($id);
			


			$data['report_name'] = $v_report_name['first_name'].' '.$v_report_name['last_name'].' '.$year_name['year'].' Development Plan Report';
				$data['report_type'] = 3;
				$data['report_heading'] = 'INDIVIDUAL DEVELOPMENT PLAN '. $year_name['year'];

		
			}
			
			 $this->load->view('admin/download_development_plan_report/report_pdf_download', $data);
		}

		public function report_view()
		{
		    $id = $this->input->post('key_performance_indicator');
		    $select_year = $this->input->post('select_year');

		    if (empty($id) || empty($select_year)) {
		        echo '<div class="alert alert-danger">Invalid report information.</div>';
		        return;
		    }

		    $year_name = get_year_name_by_id($select_year);

		    $data['count_q'] = count(explode(',', $id));

		    $data['techical_overview'] =
		        $this->download_development_plan_model
		             ->get_techical_overview_repo($id);

		    $v_report_name =
		        $this->download_development_plan_model
		             ->get_report_name($id);

		    if (empty($v_report_name)) {
		        echo '<div class="alert alert-danger">Report not found.</div>';
		        return;
		    }

		    $team_ids = unserialize($v_report_name['team_name']);

		    $data['team_name'] =
		        $this->team_model
		             ->get_team_by_id(implode(",", $team_ids));

		    $data['athlete_name'] =
		        $v_report_name['first_name'] . ' ' .
		        $v_report_name['last_name'];

		    $data['athlete_playing_position'] =
		        $v_report_name['playing_position'];

		    $data['athlete_age_Category'] =
		        $v_report_name['age_category'];

		    $key_performance_indicator_ids =
		        $this->download_development_plan_model
		             ->get_key_performance_indicator_by_form($id);

		    $data['report_name'] =
		        $v_report_name['first_name'] . ' ' .
		        $v_report_name['last_name'] . ' ' .
		        $year_name['year'] .
		        ' Development Plan Report';

		    $data['report_type'] = 3;

		    $data['report_heading'] =
		        'INDIVIDUAL DEVELOPMENT PLAN ' .
		        $year_name['year'];

		    /*
		     * Load a HTML version of the report.
		     */
		    $this->load->view(
		        'admin/download_development_plan_report/report_view',
		        $data
		    );
		}

	}

?>	