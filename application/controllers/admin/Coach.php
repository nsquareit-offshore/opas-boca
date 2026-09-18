<?php defined('BASEPATH') OR exit('No direct script access allowed');

class coach extends MY_Controller {

		public function __construct(){

			parent::__construct();
			auth_check(); // check login auth
			$this->rbac->check_module_access();

			$this->load->model('admin/coach_model', 'coach_model');
			$this->load->model('admin/Activity_model', 'activity_model');
			$this->load->model('admin/admin_model', 'admin');
		}

		//---------------------------------------------------
		// Get All Invoices
		public function index(){

			$data['coach_detail'] = $this->coach_model->get_all_coach();
			$data['title'] = 'List of coach';

			$this->load->view('admin/includes/_header', $data);
        	$this->load->view('admin/coach/coach_list', $data);
        	$this->load->view('admin/includes/_footer');
		}

		//---------------------------------------------------
		// Add New Invoices
		public function add()
		{
			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){

				$this->form_validation->set_rules('coach_email_address', 'Email', 'trim|valid_email|is_unique[ci_users.email]|required');
				$this->form_validation->set_rules('coach_contact_no', 'Contact No', 'required|regex_match[/^[0-9]{10}$/]');

				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('admin/coach/add'),'refresh');
				}

				/* File upload start*/
				$uploadfile = '';
				if(!empty($_FILES['profile_image']['name'])){
					 $config['upload_path']   = './uploads/coach/'; 
			         $config['allowed_types'] = 'gif|jpg|png'; 
			         $config['max_size']      = 1000; 
		         
					 // if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");

					 $this->load->library('upload', $config);
						
					if ( ! $this->upload->do_upload('profile_image')) {
			            $data = array(
							'errors' => $this->upload->display_errors()
						);

			            $this->session->set_flashdata('errors', $data['errors']);
						redirect(base_url('admin/coach/add'),'refresh');
			         }else{
			         	$uploadfile = $this->upload->data('file_name');
			         }		
	         	}
	         	/* File upload finish*/

				$data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);

				$data = array(
					'admin_role_id' => 6,
					'username' => $this->input->post('coach_email_address'),
					'email' => $this->input->post('coach_email_address'),
					'mobile_no' => $this->input->post('coach_contact_no'),		
					'firstname' => $this->input->post('coach_first_name'),
					'lastname' => $this->input->post('coach_last_name'),
					'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
					'is_active' => 1,
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
					'image' => $uploadfile

				);
				$data = $this->security->xss_clean($data);
				$result_id = $this->admin->add_admin($data);

				if(empty($this->input->post('coach_assign_team'))){
					$coach_assign_team = serialize(array("NA"));
				}else{
					$coach_assign_team = serialize($this->input->post('coach_assign_team'));
				}

				$data['coach_data'] = array(
					'first_name' => $this->input->post('coach_first_name'),
					'last_name' => $this->input->post('coach_last_name'),
					'email_address' => $this->input->post('coach_email_address'),
					'contact_no' => $this->input->post('coach_contact_no'),
					'coach_city' => $this->input->post('coach_city'),
					'coach_state' => $this->input->post('coach_state'),
					'gender' => $this->input->post('coach_gender'),
					'assign_team' => $coach_assign_team,
					'is_head_coach' => $this->input->post('is_head_coach'),
					'created_date' => date('Y-m-d h:m:s'),
					'user_id' => $result_id,
					'upload_data' => $uploadfile
				);
				$data = $this->security->xss_clean($data['coach_data']);

				$coach_id = $this->coach_model->add_coach($data);

				if($coach_id){
						$this->session->set_flashdata('success', 'Coach has been Added Successfully!');
						redirect(base_url('admin/coach'));
					}
				}	
				
			else{
				$data['title'] = 'Add new coach';
				$data['coach_detail'] = $this->coach_model->get_all_coach();
				// $data['all_team'] = $this->coach_model->get_all_team();
				$data['all_academic_team'] = $this->coach_model->get_program_team('Academic');
				$data['all_excellence_team'] = $this->coach_model->get_program_team('excellence');
				$data['all_residential_team'] = $this->coach_model->get_program_team('residential');

				$this->load->view('admin/includes/_header', $data);
        		$this->load->view('admin/coach/coach_add', $data);
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
			$data['title'] = 'View coach';

			$this->load->view('admin/includes/_header', $data);
        	$this->load->view('admin/invoices/invoice_view', $data);
        	$this->load->view('admin/includes/_footer');
		}

		//---------------------------------------------------
		// Edit coach
		public function edit($id=0){
			$this->rbac->check_operation_access(); // check opration permission

			$data['coach_detail'] = $this->coach_model->get_coach_by_id($id);

			if($this->input->post('submit')){
				$old_email = $data['coach_detail']['email_address'];
				$new_email = $this->input->post('coach_email_address');

				if($old_email != $new_email){
					$this->form_validation->set_rules('coach_email_address', 'Email', 'trim|valid_email|is_unique[ci_users.email]|required');
				}else{
					$this->form_validation->set_rules('coach_email_address', 'Email', 'trim|valid_email|required');
				}

				// $this->form_validation->set_rules('coach_email_address', 'Email', 'trim|valid_email|required');
				$this->form_validation->set_rules('coach_contact_no', 'Contact No', 'required|regex_match[/^[0-9]{10}$/]');
				

				if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('admin/coach/edit/'.$id));
				} else {

				/* File upload start*/
				$uploadfile = $this->input->post('profile_image2');
				if(!empty($_FILES['profile_image']['name'])){
					 $config['upload_path']   = './uploads/coach/'; 
			         $config['allowed_types'] = 'gif|jpg|png'; 
			         $config['max_size']      = 1000; 
		         
					 // if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");

					 $this->load->library('upload', $config);
						
					if ( ! $this->upload->do_upload('profile_image')) {
			            $data = array(
							'errors' => $this->upload->display_errors()
						);

			            $this->session->set_flashdata('errors', $data['errors']);
						redirect(base_url('admin/coach/edit/'.$id),'refresh');
			         }else{
			         	$uploadfile = $this->upload->data('file_name');
			         }		
			    }     
		         
		         /* File upload finish*/	
		         if(empty($this->input->post('coach_assign_team'))){
					$coach_assign_team = serialize(array("NA"));
				}else{
					$coach_assign_team = serialize($this->input->post('coach_assign_team'));
				}

				$data['coach_data'] = array(
					'first_name' => $this->input->post('coach_first_name'),
					'last_name' => $this->input->post('coach_last_name'),
					'email_address' => $this->input->post('coach_email_address'),
					'contact_no' => $this->input->post('coach_contact_no'),
					'coach_city' => $this->input->post('coach_city'),
					'coach_state' => $this->input->post('coach_state'),
					'gender' => $this->input->post('coach_gender'),
					'assign_team' => $coach_assign_team,
					'is_head_coach' => $this->input->post('is_head_coach'),
					'created_date' => date('Y-m-d h:m:s'),
					'upload_data' => $uploadfile

				);
				
				$data = $this->security->xss_clean($data['coach_data']);

				$coach_id = $this->coach_model->update_coach($data,$id);

				if($this->input->post('password') != '')
				$data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);

				$data = array(
					'admin_role_id' => 6,
					'username' => $this->input->post('coach_email_address'),
					'firstname' => $this->input->post('coach_first_name'),
					'lastname' => $this->input->post('coach_last_name'),
					'email' => $this->input->post('coach_email_address'),
					'mobile_no' => $this->input->post('coach_contact_no'),
					'updated_at' => date('Y-m-d : h:m:s'),
					'image' => $uploadfile
				);

				if($this->input->post('password') != '')
				$data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);

				$data = $this->security->xss_clean($data);
				
				if($old_email != $new_email){
					$result = $this->coach_model->edit_admin($data, $old_email);
				}else{
					$result = $this->coach_model->edit_admin($data, $this->input->post('coach_email_address'));
				}


				}
				if($coach_id){
						// Activity Log 
						$this->activity_model->add_log(8);
						$this->session->set_flashdata('success', 'Coach has been updated Successfully!');
						redirect(base_url('admin/coach/edit/'.$id));
					}
				}
			else {
				
				//$data['all_team'] = $this->coach_model->get_all_team();
				$data['all_academic_team'] = $this->coach_model->get_program_team('Academic');
				$data['all_excellence_team'] = $this->coach_model->get_program_team('excellence');
				$data['all_residential_team'] = $this->coach_model->get_program_team('residential');
				
				$data['title'] = 'Edit Coach';

				$this->load->view('admin/includes/_header', $data);
        		$this->load->view('admin/coach/coach_edit', $data);
        		$this->load->view('admin/includes/_footer');
			}
		}

		// Delete Invoices
		public function delete($id){

			$this->rbac->check_operation_access(); // check opration permission
				
				$this->db->select('
					id,
					first_name,
					last_name,
					email_address,
					contact_no,
					coach_city,
					coach_state,
					gender,
					assign_team,
					'
	    	);
	    	$this->db->from('ci_coach');
	    	$this->db->where('id', $id);
	    	$query = $this->db->get();					 
			$val_res = $query->row_array();
			$result = $this->db->delete('ci_coach', array('id' => $id));
			$this->db->delete('ci_users', array('email' => $val_res['email_address']));
			if($result){
				// Activity Log 
				$this->session->set_flashdata('success', 'Record has been deleted Successfully!');
				redirect(base_url('admin/coach'));
			}
		}
	}

?>	