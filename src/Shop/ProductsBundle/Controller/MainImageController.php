<?php

namespace Shop\ProductsBundle\Controller;

use Shop\ProductsBundle\Entity\MainImage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Mainimage controller.
 *
 * @Route("mainimage")
 */
class MainImageController extends Controller
{
    /**
     * Lists all mainImage entities.
     *
     * @Route("/", name="mainimage_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $mainImages = $em->getRepository('ShopProductsBundle:MainImage')->findAll();

        return $this->render('mainimage/index.html.twig', array(
            'mainImages' => $mainImages,
        ));
    }

    /**
     * Creates a new mainImage entity.
     *
     * @Route("/new", name="mainimage_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $mainImage = new Mainimage();
        $form = $this->createForm('Shop\ProductsBundle\Form\MainImageType', $mainImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mainImage);
            $em->flush();

            return $this->redirectToRoute('mainimage_show', array('id' => $mainImage->getId()));
        }

        return $this->render('mainimage/new.html.twig', array(
            'mainImage' => $mainImage,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a mainImage entity.
     *
     * @Route("/{id}", name="mainimage_show")
     * @Method("GET")
     */
    public function showAction(MainImage $mainImage)
    {
        $deleteForm = $this->createDeleteForm($mainImage);

        return $this->render('mainimage/show.html.twig', array(
            'mainImage' => $mainImage,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing mainImage entity.
     *
     * @Route("/{id}/edit", name="mainimage_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, MainImage $mainImage)
    {
        $deleteForm = $this->createDeleteForm($mainImage);
        $editForm = $this->createForm('Shop\ProductsBundle\Form\MainImageType', $mainImage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mainimage_edit', array('id' => $mainImage->getId()));
        }

        return $this->render('mainimage/edit.html.twig', array(
            'mainImage' => $mainImage,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a mainImage entity.
     *
     * @Route("/{id}", name="mainimage_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, MainImage $mainImage)
    {
        $form = $this->createDeleteForm($mainImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($mainImage);
            $em->flush();
        }

        return $this->redirectToRoute('mainimage_index');
    }

    /**
     * Creates a form to delete a mainImage entity.
     *
     * @param MainImage $mainImage The mainImage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(MainImage $mainImage)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('mainimage_delete', array('id' => $mainImage->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
