<?php

/*
 * This file is part of the RaphyEpitechUserBundle package.
 *
 * (c) Raphael De Freitas <raphael@de-freitas.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Raphy\Symfony\Epitech\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User.
 *
 * @MappedSuperClass
 */
class User implements UserInterface
{
    /**
     * @var int
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
     * @ORM\Column(name="last_connection_date", type="datetime")
     */
    private $lastConnectionDate;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->lastConnectionDate = new \DateTime();
    }

    /**
     * Updates this user from the Intranet user.
     *
     * @param \EpitechAPI\Component\User $intranetUser
     */
    public function updateFromIntranet(\EpitechAPI\Component\User $intranetUser)
    {
        $this->login = $intranetUser->getLogin();
        $this->roles = array('ROLE_USER');
        foreach ($intranetUser->getGroupsName() as $groupName) {
            $this->roles[] = 'ROLE_'.strtoupper($groupName);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
        return;
    }

    /**
     * {@inheritdoc}
     */
    public function getSalt()
    {
        return;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->getLogin();
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {
        return;
    }

    /**
     * Get login.
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set login.
     *
     * @param string $login
     *
     * @return $this
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Set lastConnectionDate.
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
     * Get lastConnectionDate.
     *
     * @return \DateTime
     */
    public function getLastConnectionDate()
    {
        return $this->lastConnectionDate;
    }

    /**
     * Set roles.
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
     * Get roles.
     *
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }
}
