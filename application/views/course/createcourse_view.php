<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Создание курса</title>
    <link href="diplom.lan/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        body {
            padding-top: 80px;
            padding-bottom: 40px;
        }
    </style>
</head>

<body>
<div class="navbar navbar-inverse navbar-fixed-top header-color" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <h3 class="text-muted header-color">Приложение для создания электронных ресурсов</h3>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
            <div class="list-group">
                <a href="office.html" class="list-group-item">Личный кабинет</a>
                <a href="createcourse.html" class="list-group-item active ">Создать курс</a>
                <a href="createtest.html" class="list-group-item">Создать тест</a>
                <a href="createtest.html" class="list-group-item">Выйти</a>
            </div>
        </div>

        <div class="col-md-9">
            <div class="jumbotron">
                <h2>Создание курса</h2>
                <form role="form" method="post" action="createcourse/">
                    <div class="form-group">
                        <label for="course_title">Название курса</label>
                        <input type="text" name="course_title" class="form-control" id="course_title">

                        <label for="course_test">Выберите тест курса</label>
                        <select class="form-control" name="course_test" id="course_test">
                            <option>Не выбрано</option>
                            <option>Биология. Растения</option>
                            <option>Основные понятия экономики</option>
                            <option>Итоговый тест курса экономической теории</option>
                        </select>

                        <label for="lecture_sources">Список использованных источников</label>
                        <textarea type="text" name="course_sourse" class="form-control" id="lecture_sources" rows="15"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" name="add_course">Сохранить</button>
                </form>
            </div>
        </div>
        </div>
    </div>
    <hr>

    <footer class="text-center">
        <p>&copy; ФМИТ, 2014</p>
    </footer>

</div>

</body>
</html>
