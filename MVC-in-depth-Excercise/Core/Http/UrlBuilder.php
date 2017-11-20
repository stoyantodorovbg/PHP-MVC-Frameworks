<?php


namespace Core\Http;


class UrlBuilder implements UrlBuilderInterface
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * UrlBuilder constructor.
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    public function build(
        string $controller = null,
        string $action = null,
        ...$params
    )
    {
        $url = '//'
            .$this->request->getHost()
            .$this->request->getExecutingPath();
        if ($controller === null) {
            return $url;
        }

        $url .= $controller;
        if ($action === null) {
            return $url;
        }

        $url .= '/'.$action;

        foreach ($params[0] as $param) {
            $url .= '/'.$param;
        }

        return $url;
    }


}