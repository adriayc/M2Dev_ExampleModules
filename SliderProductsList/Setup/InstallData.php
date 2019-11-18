<?php

namespace M2Dev\SliderProductsList\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements \Magento\Framework\Setup\InstallDataInterface
{

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

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $cmsBlock = $this->_blockFactory->create();
        $cmsBlock->load('m2dev_cms_block_slider', 'identifier');

        $content = <<<HTML
<div class="slider-conteiner">
<div class="product-slider2">
<!-- Add images to the Slider -->
</div>
</div>
HTML;

        if(!$cmsBlock->getId()) {
            $cmsBlockData = [
                'title' => 'M2Dev CMS Block Slider',
                'identifier' => 'm2dev_cms_block_slider',
                'content' => $content,
                'is_active' => 1,
                'stores' => \Magento\Store\Model\Store::DEFAULT_STORE_ID
            ];

            $this->_blockFactory->create()->setData($cmsBlockData)->save();
        }
    }
}