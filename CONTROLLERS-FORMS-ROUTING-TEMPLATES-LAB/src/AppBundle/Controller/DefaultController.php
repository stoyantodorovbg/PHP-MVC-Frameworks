<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Article;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();

        foreach ($articles as $article) {
            $article->getSummary();
        }

        return $this->render(
            'default/index.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/test/index", name="test_index")
     * @return Response
     */
    public function test()
    {
        return $this->render('test/index.html.twig');
    }
}
