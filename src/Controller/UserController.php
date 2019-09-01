<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\Entity\User;
use App\Form\UserEditFormType;


/**
 * @Route("users")
 */
class UserController extends AbstractController {

    /**
     * Lists all users entities.
     *
     * @Route("/", name="users")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('App\Entity\User')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Lists all ConsequencesCategories entities.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('App\Entity\User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createEditForm($entity);
        return array(
            'entity' => $entity,
            'form' => $editForm->createView(),
        );
    }

    /**
     * Creates a form to edit a UserProjectGroup entity.
     *
     * @param UserProjectGroup $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(User $entity) {

		
		$form = $this->createForm(UserEditFormType::class, $entity, array(
            'action' => $this->generateUrl('user_update', array('id' => $entity->getId())),
            'method' => 'PUT',
                ));

        //$form->add('submit', 'submit', $this->options(array('label' => 'Update', 'attr' => array('class' => 'right')), 'btn'));

        return $form;
    }

    /**
     * Edits an existing UserProjectGroup entity.
     *
     * @Route("/{id}/edit", name="user_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();


        $entity = $em->getRepository('App\Entity\User')->find($id);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $form = $this->createEditForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();
        }

        return $this->redirect($this->generateUrl('user_edit', array('id' => $entity->getId())));
    }

}