<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Practica_model extends CI_Model {

	function create($practice){
		$this->db->insert('link_practica', $practice);
	}
	
	function updateCourseId($test_id, $practice){
		$this->db->where('test_id', $test_id);
		$this->db->update('link_practica', $practice);
	}

    function updateLectureId($test_id, $practice){
        $this->db->where('test_id', $test_id);
        $this->db->update('link_practica', $practice);
    }

    function updateCourseIdAndLectureId($course_id, $practice){
        $this->db->where('course_id', $course_id);
        $this->db->update('link_practica', $practice);
    }

    function updateCourseIdAndLectureIdbyTestId($test_id, $practice){
        $this->db->where('test_id', $test_id);
        $this->db->update('link_practica', $practice);
    }

    function updateCourseIdByNull($link, $course_id){
        $this->db->where('course_id', $course_id);
        $this->db->update('link_practica', $link);
    }

    function updateLectureIdByNull($link, $lecture_id){
        $this->db->where('lecture_id', $lecture_id);
        $this->db->update('link_practica', $link);
    }

    function deleteLinkTestByTestId($test_id){
        $this->db->where('test_id', $test_id);
        $this->db->delete('link_practica');
    }
}
