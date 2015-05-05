<?php
/**
*   @author Matthew O'Neill / C11354316
* A JSON view inheriting from base view
*/
require_once 'baseView.php';
class jsonView extends baseView{
    public function output(){
        $jsonResponse = json_encode($this->model->apiResponse);
        $this->slimApp->response->write($jsonResponse);
    }
}
?>
