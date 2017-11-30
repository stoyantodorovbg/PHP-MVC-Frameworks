<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends Controller
{

    /**
     * @Route("/articles", name="articles_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repo->findAll();
        return $this->render('articles/index.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/article/{id}", name="article_view")
     */
    public function articleViewAction($id)
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $article = $repo->find($id);

        return $this->render('articles/view.html.twig', [
            'article' => $article
        ]);
    }

    /**
     * @Route("/article2/{id}", name="article2_view")
     */
    public function article2ViewAction(Article $article)
    {

        return $this->render('articles/view.html.twig', [
            'article' => $article
        ]);
    }

    /**
     * @Route("/articles/create", name="article_create")
     */
    public function articleCreateAction(Request $request)
    {
        $article = new Article();
        $article->setDateCreated(new \DateTime('now'));
        $form  = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('articles_index');

        }
        return $this->render('articles/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/article/update/{id}", name="article_update")
     * @param int $id
     */
    public function articleEditAction(Request $request, $id)
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $article = $repo->find($id);

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('articles_index');
        }

        return $this->render('articles/update.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/article/update/{id}", name="article_delete")
     * @param int $id
     * @param $id
     */
    public function articleDeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Article::class);
        $article = $repo->find($id);

        if ($article === null) {
            throw $this->createNotFoundException();
        }

        $em->remove($article);
        $em->flush();

        return $this->redirectToRoute('articles_index');
    }


}
