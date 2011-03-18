<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Form\Config;

use Symfony\Component\Form\FieldBuilder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\CsrfProvider\CsrfProviderInterface;
use Symfony\Component\Form\DataMapper\ObjectMapper;
use Symfony\Component\Form\Renderer\Plugin\FormPlugin;

class FormConfig extends AbstractFieldConfig
{
    public function configure(FieldBuilder $builder, array $options)
    {
        $builder->setValidationGroups($options['validation_groups'])
            ->setVirtual($options['virtual'])
            ->addRendererPlugin(new FormPlugin())
            ->setDataClass($options['data_class'])
            ->setDataMapper(new ObjectMapper(
                $options['data_class'],
                $options['data_constructor']
            ));

        if ($options['csrf_protection']) {
            $builder->addCsrfProtection($options['csrf_provider'], $options['csrf_field_name']);
        }
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'template' => 'form',
            'data_class' => null,
            'data_constructor' => null,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_provider' => null,
            'validation_groups' => null,
            'virtual' => false,
        );
    }

    public function getParent(array $options)
    {
        return 'field';
    }

    public function getIdentifier()
    {
        return 'form';
    }
}