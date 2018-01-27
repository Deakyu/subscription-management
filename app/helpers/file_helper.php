<?php 

    /**
     * Save a file to server
     * 
     * In Controller,
     * $fileOrError = saveFile($_FILES['image'], './images/');
     * $respnose->data['image'] = $fileOrError;
     * $this->view('yourview', $response->data);
     * 
     * @param array $file
     * @param string $path
     * 
     * @return string $msg or $saved_file_name
     */

    function saveFile($file, $path) {
        $msg = 'Error Uploading File';
        if(!$name = $file['name']) {
            return $msg;
        }
        if($file['error'] == 0) {
            $splitNameArray = explode('.', $name);
            $extension = array_pop($splitNameArray);
            $name = time().uniqid().'.'.$extension;

            if(move_uploaded_file($file['tmp_name'], dirname(APPROOT).'/public'.$path.$name)) {
                $msg = $path.$name;
            } else {
                $msg = 'Error Uploading File';
            }
        } else {
            if($file['error'] == 2) {
                $msg = 'File size is to big';
            }
        }

        return $msg;
    }