<?php
/**
* inheritance is fun, yo
*/
abstract class baseView{
    protected $model, $controller, $slimApp;

    public function __construct($controller, $model, $slimApp) {
        $this->controller = $controller;
        $this->model = $model;
        $this->slimApp = $slimApp;
    }

    abstract public function output();
}
?>
