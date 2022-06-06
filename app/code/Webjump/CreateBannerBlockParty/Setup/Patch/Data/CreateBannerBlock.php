<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Webjump\CreateBannerBlockParty\Setup\Patch\Data;

use Magento\Cms\Model\BlockFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

class CreateBannerBlock implements DataPatchInterface, PatchRevertableInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * @var BlockFactory
     */
    private $blockFactory;
    public const IDENTIFIER_BLOCK = 'main-banner-party';
    /**
     * CreateBannerBlock constructor.
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
     * Patch Method "Apply" method $this->createBannerBlock()
     * @return DataPatchInterface|void
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $this->createBannerBlock();
        $this->moduleDataSetup->getConnection()->endSetup();
    }
    /**
     *  Method to create cms landing page
     */
    protected function createBannerBlock()
    {
        $cmsBlock = $this->blockFactory->create()->load(self::IDENTIFIER_BLOCK, 'identifier');
        $cmsBlockData = [
            'is_active' => 1,
            'title' => 'Main Banner - Party',
            'identifier' => self::IDENTIFIER_BLOCK,
            'stores' => [3],
            'content' => '<style>#html-body [data-pb-style=CCU6GPK]{justify-content:flex-start;display:flex;flex-direction:column;background-position:left top;background-size:cover;background-repeat:no-repeat;background-attachment:scroll}#html-body [data-pb-style=H4X3AT9]{min-height:300px}#html-body [data-pb-style=I1EN6U4]{background-position:center top;background-size:cover;background-repeat:no-repeat;min-height:566px}#html-body [data-pb-style=HOF61EN]{min-height:566px;background-color:transparent}</style><div data-content-type="row" data-appearance="full-bleed" data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-background-type="image" data-video-loop="true" data-video-play-only-visible="true" data-video-lazy-load="true" data-video-fallback-src="" data-element="main" data-pb-style="CCU6GPK"><div class="pagebuilder-slider" data-content-type="slider" data-appearance="default" data-autoplay="false" data-autoplay-speed="4000" data-fade="false" data-infinite-loop="false" data-show-arrows="false" data-show-dots="true" data-element="main" data-pb-style="H4X3AT9"><div class="main-banner-party" data-content-type="slide" data-slide-name="" data-appearance="poster" data-show-button="never" data-show-overlay="never" data-element="main"><div data-element="empty_link"><div class="pagebuilder-slide-wrapper" data-background-images="{\&quot;desktop_image\&quot;:\&quot;{{media url=wysiwyg/Banner_Princpal_5_-min_13.png}}\&quot;,\&quot;mobile_image\&quot;:\&quot;{{media url=wysiwyg/Banner_Princpal_4__15.png}}\&quot;}" data-background-type="image" data-video-loop="true" data-video-play-only-visible="true" data-video-lazy-load="true" data-video-fallback-src="" data-element="wrapper" data-pb-style="I1EN6U4"><div class="pagebuilder-overlay pagebuilder-poster-overlay" data-overlay-color="" aria-label="" title="" data-element="overlay" data-pb-style="HOF61EN"><div class="pagebuilder-poster-content"><div data-element="content"></div></div></div></div></div></div></div></div>'
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
