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

class MoneyFieldConfig extends AbstractFieldConfig
{
    public function configure(FieldBuilder $builder, array $options)
    {
        $builder->setValueTransformer(new MoneyToLocalizedStringTransformer(array(
                'precision' => $options['precision'],
                'grouping' => $options['grouping'],
                'divisor' => $options['divisor'],
            )))
            ->addRendererPlugin(new MoneyPatternPlugin($options['currency']));
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'template' => 'money',
            'precision' => 2,
            'grouping' => false,
            'divisor' => 1,
            'currency' => 'EUR',
        );
    }

    public function getParent(array $options)
    {
        return 'field';
    }

    public function getIdentifier()
    {
        return 'money';
    }
}