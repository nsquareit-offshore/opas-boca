<?php defined('BASEPATH') OR exit('No direct script access allowed');

class academic_forms extends MY_Controller {

		public function __construct(){

			parent::__construct();
			auth_check(); // check login auth
			$this->rbac->check_module_access();

			$this->load->model('admin/academic_forms_model', 'academic_forms_model');
			$this->load->model('admin/download_academic_report_model', 'download_academic_report_model');
			$this->load->model('admin/activity_model', 'activity_model');
			$this->load->model('admin/athlete_model', 'athlete_model');
			
			//$data['get_key_perf'] = $this->academic_forms_model->get_key_perf();
		}

		public function submit_q_report(){

			$id_athle = $_POST['id_athle'];
			$id_year = $_POST['id_year'];

			$list_report = $this->academic_forms_model->get_submit_q_report($id_athle,$id_year);
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
			$ids = $this->academic_forms_model->get_if_academic_forms_val($key_per,$id_athle,$id_year);
			if($id_athle){			
				$data['athlet_details'] = $this->athlete_model->get_athlete_by_id($id_athle);
			}
			if($ids){
			$id = $ids['id'];
			
				$data['academic_forms_d_id'] = $id;
				$data['is_active_form'] = $ids['is_active'];
				$data['techical_overview'] = $this->download_academic_report_model->get_techical_overview_repo_id($id);
				
				$v_report_name = $this->download_academic_report_model->get_report_name($id);

			}
			echo json_encode($data);	
		}

		// public function get_athlete_details(){
		// 	$id_athle = $_POST['id_athle'];

		// 	$data = array();
		// 	if($id_athle){			
		// 		$data['athlet_details'] = $this->athlete_model->get_athlete_by_id($id_athle);
		// 	}
		// 	echo json_encode($data);	
		// }


		//---------------------------------------------------
		// Get All Invoices
		public function index(){
			$data['get_key_perf'] = $this->academic_forms_model->get_key_perf();
			$data['get_athlete'] = $this->academic_forms_model->get_athlete();
			$data['get_quarter_year'] = $this->academic_forms_model->get_quarter_years();
			

		//	$this->load->view('admin/includes/_header');
        //	$this->load->view('admin/academic_forms/academic_forms_add',$data);
       // 	$this->load->view('admin/includes/_footer');



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

				$forms_id = $this->academic_forms_model->add_academic_forms($data,$forms_id);

				/* ------ techical_overview -------------- */

				$data['techical_overview'] = array(
						'forms_id' => $forms_id,
						'ball_manipulation'=> $this->input->post('ball_manipulation'),
						'receiving_and_ball_control'=> $this->input->post('receiving_and_ball_control'),
						'quality_of_first_touch'=> $this->input->post('quality_of_first_touch'),
						'turning_with_the_ball'=> $this->input->post('turning_with_the_ball'),
						'passing_short_range'=> $this->input->post('passing_short_range'),
						'passing_long_range'=> $this->input->post('passing_long_range'),
						'running_with_the_ball'=> $this->input->post('running_with_the_ball'),
						'dribbling_technique'=> $this->input->post('dribbling_technique'),
						'shooting'=> $this->input->post('shooting'),
						'heading'=> $this->input->post('heading'),
						'tackling'=> $this->input->post('tackling'),
						'agility_balance_coordination'=> $this->input->post('agility_balance_coordination'),
						'speed'=> $this->input->post('speed'),
						'ball_manipulation_cmt'=> $this->input->post('ball_manipulation_cmt'),
						'receiving_and_ball_control_cmt'=> $this->input->post('receiving_and_ball_control_cmt'),
						'quality_of_first_touch_cmt'=> $this->input->post('quality_of_first_touch_cmt'),
						'turning_with_the_ball_cmt'=> $this->input->post('turning_with_the_ball_cmt'),
						'passing_short_range_cmt'=> $this->input->post('passing_short_range_cmt'),
						'passing_long_range_cmt'=> $this->input->post('passing_long_range_cmt'),
						'running_with_the_ball_cmt'=> $this->input->post('running_with_the_ball_cmt'),
						'dribbling_technique_cmt'=> $this->input->post('dribbling_technique_cmt'),
						'shooting_cmt'=> $this->input->post('shooting_cmt'),
						'heading_cmt'=> $this->input->post('heading_cmt'),
						'tackling_cmt'=> $this->input->post('tackling_cmt'),
						'agility_balance_coordination_cmt'=> $this->input->post('agility_balance_coordination_cmt'),
						'speed_cmt'=> $this->input->post('speed_cmt'),
						'further_cmt'=> $this->input->post('further_cmt'),
					);

				$techical_overview_data = $this->security->xss_clean($data['techical_overview']);
				$result = $this->academic_forms_model->add_techical_overview($techical_overview_data,$forms_id);

				/* ------End techical_overview -------------- */



				if($forms_id){
						$this->session->set_flashdata('success', 'academic_forms has been Added Successfully!');

					$id = $forms_id;	
					$data['techical_overview'] = $this->download_academic_report_model->get_techical_overview_repo($id);
					
					
				//	$data['redirect_url'] = base_url('admin/team');

					//$this->load->view('admin/download_academic_report/report_pdf_download', $data);
					if($this->input->post('save_draft')){
						redirect(base_url('admin/academic_forms'));
					} else{
						redirect(base_url('admin/academic_forms'));
					}
					}
				}	
				
			else{
				$data['title'] = 'Create/Update Report';
				//$data['academic_forms_detail'] = $this->academic_forms_model->get_all_academic_forms();
				
				$data['get_key_perf'] = $this->academic_forms_model->get_key_perf();
				$data['get_athlete'] = $this->academic_forms_model->get_athlete();

				$this->load->view('admin/includes/_header',$data);
        		$this->load->view('admin/academic_forms/academic_forms_add',$data);
        		$this->load->view('admin/includes/_footer');
			}
			
		}

	}

?>	