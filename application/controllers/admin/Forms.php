<?php defined('BASEPATH') OR exit('No direct script access allowed');

class forms extends MY_Controller {

		public function __construct(){

			parent::__construct();
			auth_check(); // check login auth
			$this->rbac->check_module_access();

			$this->load->model('admin/forms_model', 'forms_model');
			$this->load->model('admin/download_report_model', 'download_report_model');
			$this->load->model('admin/Activity_model', 'activity_model');
			$this->load->model('admin/athlete_model', 'athlete_model');
			
			//$data['get_key_perf'] = $this->forms_model->get_key_perf();
		}

		public function submit_q_report(){

			$id_athle = $_POST['id_athle'];
			$id_year = $_POST['id_year'];

			$list_report = $this->forms_model->get_submit_q_report($id_athle,$id_year);
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
			$ids = $this->forms_model->get_if_forms_val($key_per,$id_athle,$id_year);
			if($id_athle){			
				$data['athlet_details'] = $this->athlete_model->get_athlete_by_id($id_athle);
			}
			if($ids){
			$id = $ids['id'];
			
				$data['forms_d_id'] = $id;
				$data['is_active_form'] = $ids['is_active'];
				$data['techical_overview'] = $this->download_report_model->get_techical_overview_repo_id($id);
				$data['tactical_overview'] = $this->download_report_model->get_tactical_overview_repo_id($id);
				$data['physical_overview'] = $this->download_report_model->get_physical_overview_repo_id($id);
				$data['staff_notes_overview'] = $this->download_report_model->get_staff_notes_overview_repo_id($id);
				$data['psychological_overview'] = $this->download_report_model->get_psychological_overview_repo_id($id);
				$data['functional_overview'] = $this->download_report_model->get_functional_overview_repo_id($id);
				$data['boday_overview'] = $this->download_report_model->get_boday_overview_repo_id($id);
				$data['body_overview'] = $this->download_report_model->get_body_overview_repo_id($id);
				$data['residence_notes_overview'] = $this->download_report_model->get_residence_notes_overview_repo_id($id);
				$v_report_name = $this->download_report_model->get_report_name($id);

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
			$data['get_key_perf'] = $this->forms_model->get_key_perf();
			$data['get_athlete'] = $this->forms_model->get_athlete();
			$data['get_quarter_year'] = $this->forms_model->get_quarter_years();
			

		//	$this->load->view('admin/includes/_header');
        //	$this->load->view('admin/forms/forms_add',$data);
       // 	$this->load->view('admin/includes/_footer');



			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit') || $this->input->post('save_draft')){
				

				/* File upload start*/
				// $uploadfile = '';
				$uploadfile = $this->input->post('body_composition_pdf2');
				if(!empty($_FILES['body_composition_pdf']['name'])){
				
					 $config['upload_path']   = './uploads/bodycomposition_pdf'; 
			         $config['allowed_types'] = 'pdf'; 
			         $config['max_size']      = 1000; 
		         
					 // if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");

					 $this->load->library('upload', $config);
						
					if ( ! $this->upload->do_upload('body_composition_pdf')) {
			            $data = array(
							'errors' => $this->upload->display_errors()
						);

			            $this->session->set_flashdata('errors', $data['errors']);
						redirect(base_url('admin/forms'),'refresh');
			         }else{
			         	$uploadfile = $this->upload->data('file_name');
			         }		
		         }
		         /* File upload finish*/

				if($this->input->post('forms_id') && $this->input->post('forms_id') != ''){
					$forms_id = $this->input->post('forms_id');
				} else{
					$forms_id = 0;
				}
				if($this->input->post('submit')){
					$data['forms_data'] = array(
					'key_performance_indicator'=> $this->input->post('key_performance_indicator'),
					'athlete_id'=> $this->input->post('select_athlete_name'),
					'quarter_year_id' => $this->input->post('select_qt_year'),
					'created_date' => date('Y-m-d h:m:s'),
					'is_active' => 1,
					);
				} else{
					$data['forms_data'] = array(
					'key_performance_indicator'=> $this->input->post('key_performance_indicator'),
					'athlete_id'=> $this->input->post('select_athlete_name'),
					'created_date' => date('Y-m-d h:m:s'),
					'quarter_year_id' => $this->input->post('select_qt_year'),
					'is_active' => 0,
					);					
				}
				$data = $this->security->xss_clean($data['forms_data']);

				$forms_id = $this->forms_model->add_forms($data,$forms_id);

				/* ------ techical_overview -------------- */

				$data['techical_overview'] = array(
						'forms_id' => $forms_id,
						'running_with_the_ball'=> $this->input->post('running_with_the_ball'),
						'feinting'=> $this->input->post('feinting'),
						'quality_of_first_touch'=> $this->input->post('quality_of_first_touch'),
						'receiving_under_pressure'=> $this->input->post('receiving_under_pressure'),
						'ball_manipulation'=> $this->input->post('ball_manipulation'),
						'short_passing'=> $this->input->post('short_passing'),
						'long_passing'=> $this->input->post('long_passing'),
						'crossing'=> $this->input->post('crossing'),
						'finishing_inside_the_penalty_area'=> $this->input->post('finishing_inside_the_penalty_area'),
						'finishing_outside_the_penalty_area'=> $this->input->post('finishing_outside_the_penalty_area'),
						'heading_at_goal'=> $this->input->post('heading_at_goal'),
						'tackling'=> $this->input->post('tackling'),
						'defensive_stance'=> $this->input->post('defensive_stance'),
						'defensive_heading'=> $this->input->post('defensive_heading'),
						'non_dominant_foot_ability'=> $this->input->post('non_dominant_foot_ability'),
					);

				$techical_overview_data = $this->security->xss_clean($data['techical_overview']);
				$result = $this->forms_model->add_techical_overview($techical_overview_data,$forms_id);

				/* ------End techical_overview -------------- */


				/* ------ Tactical Overview -------------- */

				$data['tactical_overview'] = array(
						'forms_id' => $forms_id,
						'ta_reading_game'=>$this->input->post('ta_reading_game'),
						'team_philosophy'=>$this->input->post('team_philosophy'),
						'attacking_principles'=>$this->input->post('attacking_principles'),
						'negative_transition_principles'=>$this->input->post('negative_transition_principles'),
						'defending_principles'=>$this->input->post('defending_principles'),
						'positive_transition_principles'=>$this->input->post('positive_transition_principles'),
						'player_position_role'=>$this->input->post('player_position_role'),
						'set_piece_strategies'=>$this->input->post('set_piece_strategies'),
					);

				$tactical_overview_data = $this->security->xss_clean($data['tactical_overview']);
				$result = $this->forms_model->add_tactical_overview($tactical_overview_data,$forms_id);

				/* ------End Tactical Overview -------------- */

				/* ------ Physical Overview -------------- */

				$data['physical_overview'] = array(
						'forms_id' => $forms_id,
						'with_speed_20m'=> $this->input->post('with_speed_20m'),
						'with_speed_40m'=> $this->input->post('with_speed_40m'),
						'with_arrowhead_agility_left_side'=> $this->input->post('with_arrowhead_agility_left_side'),
						'with_arrowhead_agility_right_side'=> $this->input->post('with_arrowhead_agility_right_side'),
						'without_speed_20m'=> $this->input->post('without_speed_20m'),
						'without_speed_40m'=> $this->input->post('without_speed_40m'),
						'yo_yo_intermittent_recovery_test'=> $this->input->post('yo_yo_intermittent_recovery_test'),
						'without_arrowhead_agility_left_side'=> $this->input->post('without_arrowhead_agility_left_side'),
						'without_arrowhead_agility_right_side'=> $this->input->post('without_arrowhead_agility_right_side'),
						'vertical_jump'=> $this->input->post('vertical_jump'),
					);

				$physical_overview_data = $this->security->xss_clean($data['physical_overview']);
				$result = $this->forms_model->add_physical_overview($physical_overview_data,$forms_id);

				/* ------End Physical Overview -------------- */

				/* ------ psychological_overview -------------- */

				$data['psychological_overview'] = array(
						'forms_id' => $forms_id,
						'training_concentration_attention_span'=> $this->input->post('training_concentration_attention_span'),
						'training_emotional_control'=>$this->input->post('training_emotional_control'),
						'training_self_confidence'=>$this->input->post('training_self_confidence'),
						'training_attitude_work_ethic'=>$this->input->post('training_attitude_work_ethic'),
						'training_ability_to_understand_instructions'=>$this->input->post('training_ability_to_understand_instructions'),
						'training_creativity_improvisation'=>$this->input->post('training_creativity_improvisation'),
						'training_decision_making'=>$this->input->post('training_decision_making'),
						'training_leadership_responsibility'=>$this->input->post('training_leadership_responsibility'),
						'training_preparations'=>$this->input->post('training_preparations'),
						'matches_concentration_task_focus'=>$this->input->post('matches_concentration_task_focus'),
						'matches_emotional_control'=>$this->input->post('matches_emotional_control'),
						'matches_self_confidence'=>$this->input->post('matches_self_confidence'),
						'matches_attitude_work_ethic'=>$this->input->post('matches_attitude_work_ethic'),
						'matches_ability_to_understand_instructions'=>$this->input->post('matches_ability_to_understand_instructions'),
						'matches_creativity_improvisation'=>$this->input->post('matches_creativity_improvisation'),
						'matches_decision_making'=>$this->input->post('matches_decision_making'),
						'matches_leadership_responsibility'=>$this->input->post('matches_leadership_responsibility'),
						'match_preparation'=>$this->input->post('match_preparation'),
					);

				$psychological_overview_data = $this->security->xss_clean($data['psychological_overview']);
				$result = $this->forms_model->add_psychological_overview($psychological_overview_data,$forms_id);

				/* ------End psychological_overview -------------- */

				/* ------ Functional Movement Screen -------------- */

				$data['functional_movement_screen'] = array(
						'forms_id' => $forms_id,
						'deep_squat' => $this->input->post('deep_squat'),
						'inline_lunge' => $this->input->post('inline_lunge'),
						'hurdle_crossing' => $this->input->post('hurdle_crossing'),
						'active_single_leg_raise' => $this->input->post('active_single_leg_raise'),
						'trunk_stability_push_ups' => $this->input->post('trunk_stability_push_ups'),
						'rotatory_stability' => $this->input->post('rotatory_stability'), 
					);

				$functional_movement_screen_data = $this->security->xss_clean($data['functional_movement_screen']);
				$result = $this->forms_model->add_functional_movement_screen($functional_movement_screen_data,$forms_id);

				/* ------End Functional Movement Screen-------------- */

				/* ------ Boday Composition Analysis -------------- */

				$data['boday_composition_analysis'] = array(
						'forms_id' => $forms_id,
						'boday_height_range' => $this->input->post('boday_com_hei_id_range'),
						'boday_height_val' => $this->input->post('boday_com_hei_val'),
						'boday_weight_range' => $this->input->post('boday_com_weig_id_range'),
						'boday_weight_val'=> $this->input->post('boday_com_weig_val'),
						'boday_bmi_range'=>$this->input->post('boday_com_bmi_id_range'),
						'boday_bmi_val'=>$this->input->post('boday_com_bmi_val'),
					);

				$boday_composition_analysis_data = $this->security->xss_clean($data['boday_composition_analysis']);
				$result = $this->forms_model->add_boday_composition_analysis($boday_composition_analysis_data,$forms_id);
				/* ------ end Boday Composition Analysis -------------- */

				
				/* ------ Body Composition Analysis -------------- */

				$data['body_composition_analysis'] = array(
						'forms_id' => $forms_id,
						'body_composition_pdf' => $uploadfile,						
					);

				$body_composition_analysis_data = $this->security->xss_clean($data['body_composition_analysis']);
				$result = $this->forms_model->add_body_composition_analysis($body_composition_analysis_data,$forms_id);

				/* ------End Body Composition Analysis -------------- */

				/* ------  Notes From Coaching Staff -------------- */

				$data['staff_notes_overview'] = array(
						'forms_id' => $forms_id,
						'notes_frm_tech_dir'=> $this->input->post('notes_frm_tech_dir'),
						'notes_frm_head_coach'=> $this->input->post('notes_frm_head_coach'),
						
					);

				$staff_notes_overview_data = $this->security->xss_clean($data['staff_notes_overview']);
				$result = $this->forms_model->add_staff_notes_overview($staff_notes_overview_data,$forms_id);

				/* ------End  Notes From Coaching Staff -------------- */

				/* ------ Notes From Residence Warden -------------- */

				$data['residence_notes_overview'] = array(
						'forms_id' => $forms_id,
						'notes_frm_resi_war_education'=> $this->input->post('notes_frm_resi_war_education'),
						'notes_frm_resi_war_discipline'=> $this->input->post('notes_frm_resi_war_discipline'),
						'notes_frm_resi_war_hygiene'=> $this->input->post('notes_frm_resi_war_hygiene'),
						'notes_frm_resi_war_teamwork'=> $this->input->post('notes_frm_resi_war_teamwork'),
						'notes_frm_resi_war_diet'=> $this->input->post('notes_frm_resi_war_diet'),
						'notes_frm_resi_war_conduct'=> $this->input->post('notes_frm_resi_war_conduct'),
						'notes_frm_resi_war_key_observ'=> $this->input->post('notes_frm_resi_war_key_observ'),					
					);

				$residence_notes_overview = $this->security->xss_clean($data['residence_notes_overview']);
				$result = $this->forms_model->add_residence_notes_overview($residence_notes_overview,$forms_id);

				/* ------End Notes From Residence Warden -------------- */

				if($forms_id){
						$this->session->set_flashdata('success', 'forms has been Added Successfully!');

					$id = $forms_id;	
					$data['techical_overview'] = $this->download_report_model->get_techical_overview_repo($id);
					$data['tactical_overview'] = $this->download_report_model->get_tactical_overview_repo($id);
					$data['physical_overview'] = $this->download_report_model->get_physical_overview_repo($id);
					$data['staff_notes_overview'] = $this->download_report_model->get_staff_notes_overview_repo($id);
					$data['psychological_overview'] = $this->download_report_model->get_psychological_overview_repo($id);
					$data['functional_overview'] = $this->download_report_model->get_functional_overview_repo($id);
					$data['boday_overview'] = $this->download_report_model->get_boday_overview_repo($id);
					$data['body_overview'] = $this->download_report_model->get_body_overview_repo_id($id);
					$data['residence_notes_overview'] = $this->download_report_model->get_residence_notes_overview_repo_id($id);
				//	$data['redirect_url'] = base_url('admin/team');

					//$this->load->view('admin/download_report/report_pdf_download', $data);
					if($this->input->post('save_draft')){
						redirect(base_url('admin/forms'));
					} else{
						redirect(base_url('admin/forms'));
					}
					}
				}	
				
			else{
				$data['title'] = 'Create/Update Report';
				//$data['forms_detail'] = $this->forms_model->get_all_forms();
				
				$data['get_key_perf'] = $this->forms_model->get_key_perf();
				$data['get_athlete'] = $this->forms_model->get_athlete();

				$this->load->view('admin/includes/_header',$data);
        		$this->load->view('admin/forms/forms_add',$data);
        		$this->load->view('admin/includes/_footer');
			}
			
		}

	}

?>	