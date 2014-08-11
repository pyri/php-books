<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Test extends MY_Controller
{

    public function create()
    {
        if (isset($_POST['add_test'])) {
            $this->load->model('rules_model');
            $this->form_validation->set_rules($this->rules_model->test_rules);
            $check = $this->form_validation->run();

            if ($check == TRUE) {
                $test['title'] = $this->input->post('test_title');
                $test['user_id'] = $this->session->userdata('user_id');
                $practica['course_id'] = $this->input->post('test_course');
                $practica['lecture_id'] = $this->input->post('test_lecture');

                $this->load->model('test_model');
                $test_id = $this->test_model->create($test);
                $practica['test_id'] = $test_id;

                $this->load->model('practica_model');
                $this->practica_model->create($practica);

                $msg = array(
                    'firstPartMsg' =>'Тест ',
                    'title' => '"'.$test['title'].'"',
                    'id' => $test_id,
                    'secondPartMsg' => ' создан',
                    'object' => 'test'
                );
                $this->session->set_flashdata($msg);
                redirect(base_url() . 'notice/create');
            }
        }
        $this->load->model('test_model');
        $test_id = '0';

        $user_id = $this->session->userdata('user_id');
        $data['courses'] = $this->test_model->getAllFreeCoursesForTest($user_id);
        $data['lectures'] = $this->test_model->getAllFreeLecturesForTest($user_id);
        $data['page_title'] = 'Создание теста';
        $template['content'] = 'test/create';
        $template['sidebar'] = 'blocks/sidebar/short';
        $this->template->page_view($template, $data);
    }

    public function read($test_id = NULL)
    {
        $msgTestControl = '';
        $wrongAnswerForQuestion=array();
        $countRightAnswers = -1;
        $this->load->model('test_model');
        $test = $this->test_model->getTestTitleByTestId($test_id);
        $type = 'multi';
        $questions_multiple = $this->test_model->getQuestionsByTestId($type, $test->id);
        $type = 'single';
        $questions_single = $this->test_model->getQuestionsByTestId($type, $test->id);

        if (isset($_POST['test_end'])) {
            $countRightSingle = 0;

            foreach ($questions_single as $question) {
                $dbAnswer = $this->test_model->getRightAnswerForSingleByQuestionId($question['id']);

                $formAnswer = $this->input->post('answerQuestionSingle' . $question['id']);

                $dbTextAnswer = $dbAnswer->without_option;
                if (!empty($formAnswer)) {
                    if ($dbTextAnswer == $formAnswer) {
                        $countRightSingle++;
                    $formAnswer = $this->input->post('answerQuestionSingle' . $question['id']);
                }
                    else{
                        $wrongAnswerForQuestion[] = $question['title'];
                    }
                }
                else {
                    $msgTestControl = 'Вы ответили не на все вопросы!';
                }
            }

            $countRightMulti = 0;

            foreach ($questions_multiple as $question){
                $dbIdAnswers = array();

                $dbAnswers = $this->test_model->getRightAnswersForMultiByQuestionId($question['id']);
                $formAnswers = $this->input->post('checkbox' . $question['id']);

                if(!empty($formAnswers)){

                    foreach($dbAnswers as $dbAnswer){
                        $dbIdAnswers[] = $dbAnswer->id;
                    }

                    if($dbIdAnswers == $formAnswers){
                        $countRightMulti++;
                    }
                    else{
                        $wrongAnswerForQuestion[] = $question['title'];
                    }
                }
                else{
                    $msgTestControl = 'Вы ответили не на все вопросы!';
                }
            }
            $countRightAnswers = $countRightMulti + $countRightSingle;
        }

        foreach ($questions_multiple as $key => $question) {
            $questions_multiple[$key]['answers'] = $this->test_model->getAnswersByQuestionId($question['id']);
            $count_right = 0;

            foreach ($questions_multiple[$key]['answers'] as $answer) {
                if ($answer['right'] == 1) {
                    $count_right++;
                }
                $questions_multiple[$key]['count_right'] = $count_right;
            }
        }

        if(isset($_POST['test_publish'])) {
            $this->load->model('test_model');
            $t['publish'] = '1';
            $this->test_model->publishTest($t, $test_id);
        }

        if (isset($_POST['pdf_test'])) {
            $this->load->library('pdf');
            $data['msg'] = 'Создана pdf-копия теста';
            $file_name = translit($test->title) . '.pdf';
            $this->pdf->generateTest($file_name, $test, $questions_multiple, $questions_single);
        }



        $data = array(
            'test' => $test,
            'test_id' => $test_id,
            'wrongAnswerForQuestion' => $wrongAnswerForQuestion,
            'questions_multiple' => $questions_multiple,
            'questions_single' => $questions_single,
            'msgTestControl' => $msgTestControl,
            'countRightAnswers' => $countRightAnswers,
            'page_title' => $test->title
        );

        $template['content'] = 'test/read';
        $template['sidebar'] = 'blocks/sidebar/short';
        $this->template->page_view($template, $data);
    }

    public function update($test_id)
    {
        $data = array();
        $this->load->model('test_model');
        $this->load->model('rules_model');
        $this->form_validation->set_rules($this->rules_model->test_rules, $this->rules_model->question_rules);
        $check = $this->form_validation->run();

        if ($check == TRUE) {

            if (isset($_POST['update_test'])) {

                $this->load->model('practica_model');
                $this->load->model('question_model');

                $test->title = $this->input->post('test_title');
                $this->test_model->updateTestTitle($test_id, $test);
                $course = $this->test_model->getCourseByTestId($test_id);

                $practice['test_id'] = $test_id;
                $practice['course_id'] = $this->input->post('test_course');
                $practice['lecture_id'] = $this->input->post('test_lecture');

                $this->practica_model->updateCourseIdAndLectureIdbyTestId($test_id, $practice); //обновление course_id и lecture_id в link_practice одной функцией

                $msg = array(
                    'firstPartMsg' =>'Тест ',
                    'title' => '"'.$test->title.'"',
                    'id' => $test_id,
                    'secondPartMsg' => ' обновлен',
                    'object' => 'test'
                );
                $this->session->set_flashdata($msg);
                redirect(base_url().'notice/update');
            }
        }

        if (isset($_POST['delete_questionSingle'])) {
            $this->load->model('question_model');
            $this->question_model->deleteQuestionByTestId($test_id);
        }

        $user_id = $this->session->userdata('user_id');
        $test = $this->test_model->getTestTitleByTestId($test_id);
        $data['selectedCourse'] = $this->test_model->getCourseByTestId($test_id);
        $data['selectedLecture'] = $this->test_model->getLectureByTestId($test_id);
        $data['allCourses'] = $this->test_model->getAllCourses($user_id);
        $data['allLectures'] = $this->test_model->getAllLectures($user_id);

        $type = 'multi';
        $questions_multiple = $this->test_model->getQuestionsByTestId($type, $test->id);

        foreach ($questions_multiple as $key => $question) {
            $questions_multiple[$key]['answers'] = $this->test_model->getAnswersByQuestionId($question['id']);
        }

        $data['questions_multiple'] = $questions_multiple;
        $type = 'single';
        $questions_single = $this->test_model->getQuestionsByTestId($type, $test_id);

        foreach ($questions_single as $key => $question) {
            $answers = $this->test_model->getAnswersByQuestionId($question['id']);
            foreach ($answers as $key2 => $answer) {
                $questions_single[$key]['answer'] = $answer['without_option'];
            }
        }
        $data['questions_single'] = $questions_single;
        $data['test'] = $test;
        $data['page_title'] = 'Ред. теста "'.$test->title.'"';

        $template['content'] = 'test/update';
        $template['sidebar'] = 'blocks/sidebar/short';
        $this->template->page_view($template, $data);
    }

    function del($test_id)
    {
        $this->load->model('test_model');
        $this->load->model('question_model');
        $this->load->model('practica_model');
        $test = $this->test_model->getTestTitleByTestId($test_id);

        $msg = array(
            'firstPartMsg' =>'Тест ',
            'title' => '"'.$test->title.'"',
            'id' => $test_id,
            'secondPartMsg' => ' удален',
            'object' => 'test'
        );
        $this->session->set_flashdata($msg);

        $this->test_model->deleteAllTestByTestId($test_id);
        $this->practica_model->deleteLinkTestByTestId($test_id);
        redirect(base_url() . 'notice/del');
    }
}