<?php

namespace M2Dev\CmsBlockInstaller\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\PatchInterface;
use phpDocumentor\Reflection\Types\This;

class AddNewCmsStaticBlock implements \Magento\Framework\Setup\Patch\DataPatchInterface
{

    /**
     * @var \Magento\Framework\Setup\ModuleDataSetupInterface
     */
    private $_moduleDataSetup;
    /**
     * @var \Magento\Cms\Model\BlockFactory
     */
    private $_blockFactory;

    public function __construct(
        \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup,
        \Magento\Cms\Model\BlockFactory $blockFactory
    )
    {
        $this->_moduleDataSetup = $moduleDataSetup;
        $this->_blockFactory = $blockFactory;
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply()
    {
        $content = <<<HTML
<h1 class="title">Custom CMS Static Block</h1>
<p>Add CMS Static Block Programmatically using Setup Patchdata in Magento 2</p>
HTML;

        $newCmsStaticBlock = [
            'title' => 'Custom CMS Static Block 2',
            'identifier' => 'custom_cms_static_block_2',
//            'content' => '<h1 class="title">Custom CMS Static Block</h1>',
            'content' => $content,
            'is_active' => 1,
            'stores' => \Magento\Store\Model\Store::DEFAULT_STORE_ID
        ];

        $this->_moduleDataSetup->startSetup();

        /** @var \Magento\Cms\Model\Block $block */
        $block = $this->_blockFactory->create();
        $block->setData($newCmsStaticBlock)->save();

        $this->_moduleDataSetup->endSetup();
    }
}