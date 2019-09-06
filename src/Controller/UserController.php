<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\Entity\User as User;
use App\Form\UserEditFormType;

use App\Entity\UserGroup as UserGroup;


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
		
		foreach($entities as $index => $entity)
		{
			
			 $groups = $em->getRepository('App\Entity\UserGroup')->findBy(array('user'=>$entity->getId()));
			
			 $usergroups[$entity->getId()]['groups'] = $groups;
			 
			 $usergroups[$entity->getId()]['user'] = $entity;
		}		
			

        return array(
            'entities' => $usergroups,
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
            'method' => 'POST',
                ));

        //$form->add('submit', 'submit', $this->options(array('label' => 'Update', 'attr' => array('class' => 'right')), 'btn'));

        return $form;
    }

    /**
     * Edits an existing UserProjectGroup entity.
     *
     * @Route("/{id}/update", name="user_update")
     * @Method("POST")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();		

        $user = $em->getRepository(User::class)->find($id);
        
        if (!$user) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
		     
		$entity = new UserGroup($user);
        
        $form = $this->createEditForm($user,$id);
        $form->handleRequest($request);

        if ($form->isValid()) {
			
            
            $entity->setUser($user);			
			
			if ($form->getData()->getGroups())
			{
				
				foreach($form->getData()->getGroups() as $group)
				{
				
					$entity->setGroup($group);
				}
			}

            $em->merge($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('user_edit', array('id' => $user->getId())));
    }
	
/**
 * Edits an existing UserProjectGroup entity.
 *
 * @Route("/{id}/delete", name="user_delete")
 * @Method("POST")
 */
public function deleteAction(Request $request, $id) {
 $em = $this->getDoctrine()->getManager();		

        $user = $em->getRepository(User::class)->find($id);
        
        if (!$user) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
		
		$em->remove($user);
        $em->flush();

  // okay, generate $okayResponse
  return $okayResponse;
}
}