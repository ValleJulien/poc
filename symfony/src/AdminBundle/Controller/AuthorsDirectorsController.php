<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AuthorsDirectorsController extends Controller
{
    /**
     * @Route("/authors-directors/all")
     */
    public function indexAction()
    {
        return $this->render('AdminBundle:Pages:admin_index.html.twig', array(
            'title' => "Admin Novaway"
        ));
    }
}