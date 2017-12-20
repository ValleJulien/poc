<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * Authordirector controller.
 *
 * @Route("book")
 */
class BookController extends Controller
{

    /**
     * Lists all book entities.
     *
     * @Route("/list", name="admin_book_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $books = $em->getRepository('AdminBundle:Book')->findAll();

        return $this->render('AdminBundle:Book:list.html.twig', array(
            'title'           => "Books List",
            'authorDirectors' => $books,
        ));
    }


    /**
     * Creates a new book entity.
     *
     * @Route("/new", name="admin_book_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $book = new Book();
        $form = $this->createForm('AdminBundle\Form\BookType', $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();

            return $this->redirectToRoute('admin_book_show', array('id' => $book->getId()));
        }

        return $this->render('AdminBundle:Book:new.html.twig', array(
            'title'          => "Create book",
            'authorDirector' => $book,
            'form'           => $form->createView(),
        ));
    }


    /**
     * Finds and displays a book entity.
     *
     * @Route("/show/{id}", name="admin_book_show")
     * @Method("GET")
     * @param Book $book
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Book $book)
    {
        $deleteForm = $this->createDeleteForm($book);

        return $this->render('AdminBundle:Book:show.html.twig', array(
            'title'          => "Infos about ".$book->getTitle(),
            'authorDirector' => $book,
            'delete_form'    => $deleteForm->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing book entity.
     *
     * @Route("/{id}/edit", name="admin_book_edit")
     * @param Request $request
     * @param Book $book
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Book $book)
    {
        $deleteForm = $this->createDeleteForm($book);
        $editForm = $this->createForm('AdminBundle\Form\AuthorDirectorType', $book);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_book_edit', array('id' => $book->getId()));
        }

        return $this->render('AdminBundle:AuthorDirector:edit.html.twig', array(
            'title'          => "Infos Book",
            'authorDirector' => $book,
            'edit_form'      => $editForm->createView(),
            'delete_form'    => $deleteForm->createView(),
        ));
    }


    /**
     * Deletes a book entity.
     *
     * @Route("/{id}/delete", name="admin_book_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param Book $book
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Book $book)
    {
        $form = $this->createDeleteForm($book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($book);
            $em->flush();
        }

        return $this->redirectToRoute('admin_book_index');
    }


    /**
     * Creates a form to delete a book entity.
     *
     * @param Book $book
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(Book $book)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_authordirector_delete', array('id' => $book->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}