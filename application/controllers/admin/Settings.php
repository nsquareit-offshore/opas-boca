<?php defined('BASEPATH') OR exit('No direct script access allowed');

class settings extends MY_Controller {

		public function __construct(){

			parent::__construct();
			auth_check(); // check login auth
			$this->rbac->check_module_access();

			$this->load->model('admin/Activity_model', 'activity_model');
			$this->load->model('admin/settings_model', 'settings_model');	
			$this->load->model('admin/admin_model', 'admin');

		}

		//---------------------------------------------------
		// Get All Invoices
		public function index(){

			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){

				$this->form_validation->set_rules('password', 'Password', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('admin/settings'),'refresh');
				}

				$data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
				$data = $this->security->xss_clean($data);
				/* Add custom id of superadmin user */
				$result = $this->settings_model->edit_admin_password($data, 31);

				if($result){
					// Activity Log 
					$this->activity_model->add_log(5);

					$this->session->set_flashdata('success', 'Admin has been updated successfully!');
					redirect(base_url('admin/settings'));
				}

			}

			$data['coach'] = get_coach_by_userid($this->session->userdata('user_id'));
			$data['is_supper'] = $this->session->userdata('is_supper');
			
			
			
			$data['title'] = 'Settings';

			$this->load->view('admin/includes/_header',$data);
        	$this->load->view('admin/settings/settings',$data);
        	$this->load->view('admin/includes/_footer');
			
		}

		

	}

?>	