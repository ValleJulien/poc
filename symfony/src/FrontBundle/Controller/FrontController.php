<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class FrontController extends Controller
{

    /**
     * @Route("/", name="front_homepage")
     */
    public function indexAction()
    {
        return $this->render('FrontBundle:Pages:index.html.twig', array(
            'title'    => "Novaway",
            'counter'  => 3
        ));
    }


    /**
     * @Route("/book-list", name="book_list")
     */
    public function bookListAction()
    {
        return $this->render('FrontBundle:Pages:book_list.html.twig', array(
            'title'         => "Book List"
        ));
    }


    /**
     * @param int $counter
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function carListLastRegisteredBookAction(int $counter = null)
    {
        $em = $this->getDoctrine()->getManager();
        $books = $em->getRepository('AdminBundle:Book')->getLastRegisteredBook($counter);

        return $this->render('FrontBundle:Pages:list.html.twig', array(
            'books' => $books
        ));
    }


    /**
     * @param Request $request
     * @param string $slug
     * @Route("/book-info/{slug}", name="single_book_info")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function singleBookInfoAction(Request $request, string $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository('AdminBundle:Book')->findOneBySlug($slug);

        return $this->render('FrontBundle:Pages:single_book.html.twig', array(
            'book' => $book,
            'title' => $book->getTitle(),
        ));
    }
}
