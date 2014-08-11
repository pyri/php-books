<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Answers_model extends CI_Model {

	function create_multiple($answer)
	{
		foreach($answer as $item){
			$this->db->insert('answers_multiple', $item);	
		}		
	}
	
	function create_single($answer_single)
	{
		$this->db->insert('answers_single', $answer_single);	
	}

    function updateAnswerByQuestionId($question_id, $answer){
        $this->db->where('question_id', $question_id);
        $this->db->update('answers', $answer);
    }
}
