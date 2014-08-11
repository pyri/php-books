<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Office_model extends CI_Model {

	function get_tests($user_id)
	{
        $this->db->where('user_id', $user_id);
		$query = $this->db->get('test');
		return $query->result();
	}	
	
	function get_courses($user_id)
	{
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('course');
		return $query->result();
	}	
}