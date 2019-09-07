<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Entity\User as User;
use App\Form\UserEditFormType;
use App\Form\UserFormType;

use App\Entity\UserGroup as UserGroup;

use App\Entity\Group as Group;


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
     * Creates a new user entity.
     *
     * @Route("/new", name="user_new")
     * @Method({"GET", "POST"})
	 * @Template()
     */
    public function createAction(Request $request, UserPasswordEncoderInterface $encoder)
    {
  
        $em = $this->getDoctrine()->getManager();
        $user = new User();


        $form = $this->createCreateForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /* Handle Uploaded File */
            $data = $form->getData(); 		
			
			$encoded = $encoder->encodePassword($user, $user->getPlainPassword());

			$user->setPassword($encoded);
			
			$user->setEnabled(true);			

			$em->persist($user);
			$em->flush();
            
			$this->addFlash('error', 'Username or email already exists');
			
			return $this->redirect($this->generateUrl('users'));
            
        }

        return [
            'entity' => $user,
            'form' => $form->createView(),
        ];
    }

    /**
     * Creates a form to edit a User entity.
     *
     * @param user $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(User $entity)
    {
        $form = $this->createForm(UserFormType::class, $entity, array(
            'action' => $this->generateUrl('user_new'),
            'method' => 'POST',
        ));        

        return $form;
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
     * @Route("/{id}/update", name="user_update", methods={"POST"})
     */
    public function updateAction(Request $request, $id) {
		
		if ($request->isMethod('post')) {
			$em = $this->getDoctrine()->getManager();		

			$user = $em->getRepository(User::class)->find($id);
			
			if (!$user) {
				throw $this->createNotFoundException('Unable to find User entity.');
			}
				 
			$entity = new UserGroup($user);
			
			$form = $this->createEditForm($user,$id);
			$form->handleRequest($request);		
		

			if ($form->isValid()) {
				try
				{
				
					if ($form->getData()->getGroups())
					{
						
						
						
						foreach($form->getData()->getGroups() as $group)
						{
							
							$groupsFind = $em->getRepository('App\Entity\UserGroup')->findBy(array('user'=>$user->getId(), 'group'=>$group->getId()));
							
							if (!$groupsFind)
							{
								$entity->setUser($user);		
							
								$entity->setGroup($group);
								$em->merge($entity);
							}
						}
					}

					
					$em->flush();
				}
				catch(\Exception $e){
					error_log($e->getMessage());
				}
				
			}

			return $this->redirect($this->generateUrl('users'));
		}
	}
	
	/**
	 * Edits an existing UserProjectGroup entity.
	 *
	 * @Route("/{id}/delete", name="user_delete",  methods={"GET"})
	 */
	public function deleteAction(Request $request, $id) {
		
		if ($request->isMethod('post')) {
			
			try
			{
				$em = $this->getDoctrine()->getManager();		

				$user = $em->getRepository(User::class)->find($id);

				if (!$user) {
					throw $this->createNotFoundException('Unable to find User entity.');
				}
			
			
				$em->remove($user);
				$em->flush();

				// okay, generate $okayResponse
				return $this->redirect($this->generateUrl('users'));
			}
			catch(\Exception $e){
				error_log($e->getMessage());
			}

		}
	}
		
	
	
	/**
	 * Edits an existing UserProjectGroup entity.
	 *
	 * @Route("/{id}/deleteusergroup", name="user_group_delete", methods={"GET"})
	 */
	public function deleteusergroupAction(Request $request, $id) {
		
		if ($request->isMethod('get')) {
		
			try
			{
				$em = $this->getDoctrine()->getManager();		

				$userGr = $em->getRepository(UserGroup::class)->find($id);

				if (!$userGr) {
				throw $this->createNotFoundException('Unable to find User entity.');
				}

				$em->remove($userGr);
				$em->flush();
			}
			catch(\Exception $e){
				error_log($e->getMessage());
			}

		// okay, generate $okayResponse

		}		

		
		return $this->redirect($this->generateUrl('users'));
	}
	
		/**
	 * Edits an existing UserProjectGroup entity.
	 *
	 * @Route("/{id}/deletegroup", name="group_delete", methods={"GET"})
	 */
    public function deletegroupAction(Request $request, $id)
    {
       
		if ($request->isMethod('get')) {
			
	
			try{
				
				$em = $this->getDoctrine()->getManager();		

				$userGr = $em->getRepository(Group::class)->find($id);

				if (!$userGr) {
					throw $this->createNotFoundException('Unable to find User entity.');
				}
				$groupsFind = $em->getRepository('App\Entity\UserGroup')->findBy(array('group'=>$userGr->getId()));
		
				if (!$groupsFind)
				{

					$em->remove($userGr);
					$em->flush();

					// okay, generate $okayResponse
					return $this->redirect($this->generateUrl('users'));
				}
				else
				{
					$this->addFlash('warning', 'cannot delete as user is attached!');
					return $this->redirect($this->generateUrl('fos_user_group_list'));
				}
			}
				catch(\Exception $e){
					error_log($e->getMessage());
				}
			
		}
		
	
		
		return $this->redirect($this->generateUrl('fos_user_group_list'));
	
	
}
}