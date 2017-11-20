<?php


namespace Src\Controllers;


use Core\Http\UrlBuilder;
use Core\Http\UrlBuilderInterface;
use Core\Views\ViewsInterface;

class AbstractController
{
    /**
     * @var ViewsInterface
     */
    private $view;

    /**
     * @var UrlBuilderInterface
     */
    private $urlBuilder;

    /**
     * AbstractController constructor.
     * @param ViewsInterface $view
     * @param UrlBuilderInterface $urlBuilder
     */
    public function __construct(ViewsInterface $view, UrlBuilderInterface $urlBuilder)
    {
        $this->view = $view;
        $this->urlBuilder = $urlBuilder;
    }


    protected function render($viewName = null, $viewModel = null)
    {
        $this->view->render($viewName, $viewModel);
    }

    public function redirect($controller, $action, ...$params)
    {
        header('Location: '.$this->urlBuilder->build($controller, $action, $params));
        exit;

    }
}