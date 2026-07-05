<?php

/*
 * This file is part of the Symfony CMF package.
 *
 * (c) 2011-2017 Symfony CMF
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Cmf\Bundle\SonataPhpcrAdminIntegrationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * A form type to select a node based on a tree browser.
 *
 * The widget option provides 2 different ways to display the form type:
 *
 * - browser
 *     Displays only the tree browser;
 * - compact
 *     Displays a text field with a button to select using the tree browser
 *     (just like a file browser).
 *
 * @author Wouter de Jong <wouter@wouterj.nl>
 */
class TreeSelectType extends AbstractType
{
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        parent::buildView($view, $form, $options);

        $view->vars['type'] = ('compact' === $options['widget']) ? 'text' : 'hidden';
        $view->vars['widget'] = $options['widget'];
        $view->vars['root_node'] = $options['root_node'];
        $view->vars['repository_name'] = $options['repository_name'];
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('widget', 'compact');
        $resolver->setAllowedValues('widget', ['browser', 'compact']);

        $resolver->setDefault('root_node', '/');
        // Tolerate a null root_node (e.g. when an admin basepath is not yet
        // resolved) instead of crashing on $value[0]; a string must still be an
        // absolute PHPCR path.
        $resolver->setAllowedValues('root_node', static fn($value): bool => null === $value || (\is_string($value) && str_starts_with($value, '/')));
        $resolver->setNormalizer('root_node', static fn(Options $options, ?string $value): string => $value ?? '/');

        $resolver->setDefault('repository_name', 'default');
    }

    public function getBlockPrefix(): string
    {
        return 'cmf_tree_select';
    }

    public function getParent(): ?string
    {
        return TextType::class;
    }
}
