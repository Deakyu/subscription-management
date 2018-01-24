<?php

function dd($data) {
    die(highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>"));
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

function getCardImage($type) {
    $imageUrl = 'images/credit_card_logo.png';
    switch ($type) {
        case 'visa':
            $imageUrl = 'images/visa_logo.png';
            break;
        
        case 'master':
            $imageUrl = 'images/mastercard_logo.png';
            break;
        
        case 'express':
            $imageUrl = 'images/american_express_logo.png';
            break;
    }
    return $imageUrl;
}