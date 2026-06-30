<?php

/*
 * This file is part of the Symfony CMF package.
 *
 * (c) 2011-2017 Symfony CMF
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Cmf\Bundle\SonataPhpcrAdminIntegrationBundle;

use Symfony\Cmf\Bundle\SonataPhpcrAdminIntegrationBundle\DependencyInjection\CmfSonataPhpcrAdminIntegrationExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CmfSonataPhpcrAdminIntegrationBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        // The extension also acts as a compiler pass: it iterates its admin
        // factories and runs their process() to fill the *.basepath parameters
        // (block, menu, routing, content) from the cmf_* persistence basepaths.
        // It must be registered explicitly — Symfony does not run an Extension's
        // process() automatically, and without it those parameters stay null
        // (e.g. setRootPath(null) -> TreeSelectType root_node null -> crash).
        $extension = $this->getContainerExtension();
        \assert($extension instanceof CmfSonataPhpcrAdminIntegrationExtension);
        $container->addCompilerPass($extension);
    }
}
