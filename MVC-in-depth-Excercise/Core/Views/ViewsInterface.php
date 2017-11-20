<?php


namespace Core\Views;


interface ViewsInterface
{
    public function render($viewName = null, $model = null);

    public function url($controller, $action, ...$params);
}