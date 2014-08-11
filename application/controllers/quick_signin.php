<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quick_signin extends CI_Controller {

    function index()
    {
		$data = array();
		if (isset($_POST['signin'])) {								
			$this->load->model('quick_signin_model');				
			$username = $this->input->post('username') ;
			$password = $this->input->post('password');	
			$password = sha1(md5($password));
			$check_auth = $this->quick_signin_model->check_auth($username, $password);				

			if($check_auth == TRUE){
                $user = $this->quick_signin_model->getUserByName($username);
                $session = array(
                    'user_id' => $user->id,
                    'username' => $user->username
                );
				$this->session->set_userdata($session);
				redirect(base_url().'office');
			}
			else{		
				$data['error_auth'] = "Неверное имя пользователя или пароль";
			}				
		}
		$this->load->view('quick_signin_view', $data);
    }
}