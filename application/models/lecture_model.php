<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lecture_model extends CI_Model {

	function get_courses($user_id){
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('course');
		return $query->result();
	}

	function getAllTests($user_id){
        $this->db->where('user_id', $user_id);
		$query = $this->db->get('test');
		return $query->result();
	}

    function getAllFreeTests($user_id, $lectureIdForFreeTests){
        $this->db->where_in('pract.lecture_id', $lectureIdForFreeTests);
        $this->db->where('test.user_id', $user_id);
        $this->db->select('test.id, test.title, pract.lecture_id');
        $this->db->from('test');
        $this->db->join('link_practica as pract', 'pract.test_id = test.id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    function getLecture($lecture_id){
        $this->db->where('id', $lecture_id);
        $query = $this->db->get('lecture');
        return $query->row();
    }

    function getAnswersByQuestionId($question_id) {
        $this->db->from('answers');
        $this->db->where('question_id', $question_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getCourseIdByLectureId($lecture_id){
        $this->db->where('id', $lecture_id);
        $this->db->select('id, course_id');
        $query = $this->db->get('lecture');
        return $query->row();
    }

    function getCourseByLectureId($lecture_id){
        $this->db->where('lecture.id', $lecture_id);
        $this->db->select('course.id, course.author');
        $this->db->from('course');
        $this->db->join('lecture', 'lecture.course_id = course.id');
        $query = $this->db->get();
        return $query->row();
    }

	function create($lecture)
	{
		$this->db->insert('lecture', $lecture);
		$query = $this->db->insert_id('lecture');
		return $query;
	}

    function update($lecture, $lecture_id){
        $this->db->where('id', $lecture_id);
        $this->db->update('lecture', $lecture);
    }

    function del($lecture_id){
        $this->db->where('id', $lecture_id);
        $this->db->delete('lecture');
    }
}
