<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Hcl\CatalogAttribute\Model\Attribute\ProductState;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Options extends AbstractSource
{
    /**
     * Product State options
     *
     * @return array
     */
    public function getAllOptions(): array
    {
        $this->_options = [
            ['value' => '', 'label' => ' '],
            ['value' => '1', 'label' => __('New')],
            ['value' => '2', 'label' => __('Sale')],
            ['value' => '3', 'label' => __('Exclusive')]
        ];
        return $this->_options;
    }
}
