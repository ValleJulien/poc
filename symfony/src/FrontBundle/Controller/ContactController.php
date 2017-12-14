<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use FrontBundle\Form\ContactFormType as Contact;


class ContactController extends Controller
{
    /**
     * @param Request $request
     * @Route("/contact", name="contact")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function contactAction(Request $request)
    {
        $form = $this->createForm(Contact::class, array(
            'action' => $this->generateUrl('contact'),
            'method' => 'POST'
        ));

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) {
            $form->handleRequest($request);
            $contactInfo = $form->getData();
            $this->addFlash('success', 'We get your message !');
            return $this->redirectToRoute('contact');
        }

        return $this->render('FrontBundle:Pages:contact.html.twig', array(
            'title'    => "Contact Novaway",
            'form'     => $form->createView()
        ));
    }
}