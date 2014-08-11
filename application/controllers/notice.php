<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notice extends MY_Controller {

    function create()
    {
        $data = array('page' => 'create');
        $template['content'] = 'notice';
        $template['sidebar'] = 'blocks/sidebar/short';
        $this->template->page_view($template, $data);
    }

    function update()
    {
        $data = array('page' => 'update');
        $template['content'] = 'notice';
        $template['sidebar'] = 'blocks/sidebar/short';
        $this->template->page_view($template, $data);
    }

    function del()
    {
        $data = array('page' => 'delete');
        $template['content'] = 'notice';
        $template['sidebar'] = 'blocks/sidebar/short';
        $this->template->page_view($template, $data);
    }
}