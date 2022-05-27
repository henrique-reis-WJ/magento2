<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Webjump\CreateFooterLinksParty\Setup\Patch\Data;
use Magento\Cms\Model\BlockFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
class CreateFooterLinks implements DataPatchInterface, PatchRevertableInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * @var BlockFactory
     */
    private $blockFactory;
    const IDENTIFIER_BLOCK = 'footer-links-party';
    /**
     * CreateFooterLinks constructor.
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
     * Patch Method "Apply" method $this->CreateFooterLinks()
     * @return DataPatchInterface|void
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $this->createFooterLinks();
        $this->moduleDataSetup->getConnection()->endSetup();
    }
    /**
     *  Method to create cms landing page
     */
    protected function createFooterLinks()
    {
        $cmsBlock = $this->blockFactory->create()->load(self::IDENTIFIER_BLOCK, 'identifier');
        $cmsBlockData = [
            'is_active' => 1,
            'title' => 'Footer Links - Party',
            'identifier' => self::IDENTIFIER_BLOCK,
            'stores' => [3],
            'content' => '<div data-content-type="html" data-appearance="default" data-element="main">&lt;div class="footer__links-container links-institutional"&gt;
            &lt;h2&gt;Institucional&lt;/h2&gt;
            &lt;ul&gt;
              &lt;li&gt;&lt;a href="#"&gt;Sobre nós&lt;/a&gt;&lt;/li&gt;
              &lt;li&gt;&lt;a href="#"&gt;Central de dúvidas&lt;/a&gt;&lt;/li&gt;
              &lt;li&gt;&lt;a href="#"&gt;Nossas vantagens&lt;/a&gt;&lt;/li&gt;
              &lt;li&gt;&lt;a href="#"&gt;Lojas físicas&lt;/a&gt;&lt;/li&gt;
              &lt;li&gt;&lt;a href="#"&gt;Trocas e devoluções&lt;/a&gt;&lt;/li&gt;
              &lt;li&gt;&lt;a href="#"&gt;Comprar no atacado &lt;/a&gt;&lt;/li&gt;
            &lt;/ul&gt;
            &lt;/div&gt;          
            &lt;div class="footer__links-container links-account"&gt;
            &lt;h2&gt;Conta&lt;/h2&gt;
            &lt;ul&gt;
              &lt;li&gt;&lt;a href="#"&gt;Minha conta&lt;/a&gt;&lt;/li&gt;
              &lt;li&gt;&lt;a href="#"&gt;Pedidos&lt;/a&gt;&lt;/li&gt;
            &lt;/ul&gt;    &lt;/div&gt;
&lt;div class="footer__links-container links-suport"&gt;        
            &lt;h2&gt;Suporte&lt;/h2&gt;
            &lt;ul&gt;
              &lt;li&gt;&lt;a href="#"&gt;Política de frete&lt;/a&gt;&lt;/li&gt;
              &lt;li&gt;&lt;a href="#"&gt;Política de privacidade&lt;/a&gt;&lt;/li&gt;
              &lt;li&gt;&lt;a href="#"&gt;Termos e condições&lt;/a&gt;&lt;/li&gt;
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