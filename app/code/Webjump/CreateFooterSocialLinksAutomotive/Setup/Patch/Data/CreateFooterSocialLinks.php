<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Webjump\CreateFooterSocialLinksAutomotive\Setup\Patch\Data;
use Magento\Cms\Model\BlockFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
class CreateFooterSocialLinks implements DataPatchInterface, PatchRevertableInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * @var BlockFactory
     */
    private $blockFactory;
    const IDENTIFIER_BLOCK = 'footer-social-links-automotive';
    /**
     * CreateFooterSocialLinks constructor.
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param BlockFactory $blockFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        BlockFactory $blockFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->blockFactory = $blockFactory;
    }
    /**
     * Patch Method "Apply" method $this->CreateFooterSocialLinks()
     * @return DataPatchInterface|void
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $this->createFooterSocialLinks();
        $this->moduleDataSetup->getConnection()->endSetup();
    }
    /**
     *  Method to create cms landing page
     */
    protected function createFooterSocialLinks()
    {
        $cmsBlock = $this->blockFactory->create()->load(self::IDENTIFIER_BLOCK, 'identifier');
        $cmsBlockData = [
            'is_active' => 1,
            'title' => 'Footer Social Links - Automotive',
            'identifier' => self::IDENTIFIER_BLOCK,
            'stores' => [2],
            'content' => '<div data-content-type="html" data-appearance="default" data-element="main">&lt;div class="footer__social-links"&gt;
            &lt;h2&gt;Siga-nos&lt;/h2&gt;
            &lt;ul&gt;
              &lt;li&gt;&lt;a href="#"&gt;&lt;img src="{{media url=wysiwyg/instagram.png}}" alt="instagram" /&gt;&lt;/a&gt;&lt;/li&gt;
              &lt;li&gt;&lt;a href="#"&gt;&lt;img src="{{media url=wysiwyg/facebook.png}}" alt="facebook" /&gt;&lt;/a&gt;&lt;/li&gt;
              &lt;li&gt;&lt;a href="#"&gt;&lt;img src="{{media url=wysiwyg/twitter.png}}" alt="twitter" /&gt;&lt;/a&gt;&lt;/li&gt;
            &lt;/ul&gt;
          &lt;/div&gt;</div>'
        ];
        if (!$cmsBlock->getId()) {
            $this->blockFactory->create()->setData($cmsBlockData)->save();
        } else {
            $cmsBlock->setTitle($cmsBlockData['title']);
            $cmsBlock->setContent($cmsBlockData['content']);
            $cmsBlock->save();
        }
    }
    /**
     * @inheritdoc
     */
    public static function getDependencies()
    {
        return [];
    }
    public function revert()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $this->moduleDataSetup->getConnection()->endSetup();
    }
    /**
     * @inheritdoc
     */
    public function getAliases()
    {
        return [];
    }
}