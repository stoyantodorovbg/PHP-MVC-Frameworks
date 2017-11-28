<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Article;
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
}
