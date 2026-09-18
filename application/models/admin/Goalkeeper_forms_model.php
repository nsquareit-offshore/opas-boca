<?php
	class goalkeeper_forms_model extends CI_Model{


		//---------------------------------------------------
		public function get_key_perf(){
				$this->db->select('
					id,
					name
					'
	    	);
	    	$this->db->from('ci_key_performance');
	    	$query = $this->db->get();					 
			return $query->result_array();

		}

		public function get_quarter_years(){
				$this->db->select('
					id,
					year
					'
	    	);
	    	$this->db->from('ci_quarter_years');
	    	$query = $this->db->get();					 
			return $query->result_array();

		}

		public function get_athlete(){
				$this->db->select('
					id,
					first_name,
					last_name,
					team_name
					'
	    	);
	    	$this->db->from('ci_athlete');
			// $this->db->where('playing_position', 'Goalkeeper');
			$this->db->like('playing_position', 'goal', 'both'); 
	    	$query = $this->db->get();					 
			return $query->result_array();

		}	

		public function get_if_goalkeeper_forms_val($key_per,$id_athle,$id_quarter_year){
		$this->db->select('id,is_active');
		$result = $this->db->get_where('ci_goalkeeper_forms', array('key_performance_indicator' => $key_per,'athlete_id'=>$id_athle,'quarter_year_id'=>$id_quarter_year));
    		$result = $result->row_array();
    		return $result;
		}

		// Insert New coach
		public function add_goalkeeper_forms($data,$forms_id){

		$result = $this->db->get_where('ci_goalkeeper_forms', array('id' => $forms_id));
		if($result->num_rows() > 0){
			$this->db->where('id', $forms_id);
			$this->db->update('ci_goalkeeper_forms', $data);
			return $forms_id;
		}
		else {
			$this->db->insert('ci_goalkeeper_forms', $data);
			return $this->db->insert_id();
		}
			

		}

		// Insert New coach
		public function add_techical_overview($data,$forms_id){
		
		$result = $this->db->get_where('ci_goalkeeper_techical_overview', array('forms_id' => $forms_id));
		if($result->num_rows() > 0){
			$this->db->where('forms_id', $forms_id);
			$this->db->update('ci_goalkeeper_techical_overview', $data);
			return true;
		}
		else {
			$this->db->insert('ci_goalkeeper_techical_overview', $data);
			return $this->db->insert_id();
		}


		}

		// Insert New coach
		public function add_tactical_overview($data,$forms_id){
		
		$result = $this->db->get_where('ci_goalkeeper_tactical_overview', array('forms_id' => $forms_id));
		if($result->num_rows() > 0){

			$this->db->where('forms_id', $forms_id);
			$this->db->update('ci_goalkeeper_tactical_overview', $data);
			return true;
		}
		else {
			$this->db->insert('ci_goalkeeper_tactical_overview', $data);
			return $this->db->insert_id();
		}


		}

		// Insert New coach
		public function add_physical_overview($data,$forms_id){

		$result = $this->db->get_where('ci_goalkeeper_physical_overview', array('forms_id' => $forms_id));
		if($result->num_rows() > 0){
			$this->db->where('forms_id', $forms_id);
			$this->db->update('ci_goalkeeper_physical_overview', $data);
			return true;
		}
		else {
			$this->db->insert('ci_goalkeeper_physical_overview', $data);
			return $this->db->insert_id();
		}

		}

		// Insert New coach
		public function add_psychological_overview($data,$forms_id){

		$result = $this->db->get_where('ci_goalkeeper_psychological_overview', array('forms_id' => $forms_id));
		if($result->num_rows() > 0){
			$this->db->where('forms_id', $forms_id);
			$this->db->update('ci_goalkeeper_psychological_overview', $data);
			return true;

		}
		else {
			$this->db->insert('ci_goalkeeper_psychological_overview', $data);
			return $this->db->insert_id();
		}


		}


		public function get_submit_q_report($id_athle,$id_year){
			$query = $this->db->select('key_performance_indicator');
			$query = $this->db->order_by("key_performance_indicator", "asc");
			$query = $this->db->get_where('ci_goalkeeper_forms', array('athlete_id' => $id_athle,'quarter_year_id' => $id_year,'is_active'=>1));
			//$query = $this->db->get();

			return  $query->result_array();
		}
	}
?>
