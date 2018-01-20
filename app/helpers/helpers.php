<?php

function dd($data) {
    die(var_dump($data));
}

function refValues($arr){
    if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
    {
        $refs = array();
        foreach($arr as $key => $value)
            $refs[$key] = &$arr[$key];
        return $refs;
    }
    return $arr;
}

function view($view, $data = []) {
    if(file_exists("../app/views/{$view}.view.php")) {
        require_once "../app/views/${view}.view.php";
        exit();
    } else {
        die('View does not exit!');
    }
}

function redirect($page) {
    header('Location: ' . URLROOT . '/' . $page);
}