<?php

/*
 * This file is part of the Symfony CMF package.
 *
 * (c) 2011-2017 Symfony CMF
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Cmf\Bundle\SonataPhpcrAdminIntegrationBundle\Tests\Fixtures\App\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\DoctrinePHPCRAdminBundle\Admin\Admin;

/**
 * Common base admin for Menu and MenuNode.
 */
class MenuContentAdmin extends Admin
{
    protected $baseRouteName = 'cmf_menu_test_content';

    protected $baseRoutePattern = '/cmf/menu-test/content';

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->addIdentifier('id', 'text')
            ->add('title', 'text')
        ;

        $listMapper
            ->add('locales', 'choice', [
                'template' => '@SonataDoctrinePHPCRAdmin/CRUD/locales.html.twig',
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->with('form.group_general')
                ->add('title', 'text')
            ->end()
        ;
    }
}
