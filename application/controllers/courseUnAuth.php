<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CourseUnAuth extends CI_Controller {

    public function read($course_id){
        $this->load->model('course_model');
        $course = $this->course_model->getCourseAndLecture($course_id);
        $test = $this->course_model->getOneTestForCourseId($course_id);
        
		if(!empty($test)){
			$questions = $this->course_model->getQuestionsByTestId($test[0]['test_id']);
			
			foreach ($questions as $key => $question) {
				$questions[$key]['answers'] = $this->course_model->getAnswersByQuestionId($question['id']);
			}
		}
		else {$questions = '';}
		
 

        $data = array(
        'course' => $course,
        'course_id' => $course_id,
        'test' => $test,
        'questions' => $questions,
        'page_title' => $course['0']['c_title']);
        $template['content'] = 'course/readUnAuth';
        $template['sidebar'] = 'blocks/sidebar/none';
        $this->template->page_view($template, $data);
    }
}