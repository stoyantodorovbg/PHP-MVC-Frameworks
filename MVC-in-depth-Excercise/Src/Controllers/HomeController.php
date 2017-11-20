<?php


namespace Src\Controllers;


use Core\Views\ViewsInterface;
use Src\Service\Dummy\DummyService;
use Src\Service\User\UserServiceInterface;

class HomeController extends AbstractController
{
    /**
     * @var ViewsInterface
     */
    private $view;

    private $dummy;

    /**
     * HomeController constructor.
     * @param ViewsInterface $view
     */
    public function __construct(
        ViewsInterface $view,
        DummyService $dummyService
)
    {
        $this->view = $view;
        $this->dummy = $dummyService;
    }

    public function index(string $name, UserServiceInterface $userService)
    {
        echo $name.'<br/>';
        var_dump($userService);
        var_dump($this->dummy);
    }


}