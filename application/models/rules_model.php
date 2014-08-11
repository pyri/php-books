<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rules_model extends CI_Model
{

    public $reg_rules = array(
        array(
            'field' => 'reg_username',
            'label' => 'Пользователь',
            'rules' => 'required|xss_clean|alpha_numeric'
        ),
        array(
            'field' => 'reg_password',
            'label' => 'Пароль',
            'rules' => 'required|xss_clean|alpha_numeric'
        ),
        array(
            'field' => 'reg_password_again',
            'label' => 'Повторите пароль',
            'rules' => 'required|xss_clean|alpha_numeric'
        )
    );

    public $login_rules = array(
        array(
            'field' => 'login_username',
            'label' => 'Пользователь',
            'rules' => 'required|xss_clean'
        ),
        array(
            'field' => 'login_password',
            'label' => 'Пароль',
            'rules' => 'required|xss_clean'
        )
    );

    public $course_rules = array(
        array(
            'field' => 'course_title',
            'label' => 'Название курса',
            'rules' => 'required|xss_clean|trim|max_length[100]'
        ),
        array(
            'field' => 'course_author',
            'label' => 'Автор курса',
            'rules' => 'xss_clean|required|trim|max_length[100]'
        ),
        array(
            'field' => 'course_type',
            'label' => 'Тип учебного издания',
            'rules' => 'xss_clean|required|trim|max_length[50]'
        ),
        array(
            'field' => 'course_test',
            'label' => 'Выберите тест курса',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'course_source',
            'label' => 'Список использованных источников',
            'rules' => 'xss_clean|trim'
        )
    );

    public $lecture_rules = array(
        array(
            'field' => 'lecture_course',
            'label' => 'Выберите курс',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'lecture_title',
            'label' => 'Название лекции',
            'rules' => 'required|xss_clean|trim|max_length[100]'
        ),
        array(
            'field' => 'lecture_content',
            'label' => 'Содержание лекции',
            'rules' => 'required|xss_clean|trim',
        ),
        array(
            'field' => 'lecture_selfquestions',
            'label' => 'Вопросы для самопроверки',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'lecture_examples',
            'label' => 'Решение типовых примеров',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'lecture_task',
            'label' => 'Задачи для самопроверки',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'lecture_test',
            'label' => 'Прикрепите тест',
            'rules' => 'xss_clean'
        )
    );

    public $test_rules = array(
        array(
            'field' => 'test_title',
            'label' => 'Название теста',
            'rules' => 'required|xss_clean|trim|max_length[100]'
        ),
        array(
            'field' => 'test_course',
            'label' => 'Выберите курс, к которому необходимо прикрепить тест',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'test_lecture',
            'label' => 'Выберите лекцию, к которому необходимо прикрепить тест',
            'rules' => 'xss_clean'
        )
    );

    public $question_rules = array(
        array(
            'field' => 'test_title',
            'label' => 'Название теста',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'question_multiple',
            'label' => 'Вопрос с множественным выбором',
            'rules' => 'xss_clean|trim|max_length[100]'
        ),
        array(
            'field' => 'answer_multiple1',
            'rules' => 'xss_clean|trim|max_length[100]'
        ),
        array(
            'field' => 'answer_multiple2',
            'rules' => 'xss_clean|trim|max_length[100]'
        ),
        array(
            'field' => 'answer_multiple3',
            'rules' => 'xss_clean|trim|max_length[100]'
        ),
        array(
            'field' => 'answer_multiple4',
            'rules' => 'xss_clean|trim|max_length[100]'
        ),
        array(
            'field' => 'answer_multiple5',
            'rules' => 'xss_clean|trim|max_length[100]'
        ),
        array(
            'field' => 'question_single',
            'label' => 'Вопрос без вариантов ответа',
            'rules' => 'xss_clean|trim|max_length[100]'
        ),
        array(
            'field' => 'answer_single',
            'rules' => 'xss_clean|trim|max_length[100]'
        ),

    );
    public $questionSingleForUpdate = array(

        array(
            'field' => 'question_single',
            'label' => 'Вопрос',
            'rules' => 'required|xss_clean|trim|max_length[100]'
        ),
        array(
            'field' => 'answer_without_option',
            'label' => 'Ответ',
            'rules' => 'required|xss_clean|trim|max_length[100]'
        )
    );

    public $questionMultiForUpdate = array(

        array(
            'field' => 'question_multiple',
            'label' => 'Вопрос',
            'rules' => 'required|xss_clean|trim|max_length[100]'
        )
    );
}