<?php

namespace M2Dev\SlickSlider\Model\Config\Source;

class SortOrder implements \Magento\Framework\Option\ArrayInterface
{

    public function toOptionArray()
    {
        return [
            ['value' => 'asc', 'label' => __('Ascending')],
            ['vlaue' => 'desc', 'label' => __('Descending')]
        ];
    }
}