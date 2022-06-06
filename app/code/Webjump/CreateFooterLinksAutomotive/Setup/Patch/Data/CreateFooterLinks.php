<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Webjump\CreateFooterLinksAutomotive\Setup\Patch\Data;

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
    public const IDENTIFIER_BLOCK = 'footer-links-automotive';
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
            'title' => 'Footer Links - Automotive',
            'identifier' => self::IDENTIFIER_BLOCK,
            'stores' => [2],
            'content' => '<div data-content-type="html" data-appearance="default" data-element="main">&lt;div class="footer__links-container links-left"&gt;
            &lt;h2&gt;Explorar&lt;/h2&gt;
            &lt;ul&gt;
              &lt;li&gt;&lt;a href="#"&gt;Modelos&lt;/a&gt;&lt;/li&gt;
              &lt;li&gt;&lt;a href="#"&gt;Comparar&lt;/a&gt;&lt;/li&gt;
              &lt;li&gt;&lt;a href="#"&gt;Tecnologia&lt;/a&gt;&lt;/li&gt;
              &lt;li&gt;&lt;a href="#"&gt;Vida na Volt&lt;/a&gt;&lt;/li&gt;
              &lt;li&gt;&lt;a href="#"&gt;Biblioteca Volt&lt;/a&gt;&lt;/li&gt;
              &lt;li&gt;&lt;a href="#"&gt;Volt Sport&lt;/a&gt;&lt;/li&gt;
            &lt;/ul&gt;
            &lt;/div&gt;
            &lt;div class="footer__links-container links-middle"&gt;
            &lt;h2&gt;Loja&lt;/h2&gt;
            &lt;ul&gt;
              &lt;li&gt;&lt;a href="#"&gt;Ofertas exclusivas&lt;/a&gt;&lt;/li&gt;
              &lt;li&gt;&lt;a href="#"&gt;Encontrar loja&lt;/a&gt;&lt;/li&gt;
              &lt;li&gt;&lt;a href="#"&gt;Inventário&lt;/a&gt;&lt;/li&gt;
              &lt;li&gt;&lt;a href="#"&gt;Pré-proprietário certificado&lt;/a&gt;&lt;/li&gt;
              &lt;li&gt;&lt;a href="#"&gt;Brochuras&lt;/a&gt;&lt;/li&gt;
            &lt;/ul&gt;
            &lt;/div&gt;
            &lt;div class="footer__links-container links-right"&gt;
            &lt;h2&gt;Comprar&lt;/h2&gt;
            &lt;ul&gt;
              &lt;li&gt;&lt;a href="#"&gt;Solicitar cotação&lt;/a&gt;&lt;/li&gt;
              &lt;li&gt;&lt;a href="#"&gt;Estimar pagamento&lt;/a&gt;&lt;/li&gt;
              &lt;li&gt;&lt;a href="#"&gt;Valor de troca&lt;/a&gt;&lt;/li&gt;
              &lt;li&gt;&lt;a href="#"&gt;Locação&lt;/a&gt;&lt;/li&gt;
              &lt;li&gt;&lt;a href="#"&gt;Financiamento&lt;/a&gt;&lt;/li&gt;
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
