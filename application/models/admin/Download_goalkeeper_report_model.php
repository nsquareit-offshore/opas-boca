<?php
	class download_goalkeeper_report_model extends CI_Model{

		//---------------------------------------------------
		// Get Report List for
		public function get_report_list(){
			$this->db->select('
					ci_goalkeeper_forms.id,
					ci_goalkeeper_forms.key_performance_indicator,
					ci_key_performance.name,
					ci_athlete.first_name,
					ci_athlete.last_name,
					ci_quarter_years.year
					'
	    	);
	    	$this->db->from('ci_goalkeeper_forms');

	    	$this->db->join('ci_key_performance', 'ci_key_performance.id = ci_goalkeeper_forms.key_performance_indicator ', 'Left');
	    	$this->db->join('ci_athlete', 'ci_athlete.id = ci_goalkeeper_forms.athlete_id ', 'Left');
	    	$this->db->join('ci_quarter_years', 'ci_quarter_years.id = ci_goalkeeper_forms.quarter_year_id ', 'Left');
	    	$this->db->where('ci_goalkeeper_forms.is_active' , 1);
	    	$query = $this->db->get();					 
			return $query->result_array();
		}

		public function get_athlete_list(){			
			// $admin_role_id = $this->session->userdata('admin_role_id');
			// if($admin_role_id == 6){
			// 	$coach = get_coach_by_userid($this->session->userdata('user_id'));
			// 	return $team_id = $coach['assign_team'];
			// }
				$this->db->select('
						ci_athlete.first_name,
						ci_athlete.last_name,
						ci_athlete.team_name,
						ci_athlete.id
						'
		    	);
		    	
		    	$this->db->from('ci_athlete');
		    	$this->db->join('ci_goalkeeper_forms', 'ci_goalkeeper_forms.athlete_id = ci_athlete.id','LEFT');
		    	$this->db->group_by('ci_athlete.id');
		    	$this->db->where('ci_goalkeeper_forms.is_active' , 1);
		    	$query = $this->db->get();					 
				return $query->result_array();
		}
		public function get_year_by_athlete($athlet_id){
			$this->db->select('
						ci_quarter_years.id,
						ci_quarter_years.year
						'
		    	);
		    	
		    	$this->db->from('ci_quarter_years');
		    	$this->db->join('ci_goalkeeper_forms', 'ci_goalkeeper_forms.quarter_year_id = ci_quarter_years.id','LEFT');
		    	$this->db->group_by('ci_quarter_years.id');
		    	$this->db->where('ci_goalkeeper_forms.is_active' , 1);
		    	$this->db->where('ci_goalkeeper_forms.athlete_id' , $athlet_id);
		    	$query = $this->db->get();					 
				return $query->result_array();
		}
		public function get_key_perfo_indicat($year_id,$athlete_id){
			$this->db->select('
					ci_goalkeeper_forms.id,
					ci_key_performance.name,
					ci_goalkeeper_forms.key_performance_indicator
					'
	    	);
	    	$this->db->from('ci_key_performance');

	    	$this->db->join('ci_goalkeeper_forms', 'ci_goalkeeper_forms.key_performance_indicator = ci_key_performance.id ', 'Left');
	    	$this->db->order_by('ci_key_performance.id','ASC');
	    	$this->db->where('ci_goalkeeper_forms.is_active' , 1);
	    	$this->db->where('ci_goalkeeper_forms.athlete_id' , $athlete_id);
	    	$this->db->where('ci_goalkeeper_forms.quarter_year_id' , $year_id);
	    	$query = $this->db->get();					 
			return $query->result_array();
		}



		public function get_report_name($id){
			$this->db->select('
					ci_goalkeeper_forms.id,
					ci_goalkeeper_forms.key_performance_indicator,
					ci_key_performance.name,
					ci_athlete.first_name,
					ci_athlete.last_name,
					ci_athlete.email_address,
					ci_athlete.age_category,
					ci_athlete.playing_position,
					'
	    	);
	    	$this->db->from('ci_goalkeeper_forms');

	    	$this->db->join('ci_key_performance', 'ci_key_performance.id = ci_goalkeeper_forms.key_performance_indicator ', 'Left');
	    	$this->db->join('ci_athlete', 'ci_athlete.id = ci_goalkeeper_forms.athlete_id ', 'Left');
	    	$this->db->where('ci_goalkeeper_forms.id' , $id);
	    	$query = $this->db->get();					 
			return $query->row_array();
		}

		public function get_techical_overview_repo($id){
			
			$this->db->select('*');
	    	$this->db->from('ci_goalkeeper_techical_overview');
	    	$this->db->where_in('forms_id' , explode(',', $id));
			$query = $this->db->get();
			return $result = $query->result_array();

		}

		public function get_tactical_overview_repo($id){

			$this->db->select('*');
	    	$this->db->from('ci_goalkeeper_tactical_overview');
	    	$this->db->where_in('forms_id' , explode(',', $id));
			$query = $this->db->get();
			return $result = $query->result_array();

		}

		public function get_physical_overview_repo($id){

			$this->db->select('*');
	    	$this->db->from('ci_goalkeeper_physical_overview');
	    	$this->db->where_in('forms_id' , explode(',', $id));
			$query = $this->db->get();
			return $result = $query->result_array();
		}

		public function get_psychological_overview_repo($id){

			$this->db->select('*');
	    	$this->db->from('ci_goalkeeper_psychological_overview');
	    	$this->db->where_in('forms_id' , explode(',', $id));
			$query = $this->db->get();
			return $result = $query->result_array();
		}



		public function get_key_performance_indicator_by_form($ids){
			$this->db->select('
					key_performance_indicator			
					'
	    	);
	    	$this->db->from('ci_goalkeeper_forms');	    
	    	$this->db->where_in('id' , explode(',', $ids));
	    	$query = $this->db->get();
			return $result = $query->result_array();
		}




		public function get_techical_overview_repo_id($id){
			$query = $this->db->get_where('ci_goalkeeper_techical_overview', array('forms_id' => $id));
			return $result = $query->row_array();
		}

		public function get_tactical_overview_repo_id($id){
			$query = $this->db->get_where('ci_goalkeeper_tactical_overview', array('forms_id' => $id));
			return $result = $query->row_array();
		}

		public function get_physical_overview_repo_id($id){
			$query = $this->db->get_where('ci_goalkeeper_physical_overview', array('forms_id' => $id));
			return $result = $query->row_array();
		}

		public function get_psychological_overview_repo_id($id){
			$query = $this->db->get_where('ci_goalkeeper_psychological_overview', array('forms_id' => $id));
			return $result = $query->row_array();
		}

	

	}
?>
