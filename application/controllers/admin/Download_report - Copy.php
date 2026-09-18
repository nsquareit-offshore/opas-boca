<?php defined('BASEPATH') OR exit('No direct script access allowed');

class download_report extends MY_Controller {

		public function __construct(){

			parent::__construct();
			auth_check(); // check login auth
			$this->rbac->check_module_access();

			$this->load->model('admin/download_report_model', 'download_report_model');
			$this->load->model('admin/Activity_model', 'activity_model');
			$this->load->model('admin/dashboard_model', 'dashboard_model');
		}

		//---------------------------------------------------
		// Get All Invoices
		public function index(){
			$data['coach'] = get_coach_by_userid($this->session->userdata('user_id'));
			$data['is_supper'] = $this->session->userdata('is_supper');
			
			$data['all_athlete_qt'] = $this->dashboard_model->get_all_athlete_qt();

			$data['all_quarter_year'] = $this->dashboard_model->get_all_quarter_year();
			
			$data['send_email'] = $this->dashboard_model->get_send_mail();
			

			$data['forms_key_detail'] = $this->download_report_model->get_report_list();
			$data['athlete_list'] =$this->download_report_model->get_athlete_list();

			//$data['year_by_athlete'] =$this->download_report_model->get_year_by_athlete();
			//$data['key_perfo_indicat'] =$this->download_report_model->get_key_perfo_indicat();
			$data['title'] = 'Download Report';

			$this->load->view('admin/includes/_header',$data);
        	$this->load->view('admin/download_report/download_report_add',$data);
        	$this->load->view('admin/includes/_footer');
			
		}

		//---------------------------------------------------
		// Get All Invoices
		public function athlete(){
			$data['coach'] = get_coach_by_userid($this->session->userdata('user_id'));
			$data['is_supper'] = $this->session->userdata('is_supper');
			
			$data['all_athlete_qt'] = $this->dashboard_model->get_all_athlete_qt();

			$data['all_quarter_year'] = $this->dashboard_model->get_all_quarter_year();
			
			$data['send_email'] = $this->dashboard_model->get_send_mail();
			

			$data['forms_key_detail'] = $this->download_report_model->get_report_list();
			$data['athlete_list'] =$this->download_report_model->get_athlete_list();

			//$data['year_by_athlete'] =$this->download_report_model->get_year_by_athlete();
			//$data['key_perfo_indicat'] =$this->download_report_model->get_key_perfo_indicat();
			$data['title'] = 'Download Report';

			$this->load->view('admin/includes/_header',$data);
        	$this->load->view('admin/download_report/download_report_parent',$data);
        	$this->load->view('admin/includes/_footer');
			
		}

		public function year_by_athlete(){
			$athlete_id = $_POST['athlete_id'];
			$data_year = $this->download_report_model->get_year_by_athlete($athlete_id);
			echo json_encode($data_year);
		}

		public function select_year(){
			$year_id = $_POST['year_id'];
			$athlete_id = $_POST['athlete_id'];
			$data_key_per = $this->download_report_model->get_key_perfo_indicat($year_id,$athlete_id);

			$count_qt_rep = 1;
			$first_half = 0;
			$second_half = 0;
			$yearly = 0;
			foreach ($data_key_per as $key => $value_per) {

				if($value_per['key_performance_indicator'] == 1 || $value_per['key_performance_indicator'] == 2){
					//$first_half++;	
					$yearly++;		
					$id_qt_f[] = $value_per['id'];
					$id_qt_y[] = $value_per['id'];

				}

				if($value_per['key_performance_indicator'] == 3 || $value_per['key_performance_indicator'] == 4){
					//$second_half++;	
					$yearly++;
					$id_qt_s[] = $value_per['id'];
					$id_qt_y[] = $value_per['id'];


				}

				//sprint_r($value_per['id']);
				
				if($first_half == 2){
					//array_push($data_key_per = ,"blue"=>'Half Yearly Report');
					$data_key_per[4] = array('id' => ($id_qt_f),'name'=>'First Half Yearly Report','key_performance_indicator'=>"5");
				}

				if($second_half == 2){
					//array_push($data_key_per = ,"blue"=>'Half Yearly Report');
					$data_key_per[5] = array('id' => ($id_qt_s),'name'=>'Second Half Yearly Report','key_performance_indicator'=>"6");
				}

				if($yearly == 2){
					$data_key_per[6] = array('id' => ($id_qt_y),'name'=>'Yearly Report','key_performance_indicator'=>"7");
				}
				$count_qt_rep++;
			}
			
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
			

			$labels = array(
			    'Technical',
			    'Psychological',
			    'Functional',
			    'Tactical'
			);


			$data['spiral_chart']['technical_overall'] = calculate_average_score($data['techical_overview'][0]);
			$data['spiral_chart']['tactical_overall'] = calculate_average_score($data['tactical_overview'][0]);
			$data['spiral_chart']['psychological_overall'] = calculate_average_score($data['psychological_overview'][0]);
			$data['spiral_chart']['functional_overall'] = calculate_average_score($data['functional_overview'][0]);

			$cycle1 = array(
			    calculate_average_score($data['techical_overview'][0]),
			    calculate_average_score($data['psychological_overview'][0]),
			    calculate_average_score($data['functional_overview'][0]),
			    calculate_average_score($data['tactical_overview'][0])
			);

			if($data['count_q'] == 2){
				$data['spiral_chart']['technical_overall'] = calculate_average_score($data['techical_overview'][1]);
				$data['spiral_chart']['tactical_overall'] = calculate_average_score($data['tactical_overview'][1]);
				$data['spiral_chart']['psychological_overall'] = calculate_average_score($data['psychological_overview'][1]);
				$data['spiral_chart']['functional_overall'] = calculate_average_score($data['functional_overview'][1]);

				$cycle2 = array(
				    calculate_average_score($data['techical_overview'][1]),
				    calculate_average_score($data['psychological_overview'][1]),
				    calculate_average_score($data['functional_overview'][1]),
				    calculate_average_score($data['tactical_overview'][1])
				);
			}else{
				$cycle2 = array();
			}

			if($v_report_name['key_performance_indicator'] = 1 && $data['count_q'] == 1){
				$label = "Cycle 1";
				$color = "#2196F3";
			}else{
				$label = "Cycle 2";
				$color = "#FFA500";
			}

			$data['spiral_chart']['chart'] = spider_chart(
			    $labels,
			    array(
			        'label' => $label,
			        'color' => $color,
			        'values' => $cycle1
			    ),
			    array(
			        'label' => 'Cycle 2',
			        'color' => '#FFA500',
			        'values' => $cycle2
			    )
			);
			
			
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

			if($yearly == 2){
				$data['report_name'] = $v_report_name['first_name'].' '.$v_report_name['last_name'].' '.$year_name['year'].' Yearly Report';
				$data['report_type'] = 3;
				$data['report_heading'] = $year_name['year'].' Yearly Report';

			}else if($first_half == 2){
				$data['report_name'] = $v_report_name['first_name'].' '.$v_report_name['last_name'].' '.$year_name['year'].' First Half Yearly Report';
				$data['report_type'] = 1;
				$data['report_heading'] = $year_name['year'].' First Half Yearly Report';

			}else if($second_half == 2){
				$data['report_name'] = $v_report_name['first_name'].' '.$v_report_name['last_name'].' '.$year_name['year'].' Second Half Yearly Report';
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

		
			}
			
			 $this->load->view('admin/download_report/report_pdf_download', $data);
		}

	}

?>	