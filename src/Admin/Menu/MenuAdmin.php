<?php

/*
 * This file is part of the Symfony CMF package.
 *
 * (c) 2011-2017 Symfony CMF
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Cmf\Bundle\SonataPhpcrAdminIntegrationBundle\Admin\Menu;

use Sonata\AdminBundle\Form\FormMapper;

//use Sonata\DoctrinePHPCRAdminBundle\Form\Type\TreeManagerType;
//use Symfony\Cmf\Bundle\MenuBundle\Doctrine\Phpcr\Menu;

class MenuAdmin extends AbstractMenuNodeAdmin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper): void
    {
        parent::configureFormFields($formMapper);

        $subject = $this->getSubject();
        $isNew   = null === $subject->getId();

        // if (!$isNew) {
        //     $formMapper
        //         ->tab('form.tab_general')
        //             ->with('form.group_items', ['class' => 'col-md-6'])
        //                 ->add('children', TreeManagerType::class, [
        //                     'root'              => $subject->getId(),
        //                     'edit_in_overlay'   => false,
        //                     'create_in_overlay' => false,
        //                     'delete_in_overlay' => false,
        //                 ], [
        //                     'help'      => 'help.help_items',
        //                     'help_html' => true,
        //                 ])
        //             ->end()
        //         ->end()
        //     ;
        // }
    }

    /**
     * @phpstan-param T $object
     */
    protected function alterNewInstance(object $object): void
    {
        $object->setParentDocument($this->getModelManager()->find('', $this->menuRoot));
    }
}
