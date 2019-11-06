<?php

namespace M2Dev\SlickSlider\Block\Widget;

class ProductList extends \Magento\Framework\View\Element\Template implements \Magento\Widget\Block\BlockInterface
{

//    protected $_template = "widget/customwidget.phtml";

    const DEFAULT_SORT_BY = 'id';
    const DEFAULT_SORT_ORDER = 'asc';

    public function createCollection()
    {
        $collection = $this->productCollectionFactor->create();
        $collection->setVisibility($this->catalogProductVisibility->getVisibleInCatalogIds());

        $collection = $this->__addProductAttributesAndPrices($collection)
            ->addStoreFilter()
            ->setPage($this->getPageSize())
            ->stCurPage($this->getRequest()->getParam($this->getData('page_var_name'), 1))
            ->setOrder($this->getSortBy(), $this->getSortOrder());

        $conditions = $this->getCondition();
        $conditions->collectValidatedAttributes($collection);
        $this->sqlBuilder->attachConditionToCollection($collection, $conditions);

        return $collection;
    }

    public function getSortBy() {
        if(!$this->hasData('products_sort_by')) {
            $this->setData('products_sort_by', self::DEFAULT_SORT_BY);
        }
        return $this->getData('products_sort_by');
    }

    public function getSortOrder() {
        if(!$this->hasData('products_sort_order')) {
            $this->setData('products_sort_order', self::DEFAULT_SORT_ORDER);
        }
        return $this->getData('products_sort_order');
    }
}