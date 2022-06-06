<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Webjump\ConfigGridBlockAutomotive\Setup\Patch\Data;

use Magento\Cms\Model\BlockFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

class CreateGridBlock implements DataPatchInterface, PatchRevertableInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * @var BlockFactory
     */
    private $blockFactory;
    public const IDENTIFIER_BLOCK = 'grid-theme-automotive';
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
        $this->createGridBlock();
        $this->moduleDataSetup->getConnection()->endSetup();
    }
    /**
     *  Method to create cms landing page
     */
    protected function createGridBlock()
    {
        $cmsBlock = $this->blockFactory->create()->load(self::IDENTIFIER_BLOCK, 'identifier');
        $cmsBlockData = [
            'is_active' => 1,
            'title' => 'Grid Theme Automotive',
            'identifier' => self::IDENTIFIER_BLOCK,
            'stores' => [2],
            'content' => '<style>#html-body [data-pb-style=WQ6LWPE]{justify-content:flex-start;display:flex;flex-direction:column;background-position:center center;background-size:cover;background-repeat:no-repeat;background-attachment:scroll}#html-body [data-pb-style=M18GQKT]{border-style:none}#html-body [data-pb-style=DQEX9RE],#html-body [data-pb-style=R9NMFUH]{max-width:100%;height:auto}#html-body [data-pb-style=Y0DH0OA]{justify-content:flex-start;display:flex;flex-direction:column;background-position:left top;background-size:cover;background-repeat:no-repeat;background-attachment:scroll;width:50%;align-self:stretch}#html-body [data-pb-style=BVG0NIG]{border-style:none}#html-body [data-pb-style=IPET19V],#html-body [data-pb-style=NML9U9J]{max-width:100%;height:auto}#html-body [data-pb-style=XJCXKDT]{justify-content:flex-start;display:flex;flex-direction:column;background-position:left top;background-size:cover;background-repeat:no-repeat;background-attachment:scroll;width:50%;align-self:stretch}#html-body [data-pb-style=GFIL0FQ]{border-style:none}#html-body [data-pb-style=MTV94SW],#html-body [data-pb-style=YUJ5C39]{max-width:100%;height:auto}#html-body [data-pb-style=UVTED64]{justify-content:flex-start;display:flex;flex-direction:column;background-position:center center;background-size:cover;background-repeat:no-repeat;background-attachment:scroll}#html-body [data-pb-style=JIXJNS4]{border-style:none}#html-body [data-pb-style=CYHKMWS],#html-body [data-pb-style=RVIJ04A]{max-width:100%;height:auto}@media only screen and (max-width: 768px) { #html-body [data-pb-style=BVG0NIG],#html-body [data-pb-style=GFIL0FQ],#html-body [data-pb-style=JIXJNS4],#html-body [data-pb-style=M18GQKT]{border-style:none} }</style><div data-content-type="row" data-appearance="full-bleed" data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-background-type="image" data-video-loop="true" data-video-play-only-visible="true" data-video-lazy-load="true" data-video-fallback-src="" data-element="main" data-pb-style="WQ6LWPE"><figure class="pagebuilder__image-top" data-content-type="image" data-appearance="full-width" data-element="main" data-pb-style="M18GQKT"><img class="pagebuilder-mobile-hidden" src="{{media url=wysiwyg/image-grid_top.png}}" alt="" title="" data-element="desktop_image" data-pb-style="DQEX9RE"><img class="pagebuilder-mobile-only" src="{{media url=wysiwyg/image-grid-top-mobile.png}}" alt="" title="" data-element="mobile_image" data-pb-style="R9NMFUH"></figure></div><div class="pagebuilder-column-group" style="display: flex;" data-content-type="column-group" data-grid-size="12" data-element="main"><div class="pagebuilder-column" data-content-type="column" data-appearance="full-height" data-background-images="{}" data-element="main" data-pb-style="Y0DH0OA"><figure class="pagebuilder__image-left" data-content-type="image" data-appearance="full-width" data-element="main" data-pb-style="BVG0NIG"><img class="pagebuilder-mobile-hidden" src="{{media url=wysiwyg/image-grid_middle_left.png}}" alt="" title="" data-element="desktop_image" data-pb-style="NML9U9J"><img class="pagebuilder-mobile-only" src="{{media url=wysiwyg/image-grid_middle_left-mobile.png}}" alt="" title="" data-element="mobile_image" data-pb-style="IPET19V"></figure></div><div class="pagebuilder-column" data-content-type="column" data-appearance="full-height" data-background-images="{}" data-element="main" data-pb-style="XJCXKDT"><figure class="pagebuilder__image-right" data-content-type="image" data-appearance="full-width" data-element="main" data-pb-style="GFIL0FQ"><img class="pagebuilder-mobile-hidden" src="{{media url=wysiwyg/image-grid_middle_right_1.png}}" alt="" title="" data-element="desktop_image" data-pb-style="MTV94SW"><img class="pagebuilder-mobile-only" src="{{media url=wysiwyg/image-grid_middle_right-mobile.png}}" alt="" title="" data-element="mobile_image" data-pb-style="YUJ5C39"></figure></div></div><div data-content-type="row" data-appearance="full-bleed" data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-background-type="image" data-video-loop="true" data-video-play-only-visible="true" data-video-lazy-load="true" data-video-fallback-src="" data-element="main" data-pb-style="UVTED64"><figure class="pagebuilder__image-bottom" data-content-type="image" data-appearance="full-width" data-element="main" data-pb-style="JIXJNS4"><img class="pagebuilder-mobile-hidden" src="{{media url=wysiwyg/image-grid_bottom.png}}" alt="" title="" data-element="desktop_image" data-pb-style="RVIJ04A"><img class="pagebuilder-mobile-only" src="{{media url=wysiwyg/image-grid-bottom-mobile.png}}" alt="" title="" data-element="mobile_image" data-pb-style="CYHKMWS"></figure></div>'
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
