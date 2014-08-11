<?php

//Подключаем библиотеку
require_once('MPDF56/mpdf.php');

//Папка для сохранения файлов
define('PRICE_DIR', $_SERVER['DOCUMENT_ROOT'] . '/uploads/pdf/');

//Проверка на попытку прямого доступа
if (!defined('BASEPATH')) exit('No direct script access allowed');

//Класс-библиотека CodeIgniter
class Pdf{

    function generateCourse($file_name, $textbook, $testCourse, $questions)
    {
        $mpdf = new mPDF();
        $testForLecture = '';
        $lecture = '';
        $institution = '<h3>МУНИЦИПАЛЬНОЕ ОБРАЗОВАТЕЛЬНОЕ УЧРЕЖДЕНИЕ <br />
        СРЕДНЯЯ ОБЩЕОБРАЗОВАТЕЛЬНОЕ ШКОЛА <br />С УГЛУБЛЕННЫМ ИЗУЧЕНИЕМ ОТДЕЛЬНЫХ ПРЕДМЕТОВ №24</h3><br />';
        $course_title = '<h1 class="text-center">' . $textbook[0]['c_title'] . '</h1><br />';
        $type_of_publication = '<h3>'.$textbook[0]['c_type'].'</h3>';
        $author = '<br /><h3>' . $textbook[0]['c_author'] . '</h3>';
        $data = date("Y");
        $first_page = '
            <table class="text-center">
                <tr><td class="cell-first">'.$institution.$author.'</td></tr>
                <tr><td>'.$course_title.$type_of_publication.'</td></tr>
                <tr><td class="cell-third">Саранск<br />'.$data.'</td></tr>
            </table>';

        /*подготовка лекций*/
        foreach ($textbook as $item) {

            $l_title = '<h2 class="text-center">' . $item['l_title'] . '</h2>';
            $l_content = '<p>' . $item['l_content'] . '</p>';
            $l_selfqstns = '<h4>Вопросы для самопроверки</h4><p>' . $item['l_selfqstns'] . '</p>';
            $l_example = '<h4>Примеры</h4><p>' . $item['l_example'] . '</p>';
            $l_task = '<h4>Задачи</h4><p>' . $item['l_task'] . '</p>';

            $lecture_content = '<br />' . notEmptyTwoArg($item['l_title'], $l_title).
                notEmptyTwoArg($item['l_content'], $l_content).
                notEmptyTwoArg($item['l_selfqstns'], $l_selfqstns).
                notEmptyTwoArg($item['l_example'], $l_example).
                notEmptyTwoArg($item['l_task'], $l_task);

            $questionsForLecture = '';
            $testForLecture = '';
            if(!empty($item['questions'])){

                foreach ($item['test'] as $test) {
                    $testForLecture = '<br /><h3 class="text-center">' . $test['title'] . '</h3>';
                }

                foreach ($item['questions'] as $question) {
                    $questionsForLecture = $questionsForLecture . '<h4>' . $question['title'] . '</h4>';
                    foreach ($question['answers'] as $answer) {
                        $textbox = '';
                        $checkbox = '';

                        if (!empty($answer['without_option'])) {
                            $textbox = '<input type="text" size="100">';
                        }
                        else{
                            $checkbox = '<input type="checkbox">';
                        }
                        $questionsForLecture = $questionsForLecture . $checkbox . $answer['option'] . '<br/>'.$textbox;
                    }
                }
            }

            $lecture = $lecture . $lecture_content . $testForLecture . $questionsForLecture;
        }

        $sourse = '<h3 class="text-center">Список использованных источников</h3>
            <p>' . $textbook[0]['c_source'] . '</p>';

        $course_source = '<br />'.notEmptyTwoArg($textbook[0]['c_source'], $sourse);

        /*подготовка теста по курсу*/
        $questionsForCourse = '';
        if(!empty($questions)){
            $testForCourse = '<br /><h3>' . $testCourse[0]['title'] . '</h3>';


            foreach ($questions as $key => $question) {
                $questionsForCourse = $questionsForCourse . '<h4>' . $question['title'] . '</h4>';

                foreach ($question['answers'] as $answer) {

                    $textbox = '';
                    $checkbox = '';

                    if (!empty($answer['without_option'])) {
                        $textbox = '<input type="text" size="100">';
                    }
                    else{
                        $checkbox = '<input type="checkbox">';
                    }
                    /*$questionsForLecture = $questionsForLecture . $checkbox . $answer['option'] . '<br/>'.$textbox;

                    $checkbox = '<input type="checkbox">';*/
                    $questionsForCourse = $questionsForCourse . $checkbox . $answer['option']. '<br/>'.$textbox;
                }
            }
        }


        $stylesheet = file_get_contents('css/pdf.css');
        $mpdf->WriteHTML($stylesheet, 1);

        $mpdf->list_indent_first_level = 0;
        $content = $first_page . $lecture . $course_source . $testForCourse . $questionsForCourse;
        $mpdf->WriteHTML($content, 2);

        $mpdf->Output(PRICE_DIR . $file_name);
    }

    function generateTest($file_name, $test, $questions_multiple, $questions_single)
    {
        $mpdf = new mPDF();
        $answer_content = '';

        $institution = '<h3>МУНИЦИПАЛЬНОЕ ОБРАЗОВАТЕЛЬНОЕ УЧРЕЖДЕНИЕ <br />
        СРЕДНЯЯ ОБЩЕОБРАЗОВАТЕЛЬНОЕ ШКОЛА <br />С УГЛУБЛЕННЫМ ИЗУЧЕНИЕМ ОТДЕЛЬНЫХ ПРЕДМЕТОВ №24</h3><br />';
        $test_title = '<h1>'.$test->title.'</h1>';
        $data = date("Y");
        $first_page = '
            <table class="text-center">
                <tr><td class="cell-first">'.$institution.'</td></tr>
                <tr><td>'.$test_title.'</td></tr>
                <tr><td class="cell-third">Саранск<br />'.$data.'</td></tr>
            </table>';

        foreach ($questions_multiple as $key => $question) {
            $question_title = '<h4>' . $question['title'] . '</h4>';

            foreach ($question['answers'] as $answer) {
                $checkbox = '<input type="checkbox">';
                $answer_content = $answer_content . $checkbox . $answer['option'] . '<br />';
            }
            $question_content_m = $question_content_m . $question_title . $answer_content;
            $answer_content = '';
        }

        foreach ($questions_single as $key => $question) {
            $question_title = '<h4>' . $question['title'] . '</h4>';
            $textbox = '<input type="text" size="100">';
            $question_content_s = $question_content_s . $question_title . $textbox;
        }

        $stylesheet = file_get_contents('css/pdf.css');
        $mpdf->WriteHTML($stylesheet, 1);

        $mpdf->list_indent_first_level = 0;
        $testContent = $first_page . $question_content_m . $question_content_s;
        $mpdf->WriteHTML($testContent, 2);
        $mpdf->Output(PRICE_DIR . $file_name);
    }

    function generateLecture($file_name, $author, $lecture, $test, $questions)
    {
        $mpdf = new mPDF();

        $institution = '<h3>МУНИЦИПАЛЬНОЕ ОБРАЗОВАТЕЛЬНОЕ УЧРЕЖДЕНИЕ <br />
        СРЕДНЯЯ ОБЩЕОБРАЗОВАТЕЛЬНОЕ ШКОЛА <br />С УГЛУБЛЕННЫМ ИЗУЧЕНИЕМ ОТДЕЛЬНЫХ ПРЕДМЕТОВ №24</h3><br />';
        $lecture_title = '<h1>'.$lecture->title.'</h1>';
        $lecture_author = '<br /><h3>'.$author.'</h3>';
        $data = date("Y");
        $first_page = '
            <table class="text-center">
                <tr><td class="cell-first">'.$institution. $lecture_author.'</td></tr>
                <tr><td>'.$lecture_title.'</td></tr>
                <tr><td class="cell-third">Саранск<br />'.$data.'</td></tr>
            </table>';

        $selfquestions = '<h3>Вопросы для самопроверки</h3>' . $lecture->selfquestions;
        $example = '<h3>Решение типовых примеров</h3>' . $lecture->example;
        $task = '<h3>Задачи</h3>' . $lecture->task;
        $lectureForPdf = $lecture->content . notEmptyTwoArg($lecture->selfquestions, $selfquestions)
            . notEmptyTwoArg($lecture->example, $example)
            . notEmptyTwoArg($lecture->task, $task);


        if(!empty($questions)){
            $test_title = '<h2 class="text-center">' . $test->title . '</h2>';
            $questionsForPdf = '';

            foreach ($questions as $question) {
                $questionsForPdf = $questionsForPdf . '<h4>' . $question['title'] . '</h4>';
                foreach ($question['answers'] as $answer) {
                    $textbox = '';
                    $checkbox = '';
                    if (!empty($answer->without_option)) {
                        $textbox = '<input type="text" size="100">';
                    }
                    else{
                        $checkbox = '<input type="checkbox">';
                    }
                    $questionsForPdf = $questionsForPdf . $checkbox . $answer->option.'<br />' . $textbox;
                }
            }

            $testForPdf = notEmpty($test_title) . notEmpty($questionsForPdf);
        }
        else{
            $testForPdf = '';
        }


        $stylesheet = file_get_contents('css/pdf.css');
        $mpdf->WriteHTML($stylesheet, 1);

        $mpdf->list_indent_first_level = 0;
        $contentForPdf = $first_page.$lectureForPdf . $testForPdf;
        $mpdf->WriteHTML($contentForPdf, 2);

        $mpdf->Output(PRICE_DIR . $file_name);

    }
}