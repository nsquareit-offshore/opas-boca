<?php
class Settings_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//-----------------------------------------------------
	public function update_general_setting($data){
		$this->db->where('id', 1);
		$this->db->update('ci_general_settings', $data);
		return true;

	}

		//---------------------------------------------------
	// Edit Admin Record
	public function edit_admin_password($data, $id){
		$this->db->where('user_id', $id);
		$this->db->update('ci_users', $data);
		return true;
	}

	
}
?>