<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\AuthorDirector;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * Authordirector controller.
 *
 * @Route("authordirector")
 */
class AuthorDirectorController extends Controller
{

    /**
     * Lists all authorDirector entities.
     *
     * @Route("/", name="admin_authordirector_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $authorDirectors = $em->getRepository('AdminBundle:AuthorDirector')->findAll();

        return $this->render('AdminBundle:AuthorDirector:index.html.twig', array(
            'title'           => "Authors Directors List",
            'authorDirectors' => $authorDirectors,
        ));
    }


    /**
     * Creates a new authorDirector entity.
     *
     * @Route("/new", name="admin_authordirector_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $authorDirector = new Authordirector();
        $form = $this->createForm('AdminBundle\Form\AuthorDirectorType', $authorDirector);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($authorDirector);
            $em->flush();

            return $this->redirectToRoute('admin_authordirector_show', array('id' => $authorDirector->getId()));
        }

        return $this->render('AdminBundle:AuthorDirector:new.html.twig', array(
            'title'          => "Create Authors Directors",
            'authorDirector' => $authorDirector,
            'form'           => $form->createView(),
        ));
    }


    /**
     * Finds and displays a authorDirector entity.
     *
     * @Route("/{id}", name="admin_authordirector_show")
     * @Method("GET")
     */
    public function showAction(AuthorDirector $authorDirector)
    {
        $deleteForm = $this->createDeleteForm($authorDirector);

        return $this->render('AdminBundle:AuthorDirector:show.html.twig', array(
            'authorDirector' => $authorDirector,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing authorDirector entity.
     *
     * @Route("/{id}/edit", name="admin_authordirector_edit")
     * @param Request $request
     * @param AuthorDirector $authorDirector
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, AuthorDirector $authorDirector)
    {
        $deleteForm = $this->createDeleteForm($authorDirector);
        $editForm = $this->createForm('AdminBundle\Form\AuthorDirectorType', $authorDirector);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_authordirector_edit', array('id' => $authorDirector->getId()));
        }

        return $this->render('AdminBundle:AuthorDirector:edit.html.twig', array(
            'title'          => "Infos Authors Directors",
            'authorDirector' => $authorDirector,
            'edit_form'      => $editForm->createView(),
            'delete_form'    => $deleteForm->createView(),
        ));
    }


    /**
     * Deletes a authorDirector entity.
     *
     * @Route("/{id}", name="admin_authordirector_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AuthorDirector $authorDirector)
    {
        $form = $this->createDeleteForm($authorDirector);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($authorDirector);
            $em->flush();
        }

        return $this->redirectToRoute('admin_authordirector_index');
    }


    /**
     * Creates a form to delete a authorDirector entity.
     *
     * @param AuthorDirector $authorDirector
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(AuthorDirector $authorDirector)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_authordirector_delete', array('id' => $authorDirector->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
