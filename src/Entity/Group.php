<?php
// src/AppBundle/Entity/Group.php

namespace App\Entity;

use FOS\UserBundle\Model\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;


use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Blameable\Traits\BlameableEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_group")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=false)
 */
class Group extends BaseGroup
{
	use SoftDeleteableEntity;
	use BlameableEntity;
	
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
     protected $id; 
	
	
	public function __toString() {
		return $this->name;
	}
	
	/**
     * Set createdBy
     *
     * @param User $createdBy
     * @return Object
     */
    public function setCreatedBy(User $createdby)
    {
        $this->createdby = $createdby;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return User
     */
    public function getCreatedby()
    {
        return $this->createdby;
    }

    /**
     * Set updatedBy
     *
     * @param User $updatedBy
     * @return Object
     */
    public function setUpdatedby(User $updatedby)
    {
        $this->updatedby = $updatedby;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return User
     */
    public function getUpdatedby()
    {
        return $this->updatedby;
    }
}