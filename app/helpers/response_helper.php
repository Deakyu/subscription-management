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

function requestData() {
    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    
    if ($contentType === "application/json") {
        // Receive the RAW post data.
        $content = trim(file_get_contents("php://input"));

        $decoded = json_decode($content, true);

        if(! is_array($decoded)) {
            return false;
        } else {
            return $decoded;
        }
    } else {
        die($contentType);
    }
}