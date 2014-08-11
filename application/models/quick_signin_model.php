<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Quick_signin_model extends CI_Model {

	function check_auth($username, $password)
    {
        $this->db->where('username',$username);
		$this->db->where('password',$password);
        $this->db->select('username');
        $query = $this->db->get('users');
        if($query->num_rows() == 0)
        {
            return FALSE ;
        }
        else
        {
            return TRUE;
        }
    }

    function getUserByName($username)
    {
        $this->db->where('username',$username);
        $query = $this->db->get('users');
        return $query->row();
    }
}
