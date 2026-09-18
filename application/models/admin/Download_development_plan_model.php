<?php
	class Download_development_plan_model extends CI_Model{

		//---------------------------------------------------
		// Get Report List for
		public function get_report_list(){
			$this->db->select('
					ci_development_plan_form.id,
					ci_development_plan_form.key_performance_indicator,
					ci_key_performance.name,
					ci_athlete.first_name,
					ci_athlete.last_name,
					ci_quarter_years.year
					'
	    	);
	    	$this->db->from('ci_development_plan_form');

	    	$this->db->join('ci_key_performance', 'ci_key_performance.id = ci_development_plan_form.key_performance_indicator ', 'Left');
	    	$this->db->join('ci_athlete', 'ci_athlete.id = ci_development_plan_form.athlete_id ', 'Left');
	    	$this->db->join('ci_quarter_years', 'ci_quarter_years.id = ci_development_plan_form.quarter_year_id ', 'Left');
	    	$this->db->where('ci_development_plan_form.is_active' , 1);
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
		    	$this->db->join('ci_development_plan_form', 'ci_development_plan_form.athlete_id = ci_athlete.id','LEFT');
		    	$this->db->group_by('ci_athlete.id');
		    	$this->db->where('ci_development_plan_form.is_active' , 1);
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
		    	$this->db->join('ci_development_plan_form', 'ci_development_plan_form.quarter_year_id = ci_quarter_years.id','LEFT');
		    	$this->db->group_by('ci_quarter_years.id');
		    	$this->db->where('ci_development_plan_form.is_active' , 1);
		    	$this->db->where('ci_development_plan_form.athlete_id' , $athlet_id);
		    	$query = $this->db->get();					 
				return $query->result_array();
		}
		public function get_key_perfo_indicat($year_id,$athlete_id){
			$this->db->select('
					ci_development_plan_form.id,
					ci_development_plan_form.quarter_year_id,
					
					'
	    	);
	    	$this->db->from('ci_development_plan_form');	    	
	    	$this->db->where('ci_development_plan_form.is_active' , 1);
	    	$this->db->where('ci_development_plan_form.athlete_id' , $athlete_id);
	    	$this->db->where('ci_development_plan_form.quarter_year_id' , $year_id);
	    	$query = $this->db->get();					 
			return $query->result_array();
		}



		public function get_report_name($id){
			$this->db->select('
					ci_development_plan_form.id,
					ci_development_plan_form.key_performance_indicator,
					ci_key_performance.name,
					ci_athlete.first_name,
					ci_athlete.last_name,
					ci_athlete.email_address,
					ci_athlete.age_category,
					ci_athlete.playing_position,
					ci_athlete.team_name,
					'
	    	);
	    	$this->db->from('ci_development_plan_form');

	    	$this->db->join('ci_key_performance', 'ci_key_performance.id = ci_development_plan_form.key_performance_indicator ', 'Left');
	    	$this->db->join('ci_athlete', 'ci_athlete.id = ci_development_plan_form.athlete_id ', 'Left');
	    	$this->db->where('ci_development_plan_form.id' , $id);
	    	$query = $this->db->get();					 
			return $query->row_array();
		}

		public function get_techical_overview_repo($id){
			
			$this->db->select('*');
	    	$this->db->from('ci_development_plan_overview');
	    	$this->db->where_in('forms_id' , explode(',', $id));
			$query = $this->db->get();
			return $result = $query->result_array();

		}

		

		public function get_key_performance_indicator_by_form($ids){
			$this->db->select('
					key_performance_indicator			
					'
	    	);
	    	$this->db->from('ci_development_plan_form');	    
	    	$this->db->where_in('id' , explode(',', $ids));
	    	$query = $this->db->get();
			return $result = $query->result_array();
		}




		public function get_development_plan_overview_repo_id($id){
			$query = $this->db->get_where('ci_development_plan_overview', array('forms_id' => $id));
			return $result = $query->row_array();
		}

		
	

	}
?>
