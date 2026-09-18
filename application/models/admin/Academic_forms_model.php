<?php
	class academic_forms_model extends CI_Model{


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
			$this->db->where('team_program', 'Academic');
	    	$query = $this->db->get();					 
			return $query->result_array();

		}	

		public function get_if_academic_forms_val($key_per,$id_athle,$id_quarter_year){
		$this->db->select('id,is_active');
		$result = $this->db->get_where('ci_academic_forms', array('key_performance_indicator' => $key_per,'athlete_id'=>$id_athle,'quarter_year_id'=>$id_quarter_year));
    		$result = $result->row_array();
    		return $result;
		}

		// Insert New coach
		public function add_academic_forms($data,$forms_id){

		$result = $this->db->get_where('ci_academic_forms', array('id' => $forms_id));
		if($result->num_rows() > 0){
			$this->db->where('id', $forms_id);
			$this->db->update('ci_academic_forms', $data);
			return $forms_id;
		}
		else {
			$this->db->insert('ci_academic_forms', $data);
			return $this->db->insert_id();
		}
			

		}

		// Insert New coach
		public function add_techical_overview($data,$forms_id){
		
		$result = $this->db->get_where('ci_academic_techical_overview', array('forms_id' => $forms_id));
		if($result->num_rows() > 0){
			$this->db->where('forms_id', $forms_id);
			$this->db->update('ci_academic_techical_overview', $data);
			return true;
		}
		else {
			$this->db->insert('ci_academic_techical_overview', $data);
			return $this->db->insert_id();
		}


		}

		
		public function get_submit_q_report($id_athle,$id_year){
			$query = $this->db->select('key_performance_indicator');
			$query = $this->db->order_by("key_performance_indicator", "asc");
			$query = $this->db->get_where('ci_academic_forms', array('athlete_id' => $id_athle,'quarter_year_id' => $id_year,'is_active'=>1));
			//$query = $this->db->get();

			return  $query->result_array();
		}
	}
?>
