<?php


namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ArticleType;



class ArticleController extends Controller
{
    /**
     * @Route("/createArticle", name="create_article_view")
     * @Method("GET")
     */
    public function createArticleView()
    {
        return $this->render("articles/createArticleView.html.twig");
    }

    /**
     * @Route("/createArticle", name="create_article")
     * @Method("POST")
     */
    public function createArticle(Request $request)
    {
        $article = new Article();
        $article->setCreateDate(new \DateTime());
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute("home_page");
        }
    }

    /**
     * @Route("/allArticles", name="all_articles")
     */
    public function listArticles()
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repo->findAll();

        return $this->render('articles/allArticles.html.twig', ['articles' => $articles]);
    }

    /**
     * @Route("/viewArticle/{id}", name="view_article")
     * @param Article $article
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewArticle(Article $article)
    {
        return $this->render('articles/viewArticle.html.twig', ['article' => $article]);
    }


}