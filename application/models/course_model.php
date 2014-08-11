<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Course_model extends CI_Model {

	function getTestByCourseId($user_id, $course_id)
	{
        $this->db->where('test.user_id', $user_id);
        $this->db->where('pract.course_id', $course_id);
		$this->db->select('test.title, pract.test_id');
        $this->db->from('test');
        $this->db->join('link_practica as pract', 'pract.test_id = test.id', 'right');
		$query = $this->db->get();
		return $query->result_array(); //не использовать row_array, т.к. при $course_id = 0 результат может иметь более 1 записи
	}

    function getOneTestForCourseId($course_id)
    {
        $this->db->where('pract.course_id', $course_id);
        $this->db->select('test.title, pract.test_id, pract.course_id');
        $this->db->from('test');
        $this->db->join('link_practica as pract', 'pract.test_id = test.id', 'right');
        $query = $this->db->get();
        return $query->result_array(); //не использовать row_array, т.к. при $course_id = 0 результат может иметь более 1 записи
    }

    function getTestForCourse($course_id) {
        $this->db->where('pract.course_id', $course_id);
        $this->db->select('test.title, pract.id');
        $this->db->from('test');
        $this->db->join('link_practica as pract', 'pract.test_id = test.id', 'right');
        $query = $this->db->get();
        return $query->row_array();
    }

    function getCourseAndTest($course_id)
    {
        $this->db->select('course.id as course_id, course.title as course_title, course.source as course_source,
            test.id as test_id, test.title as test_title');
        $this->db->from('course');
        $this->db->join('link_practica as pract', 'pract.course_id = course.id', 'left');
        $this->db->join('test', 'pract.test_id = test.id', 'right');
        $this->db->where('course.id', $course_id);
        $query = $this->db->get();
        return $query->row();
    }

    function getCourse($course_id){
        $this->db->where('id', $course_id);
        $query = $this->db->get('course');
        return $query->row();
    }

    function getCourseForUnauth(){
        $this->db->where('publish', '1');
        $query = $this->db->get('course');
        return $query->result();
    }

    function getAllTests($user_id){
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('test');
        return $query->result_array();
    }

    function getAllFreeTests($user_id, $courseIdForFreeTests){
        $this->db->where_in('pract.course_id', $courseIdForFreeTests);
        $this->db->where('test.user_id', $user_id);
        $this->db->select('test.id, test.title, pract.course_id');
        $this->db->from('test');
        $this->db->join('link_practica as pract', 'pract.test_id = test.id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    function getListLecturesforCourse($course_id){
        $this->db->where('course.id', $course_id);
        $this->db->select('lecture.id, lecture.title');
        $this->db->from('course');
        $this->db->join('lecture', 'lecture.course_id = course.id');
        $query = $this->db->get();
        return $query->result();
    }

    function create($course)
    {
        $this->db->insert('course', $course);
		$query = $this->db->insert_id('course');
		return $query;
    }
	
	function read($course_id)
    {
		$this->db->where('course.id', $course_id);
        $this->db->select('lecture.id as lecture_id, lecture.title as lecture_title,
            course.title as course_title, course.source as course_source,
            test.id as test_id, test.title as test_title'
        );
        $this->db->from('course');
        $this->db->join('lecture', 'lecture.course_id=course.id');
        $this->db->join('link_practica as pract', 'pract.course_id=course.id');
        $this->db->join('test', 'test.id=pract.test_id');
		$query = $this->db->get();
		return $query->result();
    }

    function update($course, $course_id){
        $this->db->where('id', $course_id);
        $this->db->update('course', $course);
    }

    function del($course_id){
        $this->db->where('id', $course_id);
        $this->db->delete('course');
    }

    function getCourseAndLecture($course_id)
    {
        $this->db->select('course.title as c_title, course.author as c_author, course.type_of_publication as c_type, course.source as c_source,
            lecture.id as l_id, lecture.title as l_title, lecture.content as l_content, lecture.selfquestions as l_selfqstns,
            lecture.example as l_example, lecture.task as l_task');
        $this->db->from('course');
        $this->db->join('lecture', 'lecture.course_id = course.id', 'left');
        $this->db->where('course.id', $course_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getTestForLecture($lecture_id) {
        $this->db->where('pract.lecture_id', $lecture_id);
        $this->db->select('test.title, test.id');
        $this->db->from('test');
        $this->db->join('link_practica as pract', 'pract.test_id = test.id');

        $query = $this->db->get();
        return $query->result_array();
    }

	function getQuestionsByTestId($test_id) {
		$this->db->where('test_id', $test_id);
		$query = $this->db->get('questions');
		return $query->result_array();
	}

	function getAnswersByQuestionId($question_id) {
		$this->db->from('answers');
		$this->db->where('question_id', $question_id);
	
		$query = $this->db->get();
		return $query->result_array();
	}

    function publishCourse($course, $course_id){
        $this->db->where('id', $course_id);
        $this->db->update('course', $course);
    }
}
