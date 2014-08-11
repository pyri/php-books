<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course extends MY_Controller {

    public function create()
    {
        if(isset($_POST['add_course']))
        {
			$this->load->model('rules_model');
			$this->form_validation->set_rules($this->rules_model->course_rules);
			$check = $this->form_validation->run();
			if($check == TRUE) {
				$this->load->model('course_model');
				$this->load->model('practica_model');
				
				$user_id = $this->session->userdata('user_id');
				
				$course['title'] = $this->input->post('course_title');
                $course['author'] = $this->input->post('course_author');
                $course['type_of_publication'] = $this->input->post('course_type');
				$course['source'] = $this->input->post('course_source');
				$course['user_id'] = $this->session->userdata('user_id');

				$course_id = $this->course_model->create($course);
                $practicе['course_id'] = $course_id;
                $test_id = $this->input->post('course_test');

                if(!empty($test_id)){
                    $this->practica_model->updateCourseId($test_id, $practicе);
                }

                $msg = array(
                    'firstPartMsg' =>'Курс ',
                    'title' => '"'.$course['title'].'"',
                    'id' => $course_id,
                    'secondPartMsg' => ' создан',
                    'object' => 'course'
                );
                $this->session->set_flashdata($msg);
				redirect (base_url().'notice/create');
			}	
        }
        $course_id = '0';
        $this->load->model('course_model');
        $user_id = $this->session->userdata('user_id');
		$data['tests'] = $this->course_model->getTestByCourseId($user_id, $course_id);
        $data['page_title'] = 'Создание курса';
		$name['content'] = 'course/create';
		$name['sidebar'] = 'blocks/sidebar/short';
		$this->template->page_view($name, $data);
    }
	
	public function read($course_id)
    {
        $msg = '';
		$this->load->model('course_model');
        $course = $this->course_model->getCourseAndLecture($course_id);
        $test = $this->course_model->getOneTestForCourseId($course_id);

        if(!empty($test)){
            $questions = $this->course_model->getQuestionsByTestId($test[0]['test_id']);
            foreach ($questions as $key => $question) {
                $questions[$key]['answers'] = $this->course_model->getAnswersByQuestionId($question['id']);
            }
        }
        else{
            $questions = '';
        }

        if(isset($_POST['pdf_course'])) {

            $this->load->library('pdf');
            $this->load->model('course_model');

            //данные для тестов курсов
            $textbook = $this->course_model->getCourseAndLecture($course_id);
			$testCourse = $this->course_model->getOneTestForCourseId($course_id);
			$questions = $this->course_model->getQuestionsByTestId($testCourse[0]['test_id']);

            foreach ($questions as $key => $question) {
                $questions[$key]['answers'] = $this->course_model->getAnswersByQuestionId($question['id']);
            }

            //данные для тестов лекций
            foreach ($textbook as $key => $item) {
                $textbook[$key]['test'] = $this->course_model->getTestForLecture($item['l_id']);
            }

            foreach ($textbook as $key => $item) {
                foreach($item['test'] as $key2 => $item2) {
                    $textbook[$key]['questions'] = $this->course_model->getQuestionsByTestId($item2['id']);
                }
            }

            foreach ($textbook as $key => $item) {
                if(!empty($item['questions'])){
                    foreach($item['questions'] as $key3 => $item3) {
                        $textbook[$key]['questions'][$key3]['answers'] = $this->course_model->getAnswersByQuestionId($item3['id']);
                    }
                }
            }

            $msg = 'Создана pdf-версия курса';
            $this->session->set_flashdata('msg',  $msg);
            $file_name = translit($textbook[0]['c_title']).'.pdf';
            $this->pdf->generateCourse($file_name, $textbook, $testCourse, $questions);
        }

        if(isset($_POST['course_publish'])) {
            $this->load->model('course_model');
            $c['publish'] = '1';
            $this->course_model->publishCourse($c, $course_id);
        }

        $data = array(
            'course' => $course,
            'course_id' => $course_id,
            'test' => $test,
            'msg' => $msg,
            'page_title' => $course['0']['c_title']);
        $template['content'] = 'course/read';
        $template['sidebar'] = 'blocks/sidebar/short';
        $this->template->page_view($template, $data);
	}

    public function update($course_id){
        $data = array();
        $this->load->model('course_model');

        if(isset($_POST['update_course'])){
            $this->load->model('rules_model');
            $this->form_validation->set_rules($this->rules_model->course_rules);
            $check = $this->form_validation->run();

            if($check == TRUE){
                $this->load->model('practica_model');

                $course['title'] = $this->input->post('course_title');
                $course['author'] = $this->input->post('course_author');
                $course['type_of_publication'] = $this->input->post('course_type');
                $course['source'] = $this->input->post('course_source');

                $test_id = $this->input->post('course_test');
                $this->course_model->update($course, $course_id);

                if(!empty($test_id)){
                    $practica['course_id'] = $course_id;
                    $this->practica_model->updateCourseId($test_id, $practica);
                }
                else{
                    $practica['course_id'] = 0;
                    $selTest = $this->course_model->getOneTestForCourseId($course_id);

                    if(!empty($selTest)){
                        $selTest_id = $selTest[0]['test_id'];
                        $this->practica_model->updateCourseId($selTest_id, $practica);
                    }
                }

                $msg = array(
                    'firstPartMsg' =>'Курс ',
                    'title' => '"'.$course['title'].'"',
                    'id' => $course_id,
                    'secondPartMsg' => ' обновлен',
                    'object' => 'course'
                );
                $this->session->set_flashdata($msg);
                redirect(base_url().'notice/update');
            }
        }
        $user_id = $this->session->userdata('user_id');
        $course = $this->course_model->getCourse($course_id);
        $selectedTest = $this->course_model->getOneTestForCourseId($course_id);

        if(!empty($selectedTest)){
            $selTest = $selectedTest[0]['course_id'];
        }
        else {$selTest = 0;}

        /*формирование массива для вывода всех доступных для прикрепления к курсу тестов*/
        if(!empty($selTest)){
            $courseIdForFreeTests = array($selTest, 0);
        }
        else {
            $courseIdForFreeTests = array(0);
        }

        $data['testSel'] = $selectedTest;
        $data['testsAll'] = $this->course_model->getAllFreeTests($user_id, $courseIdForFreeTests);
        $data['course_id'] = $course->id;
        $data['course'] = $course;
        $data['page_title'] = 'Ред. курса "'.$course->title.'"';

        $template['content'] = 'course/update';
        $template['sidebar'] = 'blocks/sidebar/short';
        $this->template->page_view($template, $data);
    }

    public function del($course_id){
        $this->load->model('course_model');
        $this->load->model('lecture_model');
        $this->load->model('test_model');
        $this->load->model('practica_model');

        $course = $this->course_model->getCourse($course_id);

        $msg = array(
            'firstPartMsg' =>'Курс ',
            'title' => '"'.$course->title.'"',
            'id' => $course_id,
            'secondPartMsg' => ' создан',
            'object' => 'course'
        );
        $this->session->set_flashdata($msg);

        $lecturesForCourse = $this->course_model->getListLecturesforCourse($course_id);
        $this->course_model->del($course_id);

        //удаление лекций курса
        foreach($lecturesForCourse as $lecture){
            $this->lecture_model->del($lecture->id);
        }
        //удаление связи теста и курса в link_practica
        $link = array('course_id' => '0');
        $this->practica_model->updateCourseIdByNull($link, $course_id);

        //удаление связи теста и лекции в link_practica
        $link = array('lecture_id' => '0');
        foreach($lecturesForCourse as $lecture){
            $this->practica_model->updateLectureIdByNull($link, $lecture->id);
        }
        redirect(base_url().'notice/del');
    }
}