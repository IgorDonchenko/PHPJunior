<?php

class QueryBuilder
{

    // Задаем размер пагинации
    public $notesOnePage = 3;

    // Подключаемся к БД
    public function connectDB()
    {
        $pdo = new PDO("mysql:host=localhost; dbname=test", "root", "");

        return $pdo;
    }


    //Список статей
    public function getAllTasks()
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

    //Список статей с пагинацией
    public function getTasksPagination()
    {
        // 1. Подключиться к БД
        $pdo = $pdo = $this->connectDB();
        // CRUD
        //2. Подготовить запрос
        //2.1 Ограничиваем количество выводимых тасков для пагинации


        if (isset($_GET['page']) AND (int)($_GET['page']) > 0) {
            $page = (int)$_GET['page'];
        } else {
            $page = 1;
        }

        $notesOnePage = 3;
        $from = ($page - 1) * $this->notesOnePage;
        $sql = "SELECT * FROM tasks WHERE id > 0 LIMIT $from, $notesOnePage";

        //2.2 Готовим запрос
        $statement = $pdo->prepare($sql); //подготовить
        $result = $statement->execute(); //true || false
        $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $tasks;
    }

    public function getPageCount()
    {

        $pdo = $this->connectDB();

        //$pdo = new PDO("mysql:host=localhost; dbname=test", "root", "");
        $sql = "SELECT COUNT(*) as countMy FROM tasks";
        $statement = $pdo->prepare($sql); //подготовить
        $result = $statement->execute(); //true || false
        $tasks = $statement->fetchAll();

        return $tasks;
    }

}