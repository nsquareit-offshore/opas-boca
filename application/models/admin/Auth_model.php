<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model{

	public function login($data){

		$this->db->from('ci_users');
		$this->db->join('ci_admin_roles','ci_admin_roles.admin_role_id = ci_users.admin_role_id');
		$this->db->where('ci_users.username', $data['username']);

		$query = $this->db->get();
		if ($query->num_rows() == 0){
			return false;
		}
		else{
			//Compare the password attempt with the password we have stored.
			$result = $query->row_array();
		    $validPassword = password_verify($data['password'], $result['password']);
		    if($validPassword){
		        return $result = $query->row_array();
		    }
		}
	}

	public function parent_login($data)
	{
	    $this->db->from('ci_athlete');

	    $query = $this->db->get();

	    if($query->num_rows() == 0)
	    {
	        return false;
	    }

	    foreach($query->result_array() as $row)
	    {
	        // Username = firstname + birth year
            $date = DateTime::createFromFormat('d/m/Y', trim($row['brith_dd']));

			if ($date) {
			    $year = $date->format('Y');
			} else {
			    $year = '';
			}

	        //$year = date('Y', strtotime($row['brith_dd']));
			$lastInitial = strtolower(substr(trim($row['last_name']), 0, 1));
	        $username = strtolower(
	            preg_replace('/\s+/', '', $row['first_name']) .$lastInitial. $year
	        );

	        // Password = DOB numeric only
	        $password = preg_replace('/[^0-9]/', '', $row['brith_dd']);

	        if(
	            strtolower($data['username']) == $username &&
	            $data['password'] == $password
	        )
	        {
	            return $row;
	        }
	    }

	    return false;
	}

	//--------------------------------------------------------------------
	public function register($data){
		$this->db->insert('ci_users', $data);
		return true;
	}

	//--------------------------------------------------------------------
	public function email_verification($code){
		$this->db->select('email, token, is_active');
		$this->db->from('ci_users');
		$this->db->where('token', $code);
		$query = $this->db->get();
		$result= $query->result_array();
		$match = count($result);
		if($match > 0){
			$this->db->where('token', $code);
			$this->db->update('ci_users', array('is_verify' => 1, 'token'=> ''));
			return true;
		}
		else{
			return false;
			}
	}

	//============ Check User Email ============
    function check_user_mail($email)
    {
    	$result = $this->db->get_where('ci_users', array('email' => $email));

    	if($result->num_rows() > 0){
    		$result = $result->row_array();
    		return $result;
    	}
    	else {
    		return false;
    	}
    }

    //============ Update Reset Code Function ===================
    public function update_reset_code($reset_code, $user_id){
    	$data = array('password_reset_code' => $reset_code);
    	$this->db->where('user_id', $user_id);
    	$this->db->update('ci_users', $data);
    }

    //============ Activation code for Password Reset Function ===================
    public function check_password_reset_code($code){

    	$result = $this->db->get_where('ci_users',  array('password_reset_code' => $code ));
    	if($result->num_rows() > 0){
    		return true;
    	}
    	else{
    		return false;
    	}
    }
    
    //============ Reset Password ===================
    public function reset_password($id, $new_password){
	    $data = array(
			'password_reset_code' => '',
			'password' => $new_password
	    );
		$this->db->where('password_reset_code', $id);
		$this->db->update('ci_users', $data);
		return true;
    }

    //--------------------------------------------------------------------
	public function get_admin_detail(){
		$id = $this->session->userdata('user_id');
		$query = $this->db->get_where('ci_users', array('user_id' => $id));
		return $result = $query->row_array();
	}

	//--------------------------------------------------------------------
	public function update_admin($data){
		$id = $this->session->userdata('user_id');
		$this->db->where('user_id', $id);
		$this->db->update('ci_users', $data);
		return true;
	}

	//--------------------------------------------------------------------
	public function change_pwd($data, $id){
		$this->db->where('user_id', $id);
		$this->db->update('ci_users', $data);
		return true;
	}

}

?>