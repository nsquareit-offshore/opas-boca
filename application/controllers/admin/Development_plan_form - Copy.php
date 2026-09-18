<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Development_plan_form extends MY_Controller {

		public function __construct(){

			parent::__construct();
			auth_check(); // check login auth
			$this->rbac->check_module_access();

			$this->load->model('admin/development_plan_model', 'development_plan_model');
			$this->load->model('admin/download_development_plan_model', 'download_development_plan_model');
			$this->load->model('admin/athlete_model', 'athlete_model');
			
			//$data['get_key_perf'] = $this->development_plan_model->get_key_perf();
		}

		public function submit_q_report(){

			$id_athle = $_POST['id_athle'];
			$id_year = $_POST['id_year'];

			$list_report = $this->development_plan_model->get_submit_q_report($id_athle,$id_year);
			if($list_report){
				foreach ($list_report as $key => $value_report) {
					# code...
				}
				echo ($value_report['key_performance_indicator'])+1;
			} else{
				echo 1;
			}
		}

		public function form_v_json(){

			$key_per = 5;
			$id_athle = $_POST['id_athle'];
			$id_year = $_POST['id_year'];
			$data = array();
			$ids = $this->development_plan_model->get_if_development_plan_forms_val($key_per,$id_athle,$id_year);
			if($id_athle){			
				$data['athlet_details'] = $this->athlete_model->get_athlete_by_id($id_athle);
			}
			if($ids){
				$id = $ids['id'];
			
				$data['academic_forms_d_id'] = $id;
				$data['is_active_form'] = $ids['is_active'];
				$data['techical_overview'] = $this->download_development_plan_model->get_development_plan_overview_repo_id($id);
				
				$v_report_name = $this->download_development_plan_model->get_report_name($id);

			}
			echo json_encode($data);	
		}

		
		//---------------------------------------------------
		// Get All Invoices
		public function index(){
			$data['get_key_perf'] = $this->development_plan_model->get_key_perf();
			$data['get_athlete'] = $this->development_plan_model->get_athlete();
			$data['get_quarter_year'] = $this->development_plan_model->get_quarter_years();
			

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit') || $this->input->post('save_draft')){
				

				

				if($this->input->post('forms_id') && $this->input->post('forms_id') != ''){
					$forms_id = $this->input->post('forms_id');
				} else{
					$forms_id = 0;
				}
				if($this->input->post('submit')){
					$data['academic_forms_data'] = array(
					'key_performance_indicator'=> 5,
					'athlete_id'=> $this->input->post('select_athlete_name'),
					'quarter_year_id' => $this->input->post('select_qt_year'),
					'created_date' => date('Y-m-d h:m:s'),
					'is_active' => 1,
					);
				} else{
					$data['academic_forms_data'] = array(
					'key_performance_indicator'=> 5,
					'athlete_id'=> $this->input->post('select_athlete_name'),
					'created_date' => date('Y-m-d h:m:s'),
					'quarter_year_id' => $this->input->post('select_qt_year'),
					'is_active' => 0,
					);					
				}
				$data = $this->security->xss_clean($data['academic_forms_data']);

				$forms_id = $this->development_plan_model->add_development_plan_form($data,$forms_id);

				/* ------ techical_overview -------------- */

				$data['development_plan_overview'] = array(
						'forms_id' => $forms_id,
						'development_area_1'=> $this->input->post('development_area_1'),
						'development_area_2'=> $this->input->post('development_area_2'),
						'individual_development_plan'=> $this->input->post('individual_development_plan'),					
					);

				$development_plan_overview_data = $this->security->xss_clean($data['development_plan_overview']);
				$result = $this->development_plan_model->add_development_plan_overview($development_plan_overview_data,$forms_id);

				/* ------End techical_overview -------------- */



				if($forms_id){
						$this->session->set_flashdata('success', 'Development Plan has been Added Successfully!');

					$id = $forms_id;	
					$data['development_plan_overview'] = $this->download_development_plan_model->get_techical_overview_repo($id);
					

					//$this->load->view('admin/download_academic_report/report_pdf_download', $data);
					if($this->input->post('save_draft')){
						redirect(base_url('admin/development_plan_form'));
					} else{
						redirect(base_url('admin/development_plan_form'));
					}
					}
				}	
				
			else{
				$data['title'] = 'Create/Update Report';
				//$data['academic_forms_detail'] = $this->development_plan_model->get_all_academic_forms();
				
				$data['get_key_perf'] = $this->development_plan_model->get_key_perf();
				$data['get_athlete'] = $this->development_plan_model->get_athlete();

				$this->load->view('admin/includes/_header',$data);
        		$this->load->view('admin/development_plan_form/development_plan_form_add',$data);
        		$this->load->view('admin/includes/_footer');
			}
			
		}

	}

?>	