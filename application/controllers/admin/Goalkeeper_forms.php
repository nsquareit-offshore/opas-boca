<?php defined('BASEPATH') OR exit('No direct script access allowed');

class goalkeeper_forms extends MY_Controller {

		public function __construct(){

			parent::__construct();
			auth_check(); // check login auth
			$this->rbac->check_module_access();

			$this->load->model('admin/goalkeeper_forms_model', 'goalkeeper_forms_model');
			$this->load->model('admin/download_goalkeeper_report_model', 'download_goalkeeper_report_model');
			$this->load->model('admin/Activity_model', 'activity_model');
			$this->load->model('admin/athlete_model', 'athlete_model');
			
			//$data['get_key_perf'] = $this->goalkeeper_forms_model->get_key_perf();
		}

		public function submit_q_report(){

			$id_athle = $_POST['id_athle'];
			$id_year = $_POST['id_year'];

			$list_report = $this->goalkeeper_forms_model->get_submit_q_report($id_athle,$id_year);
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

			$key_per = $_POST['key_per'];
			$id_athle = $_POST['id_athle'];
			$id_year = $_POST['id_year'];
			$data = array();
			$ids = $this->goalkeeper_forms_model->get_if_goalkeeper_forms_val($key_per,$id_athle,$id_year);
			if($id_athle){			
				$data['athlet_details'] = $this->athlete_model->get_athlete_by_id($id_athle);
			}
			if($ids){
			$id = $ids['id'];
			
				$data['goalkeeper_forms_d_id'] = $id;
				$data['is_active_form'] = $ids['is_active'];
				$data['techical_overview'] = $this->download_goalkeeper_report_model->get_techical_overview_repo_id($id);
				$data['tactical_overview'] = $this->download_goalkeeper_report_model->get_tactical_overview_repo_id($id);
				$data['physical_overview'] = $this->download_goalkeeper_report_model->get_physical_overview_repo_id($id);				
				$data['psychological_overview'] = $this->download_goalkeeper_report_model->get_psychological_overview_repo_id($id);
				$v_report_name = $this->download_goalkeeper_report_model->get_report_name($id);

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
			$data['get_key_perf'] = $this->goalkeeper_forms_model->get_key_perf();
			$data['get_athlete'] = $this->goalkeeper_forms_model->get_athlete();
			$data['get_quarter_year'] = $this->goalkeeper_forms_model->get_quarter_years();
			

		//	$this->load->view('admin/includes/_header');
        //	$this->load->view('admin/goalkeeper_forms/goalkeeper_forms_add',$data);
       // 	$this->load->view('admin/includes/_footer');



			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit') || $this->input->post('save_draft')){
				

				

				if($this->input->post('forms_id') && $this->input->post('forms_id') != ''){
					$forms_id = $this->input->post('forms_id');
				} else{
					$forms_id = 0;
				}
				if($this->input->post('submit')){
					$data['goalkeeper_forms_data'] = array(
					'key_performance_indicator'=> $this->input->post('key_performance_indicator'),
					'athlete_id'=> $this->input->post('select_athlete_name'),
					'quarter_year_id' => $this->input->post('select_qt_year'),
					'created_date' => date('Y-m-d h:m:s'),
					'is_active' => 1,
					);
				} else{
					$data['goalkeeper_forms_data'] = array(
					'key_performance_indicator'=> $this->input->post('key_performance_indicator'),
					'athlete_id'=> $this->input->post('select_athlete_name'),
					'created_date' => date('Y-m-d h:m:s'),
					'quarter_year_id' => $this->input->post('select_qt_year'),
					'is_active' => 0,
					);					
				}
				$data = $this->security->xss_clean($data['goalkeeper_forms_data']);

				$forms_id = $this->goalkeeper_forms_model->add_goalkeeper_forms($data,$forms_id);

				/* ------ techical_overview -------------- */

				$data['techical_overview'] = array(
						'forms_id' => $forms_id,
						'ground_balls'=> $this->input->post('ground_balls'),
						'chest_high_balls'=> $this->input->post('chest_high_balls'),
						'bouncing_balls'=> $this->input->post('bouncing_balls'),
						'tipping'=> $this->input->post('tipping'),
						'deflect_ball'=> $this->input->post('deflect_ball'),
						'reaction_saves'=> $this->input->post('reaction_saves'),
						'to_the_left'=> $this->input->post('to_the_left'),
						'to_the_right'=> $this->input->post('to_the_right'),
						'feet'=> $this->input->post('feet'),
						'drop_kick'=> $this->input->post('drop_kick'),
						'goal_kick'=> $this->input->post('goal_kick'),
					);

				$techical_overview_data = $this->security->xss_clean($data['techical_overview']);
				$result = $this->goalkeeper_forms_model->add_techical_overview($techical_overview_data,$forms_id);

				/* ------End techical_overview -------------- */


				/* ------ Tactical Overview -------------- */

				$data['tactical_overview'] = array(
						'forms_id' => $forms_id,
						'stance'=>$this->input->post('stance'),
						'angle'=>$this->input->post('angle'),
						'crossed_ball'=>$this->input->post('crossed_ball'),
						'penalty_kick'=>$this->input->post('penalty_kick'),
						'corner_kick'=>$this->input->post('corner_kick'),
						'direct_indirect_free_kick'=>$this->input->post('direct_indirect_free_kick'),
						'anticipation'=>$this->input->post('anticipation'),
						'coming_off_goal_line'=>$this->input->post('coming_off_goal_line'),
						'using_the_back_pass_effectively'=>$this->input->post('using_the_back_pass_effectively'),
						'commanding_the_box'=>$this->input->post('commanding_the_box'),
						'organize_defense'=>$this->input->post('organize_defense'),
						'handling_crosses'=>$this->input->post('handling_crosses'),
						'vision_of_the_field'=>$this->input->post('vision_of_the_field'),
						'control_pace'=>$this->input->post('control_pace'),
						'set_position_at_time_of_shot'=>$this->input->post('set_position_at_time_of_shot'),
					);

				$tactical_overview_data = $this->security->xss_clean($data['tactical_overview']);
				$result = $this->goalkeeper_forms_model->add_tactical_overview($tactical_overview_data,$forms_id);

				/* ------End Tactical Overview -------------- */

				/* ------ Physical Overview -------------- */

				$data['physical_overview'] = array(
						'forms_id' => $forms_id,
						'footwork'=> $this->input->post('footwork'),
						'agility'=> $this->input->post('agility'),
						'explosiveness'=> $this->input->post('explosiveness'),
						'coordination_and_body_control'=> $this->input->post('coordination_and_body_control'),
						'reflex_speed'=> $this->input->post('reflex_speed'),
					);

				$physical_overview_data = $this->security->xss_clean($data['physical_overview']);
				$result = $this->goalkeeper_forms_model->add_physical_overview($physical_overview_data,$forms_id);

				/* ------End Physical Overview -------------- */

				/* ------ psychological_overview -------------- */

				$data['psychological_overview'] = array(
						'forms_id' => $forms_id,
						'composure'=> $this->input->post('composure'),
						'leadership'=>$this->input->post('leadership'),
						'bravery'=>$this->input->post('bravery'),
						'self_confidence'=>$this->input->post('self_confidence'),
						'game_mentality'=>$this->input->post('game_mentality'),
						'work_rate'=>$this->input->post('work_rate'),
						'communication_skills'=>$this->input->post('communication_skills'),
					);

				$psychological_overview_data = $this->security->xss_clean($data['psychological_overview']);
				$result = $this->goalkeeper_forms_model->add_psychological_overview($psychological_overview_data,$forms_id);

				/* ------End psychological_overview -------------- */

				

				if($forms_id){
						$this->session->set_flashdata('success', 'goalkeeper_forms has been Added Successfully!');

					$id = $forms_id;	
					$data['techical_overview'] = $this->download_goalkeeper_report_model->get_techical_overview_repo($id);
					$data['tactical_overview'] = $this->download_goalkeeper_report_model->get_tactical_overview_repo($id);
					$data['physical_overview'] = $this->download_goalkeeper_report_model->get_physical_overview_repo($id);
					
					$data['psychological_overview'] = $this->download_goalkeeper_report_model->get_psychological_overview_repo($id);
					
				//	$data['redirect_url'] = base_url('admin/team');

					//$this->load->view('admin/download_goalkeeper_report/report_pdf_download', $data);
					if($this->input->post('save_draft')){
						redirect(base_url('admin/goalkeeper_forms'));
					} else{
						redirect(base_url('admin/goalkeeper_forms'));
					}
					}
				}	
				
			else{
				$data['title'] = 'Create/Update Report';
				//$data['goalkeeper_forms_detail'] = $this->goalkeeper_forms_model->get_all_goalkeeper_forms();
				
				$data['get_key_perf'] = $this->goalkeeper_forms_model->get_key_perf();
				$data['get_athlete'] = $this->goalkeeper_forms_model->get_athlete();

				$this->load->view('admin/includes/_header',$data);
        		$this->load->view('admin/goalkeeper_forms/goalkeeper_forms_add',$data);
        		$this->load->view('admin/includes/_footer');
			}
			
		}

	}

?>	