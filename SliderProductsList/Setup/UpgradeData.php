<?php

namespace M2Dev\SliderProductsList\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements \Magento\Framework\Setup\UpgradeDataInterface
{

    const STORE_ID = \Magento\Store\Model\Store::DEFAULT_STORE_ID;
    /**
     * @var \Magento\Cms\Model\BlockFactory
     */
    private $_blockFactory;

    public function __construct(
        \Magento\Cms\Model\BlockFactory $blockFactory
    )
    {
        $this->_blockFactory = $blockFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if(version_compare($context->getVersion(), '1.0.1', '<')) {
            $cmsBlock = $this->_blockFactory->create();
            $cmsBlock->setStoreId(self::STORE_ID)->load('m2dev_cms_block_slider', 'identifier');

            $cmsBlockData = [
                'title' => 'M2Dev CMS Block Slider',
                'identifier' => 'm2dev_cms_block_slider',
                'content' => '<div class="slider-conteiner">
<div class="product-slider2">
<!-- Add images to the Slider -->
</div>
</div>',
                'is_active' => 1,
                'stores' => [self::STORE_ID],
            ];

            if(!$cmsBlock->getId()) {
                $this->_blockFactory->create()->setData($cmsBlockData)->save();
            } else {
                $cmsBlock->setContent($cmsBlockData['content'])->save();
            }
        }
        $setup->endSetup();
    }
}