<?php
// src/AppBundle/Entity/Group.php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user_user_group")
 */
class UserGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
     protected $id;	 

	
	/**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Group")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     */
    protected $group;
	
	public function getId()
	{
		return $this->id;
	}


    /**
     * Set user
     *
     * @param \AIE\Bundle\UserBundle\Entity\User $user
     * @return UserCcmGroup
     */
    public function setUser(\App\Entity\User $user) {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AIE\Bundle\UserBundle\Entity\User 
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Set group
     *
     * @param \AIE\Bundle\UserBundle\Entity\CcmGroup $group
     * @return UserCcmGroup
     */
    public function setGroup(\App\Entity\Group $group = null) {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \AIE\Bundle\UserBundle\Entity\CcmGroupEntityInterface 
     */
    public function getGroup() {
        return $this->group;
    }
	 
	 public function __toString() {
		return $this->name;
	 }
}