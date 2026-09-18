<?php defined('BASEPATH') OR exit('No direct script access allowed');

class athlete extends MY_Controller {

		public function __construct(){

			parent::__construct();
			auth_check(); // check login auth
			$this->rbac->check_module_access();

			$this->load->model('admin/athlete_model', 'athlete_model');
			$this->load->model('admin/admin_model', 'admin');

			$this->load->model('admin/Activity_model', 'activity_model');
			$this->load->model('admin/coach_model', 'coach_model');
			
		}

		//---------------------------------------------------
		// Get All Invoices
		public function index(){

			$data['athlete_detail'] = $this->athlete_model->get_all_athlete();
			$data['all_team'] = $this->coach_model->get_all_team();
			$data['title'] = 'List of athlete';

			$this->load->view('admin/includes/_header', $data);
        	$this->load->view('admin/athlete/athlete_list', $data);
        	$this->load->view('admin/includes/_footer');
		}

		//---------------------------------------------------
		// Add New Invoices
		public function add()
		{	

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('athlete_email_address', 'Email', 'trim|valid_email|is_unique[ci_athlete.email_address]|required');
				$this->form_validation->set_rules('athlete_sec_email_address', 'Email', 'trim|valid_email');
				$this->form_validation->set_rules('athlete_contact_no', 'Contact No', 'required|regex_match[/^[0-9]{10}$/]');
				
				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('admin/athlete/add'),'refresh');
				}

				/* File upload start*/
				$uploadfile = '';
				if(!empty($_FILES['profile_image']['name'])){
				
					 $config['upload_path']   = './uploads/'; 
			         $config['allowed_types'] = 'gif|jpg|png'; 
			         $config['max_size']      = 1000; 
		         
					 // if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");

					 $this->load->library('upload', $config);
						
					if ( ! $this->upload->do_upload('profile_image')) {
			            $data = array(
							'errors' => $this->upload->display_errors()
						);

			            $this->session->set_flashdata('errors', $data['errors']);
						redirect(base_url('admin/athlete/add'),'refresh');
			         }else{
			         	$uploadfile = $this->upload->data('file_name');
			         }		
		         }
		         /* File upload finish*/			

				$data['athlete_data'] = array(
					'first_name' => $this->input->post('athlete_first_name'),
					'last_name' => $this->input->post('athlete_last_name'),
					'email_address' => $this->input->post('athlete_email_address'),
					'secondary_email_address' => $this->input->post('athlete_sec_email_address'),
					'contact_no' => $this->input->post('athlete_contact_no'),
					'parent_f_name' => $this->input->post('athlete_parent_f_name'),
					'parent_l_name' => $this->input->post('athlete_parent_l_name'),
					'brith_dd' => $this->input->post('athlete_brith_dd'),
					'brith_mm' => $this->input->post('athlete_brith_mm'),
					'brith_yyy' => $this->input->post('athlete_brith_yyy'),
					'city' => $this->input->post('athlete_city'),
					'state' => $this->input->post('athlete_state'),
					'gender' => $this->input->post('athlete_gender'),
					'age_category' => $this->input->post('athlete_age_category'),
					'team_program' => $this->input->post('athlete_team_program'),
					'team_name' => serialize($this->input->post('athlete_team_name[]')),
					'created_date' => date('Y-m-d h:m:s'),
					'playing_position' => $this->input->post('athlete_playing_position'),
					'upload_data' => $uploadfile
				);

				

				$data = $this->security->xss_clean($data['athlete_data']);

				$athlete_id = $this->athlete_model->add_athlete($data);

				if($athlete_id ){
						$this->session->set_flashdata('success', 'Athlete has been Added Successfully!');
						redirect(base_url('admin/athlete'));
					}
				}				
				else{
					$data['title'] = 'Add new athlete';
					$data['athlete_detail'] = $this->athlete_model->get_all_athlete();
					// $data['all_team'] = $this->coach_model->get_all_team();
					$data['all_excellence_team'] = $this->coach_model->get_program_team('Excellence');
					$data['all_residential_team'] = $this->coach_model->get_program_team('Residential');
					$data['all_academic_team'] = $this->coach_model->get_program_team('Academic');

					$this->load->view('admin/includes/_header', $data);
	        		$this->load->view('admin/athlete/athlete_add', $data);
	        		$this->load->view('admin/includes/_footer');
				}
			
		}

		//---------------------------------------------------
		// Get Customer Detail for Invoice
		public function customer_detail($id=0){

		}

		//---------------------------------------------------
		// Get View Invoice
		public function view($id=0){

			$this->rbac->check_operation_access(); // check opration permission

			$data['invoice_detail'] = $this->invoice_model->get_invoice_by_id($id);
			$data['all_team'] = $this->coach_model->get_all_team();
			$data['title'] = 'View athlete';

			$this->load->view('admin/includes/_header', $data);
        	$this->load->view('admin/invoices/invoice_view', $data);
        	$this->load->view('admin/includes/_footer');
		}

		//---------------------------------------------------
		// Edit athlete
		public function edit($id=0){
			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$this->form_validation->set_rules('athlete_email_address', 'Email', 'trim|valid_email|required');
				$this->form_validation->set_rules('athlete_sec_email_address', 'Email', 'trim|valid_email');
				$this->form_validation->set_rules('athlete_contact_no', 'Contact No', 'required|regex_match[/^[0-9]{10}$/]');

				if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('admin/athlete/edit/'.$id));
				}
				else{
					
					// $data = array(
					// 	'admin_role_id' => 6,
					// 	'username' => $this->input->post('athlete_email_address'),
					// 	'firstname' => $this->input->post('athlete_first_name'),
					// 	'lastname' => $this->input->post('athlete_last_name'),
					// 	'email' => $this->input->post('athlete_email_address'),
					// 	'updated_at' => date('Y-m-d : h:m:s'),
					// );

					// if($this->input->post('password') != '')
					// $data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);

					// $data = $this->security->xss_clean($data);
					// $result = $this->athlete_model->edit_admin($data, $this->input->post('athlete_email_address'));


				}

				/* File upload start*/
				$uploadfile = $this->input->post('profile_image2');
				if(!empty($_FILES['profile_image']['name'])){
				
					 $config['upload_path']   = './uploads/'; 
			         $config['allowed_types'] = 'gif|jpg|png'; 
			         $config['max_size']      = 1000; 
		         
					 // if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");

					 $this->load->library('upload', $config);
						
					if ( ! $this->upload->do_upload('profile_image')) {
			            $data = array(
							'errors' => $this->upload->display_errors()
						);

			            $this->session->set_flashdata('errors', $data['errors']);
						redirect(base_url('admin/athlete/edit/'.$id),'refresh');
			         }else{
			         	$uploadfile = $this->upload->data('file_name');
			         }		
		        }
		         /* File upload finish*/		

				$data['athlete_data'] = array(
					'first_name' => $this->input->post('athlete_first_name'),
					'last_name' => $this->input->post('athlete_last_name'),
					'email_address' => $this->input->post('athlete_email_address'),
					'secondary_email_address' => $this->input->post('athlete_sec_email_address'),
					'contact_no' => $this->input->post('athlete_contact_no'),
					'parent_f_name' => $this->input->post('athlete_parent_f_name'),
					'parent_l_name' => $this->input->post('athlete_parent_l_name'),
					'brith_dd' => $this->input->post('athlete_brith_dd'),
					'brith_mm' => $this->input->post('athlete_brith_mm'),
					'brith_yyy' => $this->input->post('athlete_brith_yyy'),
					'city' => $this->input->post('athlete_city'),
					'state' => $this->input->post('athlete_state'),
					'gender' => $this->input->post('athlete_gender'),
					'age_category' => $this->input->post('athlete_age_category'),
					'team_program' => $this->input->post('athlete_team_program'),
					'team_name' => serialize($this->input->post('athlete_team_name[]')),
					'created_date' => date('Y-m-d h:m:s'),
					'playing_position' => $this->input->post('athlete_playing_position'),
					'upload_data' => $uploadfile
				);
				$data = $this->security->xss_clean($data['athlete_data']);

				$athlete_id = $this->athlete_model->update_athlete($data,$id);
				if($athlete_id){
						// Activity Log 
						$this->activity_model->add_log(8);
						$this->session->set_flashdata('success', 'Athlete has been updated Successfully!');
						redirect(base_url('admin/athlete/edit/'.$id));
					}
				}
			else {
				$data['athlete_detail'] = $this->athlete_model->get_athlete_by_id($id);
				// $data['all_team'] = $this->coach_model->get_all_team();
				$data['all_excellence_team'] = $this->coach_model->get_program_team('Excellence');
				$data['all_residential_team'] = $this->coach_model->get_program_team('Residential');
				$data['all_academic_team'] = $this->coach_model->get_program_team('Academic');
				
				$data['title'] = 'Edit athlete';

				$this->load->view('admin/includes/_header', $data);
        		$this->load->view('admin/athlete/athlete_edit', $data);
        		$this->load->view('admin/includes/_footer');
			}
		}

		// Delete Invoices
		public function delete($id){

			$this->rbac->check_operation_access(); // check opration permission

			$result = $this->db->delete('ci_athlete', array('id' => $id));
			if($result){
				// Activity Log 
				$this->session->set_flashdata('success', 'Record has been deleted Successfully!');
				redirect(base_url('admin/athlete'));
			}
		}
	}

?>	