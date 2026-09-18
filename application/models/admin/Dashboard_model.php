<?php
	class Dashboard_model extends CI_Model{

		public function get_all_athlete(){
			return $this->db->count_all('ci_athlete');
		}
		public function get_all_coach(){
			return $this->db->count_all('ci_coach');
		}
		public function get_all_team(){
			return $this->db->count_all('ci_team');
		}
		public function get_send_mail(){
			return $this->db->count_all('ci_send_email_count');
		}
		public function get_all_athlete_qt(){
				$this->db->select('
					ci_athlete.id,
					ci_athlete.first_name,
					ci_athlete.last_name,
					ci_athlete.team_name,
					'

	    	);
	    	$this->db->from('ci_athlete');

	    	//$this->db->join('ci_key_performance', 'ci_key_performance.id = ci_forms.key_performance_indicator ', 'Left');
	    	//$this->db->join('ci_athlete', 'ci_athlete.id = ci_forms.athlete_id ', 'Left');
	    	//$this->db->join('ci_quarter_years', 'ci_quarter_years.id = ci_forms.quarter_year_id ', 'Left');

	    	$query = $this->db->get();					 
			return $query->result_array();
		}




		public function get_all_quarter_year(){
				$this->db->select('
					ci_quarter_years.id,
					ci_quarter_years.year as ci_year,
					ci_forms.id as ci_forms_id,
					'
	    	);
	    	$this->db->from('ci_quarter_years');

	    	$this->db->join('ci_forms', 'ci_forms.quarter_year_id = ci_quarter_years.id ', 'Left');
	    	//$this->db->group_by('year(year)');
		   	$this->db->group_by('ci_quarter_years.id');
		   
		    $this->db->where('ci_forms.is_active' , 1);

	    	$query = $this->db->get();					 
			return $query->result_array();
			
		}

		public function get_all_goalkeeper_quarter_year(){
				$this->db->select('
					ci_quarter_years.id,
					ci_quarter_years.year as ci_year,
					ci_goalkeeper_forms.id as ci_goalkeeper_forms_id,
					'
	    	);
	    	$this->db->from('ci_quarter_years');

	    	$this->db->join('ci_goalkeeper_forms', 'ci_goalkeeper_forms.quarter_year_id = ci_quarter_years.id ', 'Left');
	    	//$this->db->group_by('year(year)');
		   	$this->db->group_by('ci_quarter_years.id');
		   
		    $this->db->where('ci_goalkeeper_forms.is_active' , 1);

	    	$query = $this->db->get();					 
			return $query->result_array();
			
		}

		public function get_all_academic_quarter_year(){
				$this->db->select('
					ci_quarter_years.id,
					ci_quarter_years.year as ci_year,
					ci_academic_forms.id as ci_academic_forms_id,
					'
	    	);
	    	$this->db->from('ci_quarter_years');

	    	$this->db->join('ci_academic_forms', 'ci_academic_forms.quarter_year_id = ci_quarter_years.id ', 'Left');
	    	//$this->db->group_by('year(year)');
		   	$this->db->group_by('ci_quarter_years.id');
		   
		    $this->db->where('ci_academic_forms.is_active' , 1);

	    	$query = $this->db->get();					 
			return $query->result_array();
			
		}

	}

?>
