<?php

namespace M2Dev\CmsBlockInstaller\Setup;

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
            $cmsBlock->setStoreId(self::STORE_ID)->load('custom_cms_static_block_2', 'identifier');

            $cmsBlockData = [
                'title' => 'Custom CMS Static Block Update',
                'identifier' => 'custom_cms_static_block_update',
                'is_active' => 1,
                'stores' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                'content' => '<div class="container-block">
<h2 class="title">Custon CMS Static Block Update</h2>
<p>This is a CMS Static Block Update</p>
<div class="image">
<img src="" alt="Mi Image">
</div>
</div>'
            ];

            if(!$cmsBlock->getId()) {
                $this->_blockFactory->create()->setData($cmsBlockData)->save();
            } else {
                $cmsBlock->setContent($cmsBlockData['content'])->save();
            }

            $setup->endSetup();
        }
    }
}