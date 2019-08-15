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
}