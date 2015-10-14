<?php

/*
 * This file is part of the EpitechUserBundle package.
 *
 * (c) Raphael De Freitas <raphael@de-freitas.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Raphy\Epitech\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class User implements UserInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="login", type="string", length=10)
     * @ORM\Id
     */
    private $login;

    /**
     * @ORM\Column(name="roles", type="array")
     */
    private $roles = array('ROLE_USER');

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_conection_date", type="datetime")
     */
    private $lastConnectionDate;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lastConnectionDate = new \DateTime();
    }

    /**
     * Updates this user from the Intranet user
     *
     * @param \EpitechAPI\Component\User $intranetUser
     */
    public function updateFromIntranet(\EpitechAPI\Component\User $intranetUser)
    {
        $this->login = $intranetUser->getLogin();
        $this->roles = array("ROLE_USER");
        foreach ($intranetUser->getGroupsName() as $groupName) {
            $this->roles[] = "ROLE_" . strtoupper($groupName);
        }
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->getLogin();
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        return null;
    }


    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set login
     *
     * @param string $login
     * @return $this
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Set lastConnectionDate
     *
     * @param \DateTime $lastConnectionDate
     *
     * @return User
     */
    public function setLastConnectionDate(\DateTime $lastConnectionDate)
    {
        $this->lastConnectionDate = $lastConnectionDate;

        return $this;
    }

    /**
     * Get lastConnectionDate
     *
     * @return \DateTime
     */
    public function getLastConnectionDate()
    {
        return $this->lastConnectionDate;
    }

    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return User
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }
}
