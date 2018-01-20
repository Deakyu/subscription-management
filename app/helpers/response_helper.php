<?php 

/**
 * Returns json data - used in controllers
 * 
 * ex) In your controller,
 * $data = ['id'=>$id];
 * returnJson($data, 200);
 * 
 * @param array $data
 * @param integer $statusCode
 * 
 */
function returnJson($data=[], $statusCode=200) {
    http_response_code($statusCode);
    header('Content-type: application/json');
    echo json_encode($data);
    exit();
}