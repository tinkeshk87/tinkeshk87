<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Hcl\CatalogAttribute\Model\Resolver;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Eav\Model\Config;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Catalog\Model\ResourceModel\Product as ProductResource;

/**
 * @inheritdoc
 */
class ProductStateResolver implements ResolverInterface
{
    private const ATTRIBUTE_CODE = 'product_state';

    public function __construct(
        private ProductResource $productResource
    ) {}

    /**
     * @inheritdoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        if (!array_key_exists('model', $value) || !$value['model'] instanceof ProductInterface) {
            throw new GraphQlInputException(__('"model" value should be specified'));
        }
        $store = $context->getExtensionAttributes()->getStore();
        $product = $value['model'];
        $attr = $this->productResource->getAttribute(self::ATTRIBUTE_CODE);
        $optionId = $this->productResource
            ->getAttributeRawValue($product->getId(), self::ATTRIBUTE_CODE, $store->getId());
        return $attr->usesSource() ? $attr->getSource()->getOptionText($optionId) : null;
    }
}
