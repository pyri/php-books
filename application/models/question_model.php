<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Question_model extends CI_Model {

	function get_tests($user_id){
        $this->db->where('user_id', $user_id);
		$query = $this->db->get('test');
		return $query->result();
	}

    function getTestByQuestionId($question_id){
        $this->db->where('questions.id', $question_id);
        $this->db->select('test.id, test.title');
        $this->db->from('questions');
        $this->db->join('test', 'test.id=questions.test_id');
        $query = $this->db->get();
        return $query->row();
    }

    function getQuestionsByTestId($test_id) {
        $this->db->from('questions');
        $this->db->where('test_id', $test_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getQuestionByQuestionId($question_id)
    {
        $this->db->where('id', $question_id);
        $query = $this->db->get('questions');
        return $query->row();
    }

    function getAnswersByQuestionId($question_id)
    {
        $this->db->where('question_id', $question_id);
        $query = $this->db->get('answers');
        return $query->result();
    }

	function createQuestion($question){
		$this->db->insert('questions', $question);
		$query = $this->db->insert_id('questions');
		return $query;
	}

    function createAnswer($answer){
        $this->db->insert('answers', $answer);
    }

    function updateQuestionTitleByTestId($test_id, $question){
        $this->db->where('test_id', $test_id);
        $this->db->update('questions', $question);
    }

    function updateQuestionByQuestionId($question_id, $question){
        $this->db->where('id', $question_id);
        $this->db->update('questions', $question);
    }

    function insertAnswerByQuestionId($answer){
        $this->db->insert('answers', $answer);
    }

    function deleteQuestionByQuestionId($question_id){
        $this->db->where('id', $question_id);
        $this->db->delete('questions');
    }

    function deleteQuestionByTestId($test_id){
        $this->db->where('questions.test_id', $test_id);
        $this->db->delete('questions');
    }

    function deleteAnswersByQuestionId($question_id){
        $this->db->where('question_id', $question_id);
        $this->db->delete('answers');
    }

    function deleteAnswersByTestId($test_id){
        $this->db->join('questions', 'questions.id=answers.question_id');
        $this->db->where('questions.test_id', $test_id);
        $this->db->delete('answers');
    }
}
