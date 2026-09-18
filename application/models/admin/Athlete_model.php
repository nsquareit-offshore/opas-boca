<?php
	class athlete_model extends CI_Model{


		//---------------------------------------------------
		// Insert New Athlete
		public function add_athlete($data){
			$this->db->insert('ci_athlete', $data);
			return $this->db->insert_id();
		}

		//---------------------------------------------------
		// Get Add Athlete
		public function get_all_athlete(){
			$this->db->select('
					id,
					upload_data,
					first_name,
					last_name,
					email_address,
					secondary_email_address,
					contact_no,
					gender,
					age_category,
					team_program,
					team_name,
					playing_position
					'
	    	);
	    	$this->db->from('ci_athlete');
	    //	$this->db->join('ci_users', 'ci_users.user_id = ci_payments.user_id ', 'Left');
	    	$query = $this->db->get();					 
			return $query->result_array();
		}

		
		// Get Athlete Detil by ID
		public function get_athlete_by_id($id){

				$this->db->select('
					id,
					upload_data,
					first_name,
					last_name,
					email_address,
					secondary_email_address,
					contact_no,
					parent_f_name,
					parent_l_name,
					brith_dd,
					brith_mm,
					brith_yyy,
					city,
					state,
					gender,
					age_category,
					team_program,
					team_name,
					playing_position,
					'
	    	);
	    	$this->db->from('ci_athlete');
	    	$this->db->where('id', $id);
	    	$query = $this->db->get();					 
			return $query->row_array();
		}

		//---------------------------------------------------
		// Get Athlete Detil by ID
		public function update_athlete($data, $id){
			$this->db->where('id', $id);
			return $this->db->update('ci_athlete', $data);
		}

			//---------------------------------------------------
		// Edit Admin Record
		public function edit_admin($data, $email){

			$this->db->where('email', $email);
			$this->db->update('ci_users', $data);
			return true;
		}

	}
?>
