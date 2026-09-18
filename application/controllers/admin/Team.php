<?php defined('BASEPATH') OR exit('No direct script access allowed');

class team extends MY_Controller {

		public function __construct(){

			parent::__construct();
			auth_check(); // check login auth
			$this->rbac->check_module_access();

			$this->load->model('admin/team_model', 'team_model');
			$this->load->model('admin/Activity_model', 'activity_model');
		}

		//---------------------------------------------------
		// Get All Invoices
		public function index(){

			$data['team_detail'] = $this->team_model->get_all_team();
			$data['title'] = 'List of team';

			$this->load->view('admin/includes/_header', $data);
        	$this->load->view('admin/team/team_list', $data);
        	$this->load->view('admin/includes/_footer');
		}

		//---------------------------------------------------
		// Add New Invoices
		public function add()
		{
			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$data['team_data'] = array(
					'team_name' => $this->input->post('team_name'),
					'age_cat' => $this->input->post('team_age_category'),
					'team_program' => $this->input->post('team_program'),
					'location' => $this->input->post('team_location'),
					'created_date' => date('Y-m-d h:m:s')
				);
				$data = $this->security->xss_clean($data['team_data']);

				$team_id = $this->team_model->add_team($data);

				if($team_id){
						$this->session->set_flashdata('success', 'Team has been Added Successfully!');
						redirect(base_url('admin/team'));
					}
				}	
				
			else{
				$data['title'] = 'Add new team';
				$data['team_detail'] = $this->team_model->get_all_team();

				$this->load->view('admin/includes/_header', $data);
        		$this->load->view('admin/team/team_add', $data);
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
			$data['title'] = 'View team';

			$this->load->view('admin/includes/_header', $data);
        	$this->load->view('admin/invoices/invoice_view', $data);
        	$this->load->view('admin/includes/_footer');
		}

		//---------------------------------------------------
		// Edit team
		public function edit($id=0){
			$this->rbac->check_operation_access(); // check opration permission

			if($this->input->post('submit')){
				$data['team_data'] = array(
					'team_name' => $this->input->post('team_name'),
					'age_cat' => $this->input->post('team_age_category'),
					'team_program' => $this->input->post('team_program'),
					'location' => $this->input->post('team_location'),
					'created_date' => date('Y-m-d h:m:s')
				);
				$data = $this->security->xss_clean($data['team_data']);

				$team_id = $this->team_model->update_team($data,$id);
				if($team_id){
						// Activity Log 
						$this->activity_model->add_log(8);
						$this->session->set_flashdata('success', 'Team has been updated Successfully!');
						redirect(base_url('admin/team/edit/'.$id));
					}
				}
			else {
				$data['team_detail'] = $this->team_model->get_team_by_id($id);

				$data['title'] = 'Edit team';

				$this->load->view('admin/includes/_header', $data);
        		$this->load->view('admin/team/team_edit', $data);
        		$this->load->view('admin/includes/_footer');
			}
		}

		// Delete Invoices
		public function delete($id){

			$this->rbac->check_operation_access(); // check opration permission

			$result = $this->db->delete('ci_team', array('id' => $id));
			if($result){
				// Activity Log 
				$this->session->set_flashdata('success', 'Record has been deleted Successfully!');
				redirect(base_url('admin/team'));
			}
		}
	}

?>	