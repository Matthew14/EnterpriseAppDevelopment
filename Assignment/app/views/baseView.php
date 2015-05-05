<?php
/**
 * @author Matthew O'Neill / C11354316
 *
 * We have multiple views (XML, JSON), so let's have a base view which declares the output method needed
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
