<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LectureUnAuth extends CI_Controller {

    function read($lecture_id)
    {
        $data = array();
        $this->load->model('lecture_model');
        $this->load->model('course_model');
        $this->load->model('test_model');
        $this->load->model('question_model');
        $course_id = $this->lecture_model->getCourseIdByLectureId($lecture_id);
        $list_lectures = $this->course_model->getListLecturesforCourse($course_id->course_id);
        $lecture = $this->lecture_model->getLecture($lecture_id);
        $test = $this->test_model->getTestByLectureId($lecture_id);


        $data = array(
            'list_lectures' => $list_lectures,
            'lecture' => $lecture,
            'lecture_id' => $lecture_id,
            'test' => $test,
            'page_title' => $lecture->title);

        $template['content'] = 'lecture/readUnAuth';
        $template['sidebar'] = 'blocks/sidebar/lecturenav';
        $this->template->page_view($template, $data);
    }
}