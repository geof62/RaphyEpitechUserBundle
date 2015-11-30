<?php

/*
 * This file is part of the RaphyEpitechUserBundle package.
 *
 * (c) Raphael De Freitas <raphael.defreitas@epitech.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Raphy\Symfony\Epitech\UserBundle\Security;

use Doctrine\ORM\EntityManager;
use Raphy\Symfony\Epitech\UserBundle\Entity\User;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class UserProvider.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class UserProvider implements UserProviderInterface
{
    /**
     * Contains the bundle configuration.
     *
     * @var array
     */
    private $config;

    /**
     * Contains the ORM EntityManager instance.
     *
     * @var EntityManager
     */
    private $entityManager;

    /**
     * Constructor.
     *
     * @param array         $config
     * @param EntityManager $entityManager
     */
    public function __construct(array $config, EntityManager $entityManager)
    {
        $this->config = $config;
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByUsername($username)
    {
        if (empty($username)) {
            throw new UsernameNotFoundException();
        }
        if ($user = $this->findUserBy(array('login' => $username))) {
            return $user;
        }
        /*
         * @var User
         */
        $user = new $this->config['user_class']();
        $user->setLogin($username);

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function refreshUser(UserInterface $user)
    {
        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * {@inheritdoc}
     */
    public function supportsClass($class)
    {
        return in_array('Raphy\Symfony\Epitech\UserBundle\Entity\User', class_parents($class)) || $class === 'Raphy\Symfony\Epitech\UserBundle\Entity\User';
    }

    /**
     * Fins one user by an array of criteria.
     *
     * @param array $criteria
     *
     * @return null|object
     */
    protected function findUserBy(array $criteria)
    {
        $repository = $this->entityManager->getRepository($this->config['user_class']);

        return $repository->findOneBy($criteria);
    }
}
