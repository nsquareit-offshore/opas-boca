<?php
	class Development_plan_model extends CI_Model{


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

		public function get_if_development_plan_forms_val($key_per,$id_athle,$id_quarter_year){
			$this->db->select('id,is_active');
			$result = $this->db->get_where('ci_development_plan_form', array('key_performance_indicator' => $key_per,'athlete_id'=>$id_athle,'quarter_year_id'=>$id_quarter_year));
	    		$result = $result->row_array();
	    		return $result;
		}

		// Insert New coach
		public function add_development_plan_form($data,$forms_id){

			$result = $this->db->get_where('ci_development_plan_form', array('id' => $forms_id));
			if($result->num_rows() > 0){
				$this->db->where('id', $forms_id);
				$this->db->update('ci_development_plan_form', $data);
				return $forms_id;
			}
			else {
				$this->db->insert('ci_development_plan_form', $data);
				return $this->db->insert_id();
			}
				

		}

		// Insert New coach
		public function add_development_plan_overview($data)
		{
		    $this->db->insert('ci_development_plan_overview', $data);

		    return $this->db->insert_id();
		}

		
		public function get_submit_q_report($id_athle,$id_year){
			$query = $this->db->select('key_performance_indicator');
			$query = $this->db->order_by("key_performance_indicator", "asc");
			$query = $this->db->get_where('ci_development_plan_form', array('athlete_id' => $id_athle,'quarter_year_id' => $id_year,'is_active'=>1));
			//$query = $this->db->get();

			return  $query->result_array();
		}

		public function delete_development_plan_overview($forms_id)
		{
		    $this->db->where('forms_id', $forms_id);
		    $this->db->delete('ci_development_plan_overview');
		}

	
		public function get_development_plan_overview_repo_id($forms_id)
		{
		    $sql = "
		        SELECT
		            id,
		            forms_id,
		            development_area_1,
		            development_area_2,
		            individual_development_plan,
		            remark,
		            created_date
		        FROM ci_development_plan_overview
		        WHERE forms_id = ?
		        ORDER BY id ASC
		    ";

		    $query = $this->db->query($sql, array($forms_id));

		   	// echo 'MODEL FORMS ID: ' . $forms_id;
		    //  echo 'MODEL NUM ROWS: ' . $query->num_rows();
		    // print_r($query->result_array());
		    // exit;
		    return $query->result_array();
		}


	}
?>
