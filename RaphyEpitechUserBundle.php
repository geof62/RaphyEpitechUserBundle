<?php

/*
 * This file is part of the RaphyEpitechUserBundle package.
 *
 * (c) Raphael De Freitas <raphael.defreitas@epitech.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Raphy\Symfony\Epitech\UserBundle;

use Raphy\Symfony\Epitech\UserBundle\Security\AuthenticationFactory;
use Symfony\Bundle\SecurityBundle\DependencyInjection\SecurityExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class RaphyEpitechUserBundle.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class RaphyEpitechUserBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        /** @var SecurityExtension $securityExtension */
        $securityExtension = $container->getExtension('security');
        $securityExtension->addSecurityListenerFactory(new AuthenticationFactory());
    }
}
