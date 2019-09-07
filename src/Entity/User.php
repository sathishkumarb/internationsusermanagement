<?php
// src/Entity/User.php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Blameable\Traits\BlameableEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=false)
 */
class User extends BaseUser implements UserInterface
{
	use SoftDeleteableEntity;
	use BlameableEntity;
	
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
	
	/**
     * @ORM\Column(type="string",nullable=true)
     */
    private $name;
	
	 /** 
	 * @var User $createdBy
	 *
	 * @Gedmo\Blameable(on="create")
	 * @ORM\ManyToOne(targetEntity="App\Entity\User")
	 * @ORM\JoinColumn(name="user_created", referencedColumnName="id")
	 */
	private $createdby;

	/**
	 * @var User $updatedBy
	 *
	 * @Gedmo\Blameable(on="update")
	 * @ORM\ManyToOne(targetEntity="App\Entity\User")
	 * @ORM\JoinColumn(name="user_updated", referencedColumnName="id")
	 */
	private $updatedby;
	
	
	public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
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


	public function getRoles(): array
	{
		$roles = $this->roles;
		// guarantee every user at least has ROLE_USER
		$roles[] = 'ROLE_USER';

		return array_unique($roles);
	}
	
	
}