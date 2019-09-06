<?php
// src/AppBundle/Entity/Group.php

namespace App\Entity;

use FOS\UserBundle\Model\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_group")
 */
class Group extends BaseGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
     protected $id;
	 
	 /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="groups")
     */
    protected $users;
	
	 public function __toString() {
		return $this->name;
	 }
}