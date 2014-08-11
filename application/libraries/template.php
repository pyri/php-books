<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template {

    function page_view($name, $data)
    {
	    $CI =& get_instance();
		
		$template = array();
	    $template['scripts'] = $CI->load->view('blocks/scripts_view', $data, TRUE);
	    $template['header'] =  $CI->load->view('blocks/header_view', '', TRUE);
	    $template['sidebar'] =  $CI->load->view($name['sidebar'].'_view', $data, TRUE);
	    $template['content'] =  $CI->load->view($name['content'].'_view', $data, TRUE);
	    $template['footer'] =  $CI->load->view('blocks/footer_view', '', TRUE);
		
		$CI->load->view('blocks/template', $template, FALSE);
    }
}
?>