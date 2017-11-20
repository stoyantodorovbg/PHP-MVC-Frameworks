<?php


namespace Core\Views;


use Core\Http\RequestInterface;
use Core\Http\UrlBuilderInterface;

class Views implements ViewsInterface
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var UrlBuilderInterface
     */
    private $urlBuilder;

    /**
     * Views constructor.
     * @param $controllerName
     * @param $actionName
     */
    public function __construct(RequestInterface $request,
                                UrlBuilderInterface $urlBuilder)
    {
        $this->request = $request;
        $this->urlBuilder = $urlBuilder;
    }


    public function render($viewName = null, $model = null)
    {
        if ($viewName === null || is_object($viewName)) {
            $model = $viewName;
            $viewName =
                $this->request->getControllerName().
                DIRECTORY_SEPARATOR.
                $this->request->getActionName();
        }
        require_once 'Src/Views/'.$viewName.'.php';
    }

    public function url($controller, $action, ...$params)
    {
        return $this->urlBuilder->build($controller, $action, $params);
    }


}