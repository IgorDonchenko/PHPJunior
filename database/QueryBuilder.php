<?php

class QueryBuilder
{
    //Список статей
    function getAllTasks()
    {
        // 1. Подключиться к БД
        $pdo = new PDO("mysql:host=localhost; dbname=test", "root", "");
        // CRUD
        //2. Подготовить запрос

        $sql = "SELECT * FROM tasks";
        $statement = $pdo->prepare($sql); //подготовить
        $result = $statement->execute(); //true || false
        $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $tasks;
    }

    function getTasksPagination()
    {
        // 1. Подключиться к БД
        $pdo = new PDO("mysql:host=localhost; dbname=test", "root", "");
        // CRUD
        //2. Подготовить запрос
        //2.1 Ограничиваем количество выводимых тасков для пагинации
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        $notesOnePage = 3;
        $from = ($page - 1) * $notesOnePage;
        $sql = "SELECT * FROM tasks WHERE id > 0 LIMIT $from, $notesOnePage";

        //2.2 Готовим запрос
        $statement = $pdo->prepare($sql); //подготовить
        $result = $statement->execute(); //true || false
        $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $tasks;
    }
}