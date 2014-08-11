<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ckeditor_model extends CI_Model {

    function create($course)
    {
        $this->db->insert('course', $course);
    }

    function read($id)
    {
        $this->db->where('id', $id);
        $this->db->select('source');
        $query = $this->db->get('course');
        return $query->row();
    }
}