<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
}
