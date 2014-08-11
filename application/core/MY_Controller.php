<?php
class MY_Controller extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $user_id = $this->session->userdata('user_id');

        if(empty($user_id)){
            redirect(base_url().'quick_signin');
        }
    }
}