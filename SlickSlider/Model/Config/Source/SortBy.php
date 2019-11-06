<?php

namespace M2Dev\SlickSlider\Model\Config\Source;

class SortBy implements \Magento\Framework\Option\ArrayInterface
{

    public function toOptionArray()
    {
        return [
            ['value' => 'id', 'label' => __('Product ID')],
            ['value' => 'name', 'label' => __('Name')],
            ['value' =>  'price', 'label' => __('Price')]
        ];
    }
}