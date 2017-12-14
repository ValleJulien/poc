<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class BookController extends Controller
{

    /**
     * @param int $counter
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function carListLastRegisteredBookAction(int $counter = null)
    {
        $em = $this->getDoctrine()->getManager();
        $books = $em->getRepository('AdminBundle:Book')->getLastRegisteredBook($counter);

        return $this->render('AdminBundle:Books:list.html.twig', array(
            'books' => $books
        ));
    }


    /**
     * @param Request $request
     * @param string $slug
     * @Route("/book-info/{slug}", name="single_book_info")
     * @Security("is_anonymous()")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function singleBookInfoAction(Request $request, string $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository('AdminBundle:Book')->findOneBySlug($slug);

        return $this->render('AdminBundle:Books:single_book.html.twig', array(
            'book' => $book,
            'title' => $book->getTitle(),
        ));
    }

}