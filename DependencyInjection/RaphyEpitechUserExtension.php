<?php

/*
 * This file is part of the RaphyEpitechUserBundle package.
 *
 * (c) Raphael De Freitas <raphael.defreitas@epitech.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Raphy\Symfony\Epitech\UserBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class RaphyEpitechUserExtension.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class RaphyEpitechUserExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('raphy_epitech_user.config', $config);
    }
}
