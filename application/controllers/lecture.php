<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lecture extends MY_Controller {

	function create() 
	{		
		if(isset($_POST['add_lecture']))
		{		
			$this->load->model('rules_model');
			$this->form_validation->set_rules($this->rules_model->lecture_rules);
			$check = $this->form_validation->run();
			
			if($check == TRUE){
                $this->load->model('course_model');
				$lecture['title'] = $this->input->post('lecture_title');     	
				$lecture['content'] = $this->input->post('lecture_content');
				$lecture['selfquestions'] = $this->input->post('lecture_selfquestions');
				$lecture['example'] = $this->input->post('lecture_examples');
				$lecture['task'] = $this->input->post('lecture_tasks');
				$lecture['course_id'] = $this->input->post('lecture_course');
                $lecture['user_id'] = $this->session->userdata('user_id');

                $test_id = $this->input->post('lecture_test');

				$this->load->model('lecture_model');
				$lecture_id = $this->lecture_model->create($lecture);
                $practicе['lecture_id'] = $lecture_id;

                if(!empty($test_id)){
                    $this->load->model('practica_model');
                    $this->practica_model->updateLectureId($test_id, $practicе);
                }

                $msg = array(
                    'firstPartMsg' =>'Лекция ',
                    'title' => '"'.$lecture['title'].'"',
                    'id' => $lecture_id,
                    'secondPartMsg' => ' создана',
                    'object' => 'lecture'
                );
                $this->session->set_flashdata($msg);

                redirect (base_url().'notice/create');
			}
		}
		
		$this->load->model('lecture_model');
        $user_id = $user_id = $this->session->userdata('user_id');
		$data['courses'] = $this->lecture_model->get_courses($user_id);
		$data['tests'] = $this->lecture_model->getAllTests($user_id);
        $data['page_title'] = 'Создание лекции';
        $name['content'] = 'lecture/create';
		$name['sidebar'] = 'blocks/sidebar/short';
		$this->template->page_view($name, $data);	
	}
	
	function read($lecture_id) 
	{
        $msg = '';
		$data = array();
		$this->load->model('lecture_model');
        $this->load->model('course_model');
        $this->load->model('test_model');
        $this->load->model('question_model');
        $course_id = $this->lecture_model->getCourseIdByLectureId($lecture_id);
        $list_lectures = $this->course_model->getListLecturesforCourse($course_id->course_id);
		$lecture = $this->lecture_model->getLecture($lecture_id);
        $test = $this->test_model->getTestByLectureId($lecture_id);
        if(!empty($test)){
            $questions = $this->question_model->getQuestionsByTestId($test->test_id);

            foreach ($questions as $key => $question) {
                $questions[$key]['answers'] = $this->lecture_model->getAnswersByQuestionId($question['id']);
            }
        }
        else{
            $questions = '';
        }

        if(isset($_POST['pdf_lecture'])) {
            $this->load->library('pdf');
            $this->load->model('lecture_model');
            $this->load->model('question_model');

            $lecture = $this->lecture_model->getLecture($lecture_id);
            $test = $this->test_model->getTestByLectureId($lecture_id);
            $questions = $this->question_model->getQuestionsByTestId($test->test_id);
            $course = $this->lecture_model->getCourseByLectureId($lecture_id);
            $author = $course->author;

            foreach ($questions as $key => $question) {
                $questions[$key]['answers'] = $this->question_model->getAnswersByQuestionId($question['id']);
            }

            //данные для тестов лекций
            $msg = 'Создана pdf-копия лекции';
            $this->session->set_flashdata('msg',  $msg);
            $file_name = translit($lecture->title).'.pdf';
            $this->pdf->generateLecture($file_name, $author, $lecture, $test, $questions);
        }

        $data = array(
            'list_lectures' => $list_lectures,
            'lecture' => $lecture,
            'lecture_id' => $lecture_id,
            'test' => $test,
            'questions' => $questions,
            'msg' =>$msg,
            'lecture_id' => $lecture_id,
            'page_title' => $lecture->title);
        $template['content'] = 'lecture/read';
        $template['sidebar'] = 'blocks/sidebar/long';
		$this->template->page_view($template, $data);
	}

    public function update($lecture_id){
        $data = array();
        $this->load->model('lecture_model');
        $this->load->model('test_model');

        if(isset($_POST['update_lecture'])){
            $this->load->model('rules_model');
            $this->form_validation->set_rules($this->rules_model->lecture_rules);
            $check = $this->form_validation->run();

            if($check == TRUE){
                $this->load->model('practica_model');

                $lecture['title'] = $this->input->post('lecture_title');
                $lecture['content'] = $this->input->post('lecture_content');
                $lecture['selfquestions'] = $this->input->post('lecture_questions');
                $lecture['example'] = $this->input->post('lecture_example');
                $lecture['task'] = $this->input->post('lecture_task');
                $test_id = $this->input->post('lecture_test');
                $this->lecture_model->update($lecture, $lecture_id);

                if(!empty($test_id)){
                    $practice['lecture_id'] = $lecture_id;
                    $this->practica_model->updateLectureId($test_id, $practice);
                }
                else{
                    $practice['lecture_id'] = 0;
                    $selTest = $this->test_model->getTestByLectureId($lecture_id);

                    if(!empty($selTest)){
                        $selTest_id = $selTest->test_id;
                        $this->practica_model->updateLectureId($selTest_id, $practice);
                    }
                }

                $msg = array(
                    'firstPartMsg' =>'Лекция ',
                    'title' => '"'.$lecture['title'].'"',
                    'id' => $lecture_id,
                    'secondPartMsg' => ' обновлена',
                    'object' => 'lecture'
                );
                $this->session->set_flashdata($msg);

                redirect(base_url().'notice/update');
            }
        }
        $user_id = $this->session->userdata('user_id');
        $lecture = $this->lecture_model->getLecture($lecture_id);
        $selectedTest = $this->test_model->getTestByLectureId($lecture_id);
        $data['selectedTest'] = $selectedTest;
        if(!empty($selectedTest)){
            $lectureIdForFreeTests = array($selectedTest->lecture_id, 0);
        }
        else {
            $lectureIdForFreeTests = array(0);
        }

        $data['allTests'] = $this->lecture_model->getAllFreeTests($user_id, $lectureIdForFreeTests);
        $data['page_title'] = 'Ред. лекции "'.$lecture->title.'"';
        $data['lecture'] =  $lecture;

        $template['content'] = 'lecture/update';
        $template['sidebar'] = 'blocks/sidebar/short';
        $this->template->page_view($template, $data);
    }

    public function del($lecture_id){
        $this->load->model('lecture_model');
        $this->load->model('practica_model');

        $lecture = $this->lecture_model->getLecture($lecture_id);

        $msg = array(
            'firstPartMsg' =>'Лекция ',
            'title' => '"'.$lecture->title.'"',
            'id' => $lecture_id,
            'secondPartMsg' => ' удалена',
            'object' => 'lecture'
        );
        $this->session->set_flashdata($msg);

        $link = array('lecture_id' => '0');
        $this->lecture_model->del($lecture_id);
        $this->practica_model->updateLectureIdByNull($link, $lecture_id);
        redirect(base_url().'notice/del');
    }
}