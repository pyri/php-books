<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TestUnAuth extends CI_Controller {

    public function read($test_id = NULL)
    {
        $msgTestControl = '';
        $wrongAnswerForQuestion=array();
        $this->load->model('test_model');
        $test = $this->test_model->getTestTitleByTestId($test_id);
        $type = 'multi';
        $questions_multiple = $this->test_model->getQuestionsByTestId($type, $test->id);
        $type = 'single';
        $questions_single = $this->test_model->getQuestionsByTestId($type, $test->id);
        $countRightAnswers = -1;

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

        $data = array(
            'test' => $test,
            'wrongAnswerForQuestion' => $wrongAnswerForQuestion,
            'questions_multiple' => $questions_multiple,
            'questions_single' => $questions_single,
            'msgTestControl' => $msgTestControl,
            'countRightAnswers' => $countRightAnswers,
            'page_title' => $test->title
        );

        $template['content'] = 'test/readUnAuth';
        $template['sidebar'] = 'blocks/sidebar/none';
        $this->template->page_view($template, $data);
    }
}