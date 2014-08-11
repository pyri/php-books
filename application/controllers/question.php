<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Question extends MY_Controller {

    function index()
    {
		$data = array();
        $template['content'] = 'question/index';
		$template['sidebar'] = 'blocks/sidebar/short';
        $this->template->page_view($template, $data);
    }
	
	function create() 
	{
        $msg= '';
        $this->load->model('question_model');
        $user_id = $this->session->userdata('user_id');
        $tests = $this->question_model->get_tests($user_id);

		if(isset($_POST['add_question']))
		{		
			$this->load->model('rules_model');
			$this->form_validation->set_rules($this->rules_model->question_rules);
			$check = $this->form_validation->run();
			
			if($check == TRUE){
				//загрузка моделей
				$this->load->model('question_model');
				
				/*получение информации с формы, запись вопросов в таблицу question*/
				$test_id = $this->input->post('test_title');
				$question_m->title = $this->input->post('question_multiple');
				$question_s->title = $this->input->post('question_single');

                $answer_m->{0}->option = $this->input->post('answer1');
                $answer_m->{0}->right = $this->input->post('chbox1');
                $answer_m->{1}->option = $this->input->post('answer2');
                $answer_m->{1}->right = $this->input->post('chbox2');
                $answer_m->{2}->option = $this->input->post('answer3');
                $answer_m->{2}->right = $this->input->post('chbox3');
                $answer_m->{3}->option = $this->input->post('answer4');
                $answer_m->{3}->right = $this->input->post('chbox4');
                $answer_m->{4}->option = $this->input->post('answer5');
                $answer_m->{4}->right = $this->input->post('chbox5');

                $answer_s->without_option = $this->input->post('answer_single');

                $checkQuestion1 = (!empty($question_m->title)
                    and ((!empty($answer_m->{0}->option) and !empty($answer_m->{0}->right))
                        or (!empty($answer_m->{1}->option) and !empty($answer_m->{1}->right))
                        or (!empty($answer_m->{2}->option) and !empty($answer_m->{2}->right))
                        or (!empty($answer_m->{3}->option) and !empty($answer_m->{3}->right))
                        or (!empty($answer_m->{4}->option) and !empty($answer_m->{4}->right)))
                );
                $emptyQuestion1 = (empty($question_m->title)
                    and ((empty($answer_m->{0}->option) and empty($answer_m->{0}->right))
                        and (empty($answer_m->{1}->option) and empty($answer_m->{1}->right))
                        and (empty($answer_m->{2}->option) and empty($answer_m->{2}->right))
                        and (empty($answer_m->{3}->option) and empty($answer_m->{3}->right))
                        and (empty($answer_m->{4}->option) and empty($answer_m->{4}->right)))
                );
                $checkQuestion2 = (!empty($question_s->title) and !empty($answer_s->without_option));
                $emptyQuestion2 = (empty($question_s->title) and empty($answer_s->without_option));

                if($checkQuestion1 == 1 and $checkQuestion2 == 1 ){
                    $msg->success = 'Вопросы добавлены';
                    //создание вопроса с множественным вариантом ответа
                    $question_m->test_id = $test_id;
                    $question_m->type = 'multi';
                    $question_id = $this->question_model->createQuestion($question_m);

                    foreach($answer_m as $key=>$answer){
                        $answer_m->{$key}->question_id = $question_id;

                        if($answer->right == 'on'){
                            $answer_m->{$key}->right = '1';
                        }

                        if(!empty($answer->option)){
                            $this->question_model->createAnswer($answer);
                        }
                    }
                    //создание вопроса без варианта ответа
                    $question_s->test_id = $test_id;
                    $question_s->type = 'single';
                    $question_id = $this->question_model->createQuestion($question_s);
                    $answer_s->question_id = $question_id;
                    $this->question_model->createAnswer($answer_s);
                }
                elseif($checkQuestion1 == 1 and $emptyQuestion2 == 1){
                    $msg->success = 'Вопросы добавлены';
                    //создание вопроса с множественным вариантом ответа
                    $question_m->test_id = $test_id;
                    $question_m->type = 'multi';
                    $question_id = $this->question_model->createQuestion($question_m);

                    foreach($answer_m as $key=>$answer){
                        $answer_m->{$key}->question_id = $question_id;

                        if($answer->right == 'on'){
                            $answer_m->{$key}->right = '1';
                        }

                        if(!empty($answer->option)){
                            $this->question_model->createAnswer($answer);
                        };
                    }
                }
                elseif($emptyQuestion1 == 1 and $checkQuestion2 == 1){
                    $msg->success = 'Вопросы добавлены';
                    //создание вопроса без варианта ответа
                    $question_s->test_id = $test_id;
                    $question_s->type = 'single';
                    $question_id = $this->question_model->createQuestion($question_s);
                    $answer_s->question_id = $question_id;
                    $this->question_model->createAnswer($answer_s);
                }
                else{
                   $msg->error = 'Заполните все необходимые поля';
                   $msg->success = '';
                }
			}
		}
        $data = array(
            'tests' => $tests,
            'msg' => $msg,
            'page_title' => 'Создание вопросов'
        );
        $template['content'] ='question/create';
        $template['sidebar'] = 'blocks/sidebar/short';
        $this->template->page_view($template, $data);
	}

    function updateMultiple($question_id){
        $msg_error = '';
        $this->load->model('question_model');
        $test = $this->question_model->getTestByQuestionId($question_id);

        if(isset($_POST['update_question'])){

            $this->load->model('rules_model');
            $this->form_validation->set_rules($this->rules_model->questionMultiForUpdate);


            if($this->form_validation->run()){ //проверка на правильность заполнения вопроса
                $answers = $this->input->post('answer');

                foreach($answers as $key=>$answer){ //удаление пустых ячеек массива answers, где не заполнены варианты ответа
                    if(empty($answer['option'])){
                        unset($answers[$key]);
                    }
                }

                if(!empty($answers)){ // массив answers мог стать пустым после удаления ячекк с незаполненными option
                     $checkRight = '';

                    foreach($answers as $answer){ //проверка на правильность заполнения отметок правильных ответов (checkbox)
                        @$checkRight = $checkRight.$answer['right'];
                    }

                    if(!empty($checkRight)){

                        $question['title'] = $this->input->post('question_multiple');
                        $this->question_model->updateQuestionByQuestionId($question_id, $question);
                        $this->question_model->deleteAnswersByQuestionId($question_id);

                        foreach($answers as $key=>$answer){ //видоизменение массива для записи в DB
                            $answers[$key]['question_id'] = $question_id;

                            if(isset($answer['right']) and $answer['right'] == 'on'){
                                $answers[$key]['right'] = 1;
                            }
                            else{
                                $answers[$key]['right'] = 0;
                            }

                        }

                        foreach($answers as $answer){ //запись ответов в DB
                            $this->question_model->insertAnswerByQuestionId($answer);
                        }
                        redirect(base_url().'test/update/'.$test->id);
                    }
                    else{
                        $msg_error = 'Заполните поля ответов верно';
                    }
                }
                else{
                    $msg_error = 'Заполните поля ответов верно';
                }
             }
        }

        $data['test'] = $test;
        $data['question'] = $this->question_model->getQuestionByQuestionId($question_id);
        $data['answers'] = $this->question_model->getAnswersByQuestionId($question_id);
        $data['page_title'] = 'Ред. вопроса';
        $data['msg_error'] = $msg_error;
        $template['content'] ='question/updateMultiple';
        $template['sidebar'] = 'blocks/sidebar/none';
        $this->template->page_view($template, $data);
    }


    function updateSingle($question_id){
        $this->load->model('question_model');
        $test = $this->question_model->getTestByQuestionId($question_id);

        if(isset($_POST['update_question'])){
            $this->load->model('rules_model');
            $this->form_validation->set_rules($this->rules_model->questionSingleForUpdate);

            if($this->form_validation->run()){
                $this->load->model('answers_model');
                $question['title'] = $this->input->post('question_single');
                $answer['without_option'] = $this->input->post('answer_without_option');
                $this->question_model->updateQuestionByQuestionId($question_id, $question);
                $this->answers_model->updateAnswerByQuestionId($question_id, $answer);
                redirect(base_url().'test/update/'.$test->id);
            }
        }
        $data['test'] = $test;
        $data['question'] = $this->question_model->getQuestionByQuestionId($question_id);
        $data['answer'] = $this->question_model->getAnswersByQuestionId($question_id);
        $data['page_title'] = 'Ред. вопроса';
        $template['content'] ='question/updateSingle';
        $template['sidebar'] = 'blocks/sidebar/none';
        $this->template->page_view($template, $data);
    }

    function del($question_id){
        $this->load->model('question_model');
        $question = $this->question_model->getQuestionByQuestionId($question_id);
        $msg = 'Вопрос "'.$question->title.'" удален';
        $this->session->set_flashdata('msg',  $msg);
        $this->question_model->deleteQuestionByQuestionId($question_id);
        $this->question_model->deleteAnswersByQuestionId($question_id);
        redirect(base_url().'notice/del');
    }
}