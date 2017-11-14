<?php


namespace Core;


class View
{
    const VIEWS_FOLDER = 'Views/';
    const VIEWS_EXTENSION = '.php';

    public function render($viewName, $model)
    {
        include
            self::VIEWS_FOLDER
            .$viewName
            .self::VIEWS_EXTENSION;
    }
}