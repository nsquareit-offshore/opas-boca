<?php
	class coach_model extends CI_Model{


		//---------------------------------------------------
		// Insert New coach
		public function add_coach($data){
			$this->db->insert('ci_coach', $data);
			return $this->db->insert_id();
		}

		//---------------------------------------------------
		// Get Add coach
		public function get_all_coach(){
			$this->db->select('
					id,
					upload_data,
					first_name,
					last_name,
					email_address,
					contact_no,
					gender,
					is_head_coach,
					assign_team
					'
	    	);
	    	$this->db->from('ci_coach');
	    //	$this->db->join('ci_users', 'ci_users.user_id = ci_payments.user_id ', 'Left');
	    	$query = $this->db->get();					 
			return $query->result_array();
		}

		public function get_all_team(){
			$this->db->select('
					id,
					team_name,
					'
	    	);
	    	$this->db->from('ci_team');
	    	$query = $this->db->get();					 
			return $query->result_array();
		}

		
		public function get_program_team($team_program){
			$this->db->select('
					id,
					team_name,
					'
	    	);
	    	$this->db->from('ci_team');
	    	$this->db->where('team_program', $team_program);
	    	$query = $this->db->get();					 
			return $query->result_array();
		}

		// Get coach Detil by ID
		public function get_coach_by_id($id){

				$this->db->select('
					id,
					upload_data,
					first_name,
					last_name,
					email_address,
					contact_no,
					coach_city,
					coach_state,
					gender,
					assign_team,
					is_head_coach,
					'
	    	);
	    	$this->db->from('ci_coach');
	    	$this->db->where('id', $id);
	    	$query = $this->db->get();					 
			return $query->row_array();
		}

		//---------------------------------------------------
		// Get coach Detil by ID
		public function update_coach($data, $id){
			$this->db->where('id', $id);
			return $this->db->update('ci_coach', $data);
		}

		// Edit Admin Record
		public function edit_admin($data, $email){

			$this->db->where('email', $email);
			$this->db->update('ci_users', $data);
			return true;
		}
	}
?>
