<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Test_model extends CI_Model {

    function create($test){
        $this->db->insert('test', $test);
        $query = $this->db->insert_id('test');
        return $query;
    }

    function getTestTitleByTestId($test_id){
        $this->db->where('id', $test_id);
        $query = $this->db->get('test');
        return $query->row();
    }

    function getTestByLectureId($lecture_id) {
        $this->db->where('pract.lecture_id', $lecture_id);
        $this->db->select('test.title, pract.test_id, pract.lecture_id');
        $this->db->from('test');
        $this->db->join('link_practica as pract', 'pract.test_id = test.id', 'right');
        $query = $this->db->get();
        return $query->row();
    }

    function getQuestionsByTestId($type, $test_id) {
        $this->db->where('type', $type);
        $this->db->where('test_id', $test_id);
        $this->db->from('questions');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getAnswersByQuestionId($question_id) {
        $this->db->from('answers');
        $this->db->where('question_id', $question_id);

        $query = $this->db->get();
        return $query->result_array();
    }

    function getRightAnswerForSingleByQuestionId($question_id) {
        $this->db->where('question_id', $question_id);
        $query = $this->db->get('answers');
        return $query->row();
    }

    function getRightAnswersForMultiByQuestionId($question_id) {
        $this->db->where('right', '1');
        $this->db->where('question_id', $question_id);
        $query = $this->db->get('answers');
        return $query->result();
    }

    function getCourses($user_id, $test_id){
        $this->db->where('user_id', $user_id);
		$this->db->where('pract.test_id', $test_id);
        $this->db->select('course.id, course.title');
        $this->db->from('course');
        $this->db->join('link_practica as pract', 'pract.course_id=course.id');
		$query = $this->db->get();
		return $query->result();
	}

    function getAllFreeCoursesForTest($user_id){
        $this->db->where('user_id', $user_id);
        $this->db->where('pract.course_id', null);
        $this->db->select('course.id, course.title, pract.course_id');
        $this->db->from('course');
        $this->db->join('link_practica as pract', 'pract.course_id=course.id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

	function getLectures($user_id, $test_id){
        $this->db->where('user_id', $user_id);
        $this->db->where('pract.test_id', $test_id);
		$this->db->select('lecture.title, lecture.id');
        $this->db->from('lecture');
        $this->db->join('link_practica as pract', 'pract.lecture_id=lecture.id');
		$query = $this->db->get();
        return $query->result();
	}

    function getAllFreeLecturesForTest($user_id){
        $this->db->where('user_id', $user_id);
        $this->db->where('pract.lecture_id', null);
        $this->db->select('lecture.id, lecture.title, pract.lecture_id');
        $this->db->from('lecture');
        $this->db->join('link_practica as pract', 'pract.lecture_id=lecture.id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    function getAllCourses($user_id){
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('course');
        return $query->result_array();
    }

    function getAllLectures($user_id){
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('lecture');
        return $query->result_array();
    }

    function getCourseByTestId($test_id){
        $this->db->where('pract.test_id', $test_id);
        $this->db->select('course.title, pract.course_id');
        $this->db->from('course');
        $this->db->join('link_practica as pract', 'pract.course_id = course.id', 'right');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getLectureByTestId($test_id){
        $this->db->where('pract.test_id', $test_id);
        $this->db->select('lecture.title, pract.lecture_id');
        $this->db->from('lecture');
        $this->db->join('link_practica as pract', 'pract.lecture_id = lecture.id', 'right');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getQuestion($test_id)
    {
        $this->db->where('test_id', $test_id);
        $query = $this->db->get('questions');
        return $query->result();
    }

    function getAnswers($question_id)
    {
        $this->db->where('question_id', $question_id);
        $this->db->select('title, id');
        $query = $this->db->get('answers');
        return $query->result();
    }


    function getTestsForUnauth(){
        $this->db->where('publish', '1');
        $query = $this->db->get('test');
        return $query->result();
    }

    function publishTest($test, $test_id){
        $this->db->where('id', $test_id);
        $this->db->update('test', $test);
    }

    function getTestById() {
        $this->db->select('test.title as test_title, questions.title as question_title, answers.option as answer_option');
        $this->db->from('questions');
        $this->db->join('test', 'questions.test_id = test.id');
        $this->db->join('answers', 'answers.question_id = questions.id');
        $query = $this->db->get();
        out($query->result());
    }

    function updateTestTitle($test_id, $test){
        $this->db->where('id', $test_id);
        $this->db->update('test', $test);
    }

    function deleteAllTestByTestId($test_id){
        $sql = "DELETE test, questions, answers FROM test
            LEFT JOIN questions ON questions.test_id=test.id
            LEFT JOIN answers ON answers.question_id=questions.id
            WHERE test.id=?";
        $this->db->query($sql, array($test_id));
    }

    function deleteTestByTestId($test_id){
        $this->db->where('id', $test_id);
        $this->db->delete('test');
    }
}
