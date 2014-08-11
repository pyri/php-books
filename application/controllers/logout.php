<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {
	
	function index(){
		$data = array();
		
		/*авторизация*/
		if (isset($_POST['enter'])) {		
			$this->load->model('rules_model');
			$this->form_validation->set_rules($this->rules_model->login_rules);
			$check = $this->form_validation->run();
			
			if($check == TRUE) {			
				$this->load->model('logout_model');				
				$username = $this->input->post('login_username');
				$password = $this->input->post('login_password');	
				$password = sha1(md5($password));
				$check_auth = $this->logout_model->check_authorization($username, $password);				

				if($check_auth == TRUE)
                {
                    $user = $this->logout_model->getUserByName($username);
                    $session = array(
						'user_id' => $user->id,
                        'username' => $user->username
					);
					$this->session->set_userdata($session);
					
					redirect(base_url().'office');
                }
				else{		
					$data['error_auth'] = 'Неверные логин и пароль.';
				}	
			}
			else {
				$data['error_auth'] = 'Введите логин и пароль';
			}
		}
		/*регистрация*/
		if (isset($_POST['registration'])) {
			$this->load->model('rules_model');
			$this->form_validation->set_rules($this->rules_model->reg_rules);
			$check = $this->form_validation->run();
			
			if($check == TRUE) {
				$this->load->model('logout_model');
				
				$username = $this->input->post('reg_username');
				$password = $this->input->post('reg_password');
				$password_again = $this->input->post('reg_password_again');		
				$check_login = $this->logout_model->check_reg($username);
								
				if($password != $password_again){
					$data['error_password'] = 'Пароли не совпадают.';
				}
				if($check_login == FALSE){
					$data['error_login'] = "Логин уже занят.";
				}
				if(empty($data)){
					$reg['password'] = sha1(md5($password));
					$reg['username'] = $username;
					$reg['ip'] = $this->input->ip_address();
					$this->logout_model->registration($reg);	
					$data['success'] = "Пользователь с именем '$username' создан";						
				}				
			}		
		}

        $this->load->model('course_model');
        $this->load->model('test_model');
        $data['courses'] = $this->course_model->getCourseForUnauth();
        $data['tests'] = $this->test_model->getTestsForUnauth();
        $data['page_title'] = 'Главная страница';
		$template['content'] = 'logout';
		$template['sidebar'] = 'blocks/sidebar/logout';
		$this->template->page_view($template, $data);
	}
}