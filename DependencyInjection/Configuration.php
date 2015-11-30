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

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('raphy_epitech_user');

        $rootNode->children()
            ->scalarNode('user_class')->isRequired()->cannotBeEmpty()->end()
            ->end();

        return $treeBuilder;
    }
}
