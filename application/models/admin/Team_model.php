<?php
	class team_model extends CI_Model{


		//---------------------------------------------------
		// Insert New team
		public function add_team($data){
			$this->db->insert('ci_team', $data);
			return $this->db->insert_id();
		}

		//---------------------------------------------------
		// Get Add team
		public function get_all_team(){
			$this->db->select('
					id,
					team_name,
					team_program,
					age_cat,
					location
					'
	    	);
	    	$this->db->from('ci_team');
	    //	$this->db->join('ci_users', 'ci_users.user_id = ci_payments.user_id ', 'Left');
	    	$query = $this->db->get();					 
			return $query->result_array();
		}

		// Get team Detil by ID
		public function get_team_by_id($id){

				$this->db->select('
					id,
					team_name,
					team_program,
					age_cat,
					location,
					'
	    	);
	    	$this->db->from('ci_team');
	    	$this->db->where('find_in_set(id, "'.$id.'")');
	    	// $this->db->where('id', $id);
	    	$query = $this->db->get();					 
			//return $this->db->last_query();
			return $query->result_array();
		}

		//---------------------------------------------------
		// Get team Detil by ID
		public function update_team($data, $id){
			$this->db->where('id', $id);
			return $this->db->update('ci_team', $data);
		}
	}
?>
