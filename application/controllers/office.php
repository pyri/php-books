<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Office extends MY_Controller {

    function index()
    {
        $data = array();
        $this->load->model('office_model');
        $user_id = $this->session->userdata('user_id');
        $data['tests'] = $this->office_model->get_tests($user_id);
        $data['courses'] = $this->office_model->get_courses($user_id);
        $data['page_title'] = 'Личный кабинет';
        $template['content'] = 'office';
        $template['sidebar'] = 'blocks/sidebar/short';
        $this->template->page_view($template, $data);
		
		if(isset($_POST['logout'])) {
			$this->session->unset_userdata('user');
			$this->session->unset_userdata('user_id');
			redirect(base_url().'logout');
		}
    }
}