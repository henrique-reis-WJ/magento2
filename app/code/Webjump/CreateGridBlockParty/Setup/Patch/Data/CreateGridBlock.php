<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Webjump\CreateGridBlockParty\Setup\Patch\Data;

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
    public const IDENTIFIER_BLOCK = 'grid-banner-party';
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
            'title' => 'Grid Banner - Party',
            'identifier' => self::IDENTIFIER_BLOCK,
            'stores' => [3],
            'content' => '<style>#html-body [data-pb-style=QIPK574],#html-body [data-pb-style=R8H5KKK]{background-size:cover;background-repeat:no-repeat;background-attachment:scroll}#html-body [data-pb-style=R8H5KKK]{justify-content:flex-start;display:flex;flex-direction:column;background-position:left top;width:33.3333%;align-self:stretch}#html-body [data-pb-style=QIPK574]{background-position:center top}#html-body [data-pb-style=PBX5K54]{border-radius:0;min-height:740px;background-color:transparent}#html-body [data-pb-style=IEQE0CC],#html-body [data-pb-style=Q77SK4I]{background-size:cover;background-repeat:no-repeat;background-attachment:scroll}#html-body [data-pb-style=Q77SK4I]{justify-content:flex-start;display:flex;flex-direction:column;background-position:left top;width:33.3333%;align-self:stretch}#html-body [data-pb-style=IEQE0CC]{background-position:center top}#html-body [data-pb-style=NY9QN9Q]{border-radius:0;min-height:740px;background-color:transparent}#html-body [data-pb-style=NY8QW4T],#html-body [data-pb-style=QAMGBYE]{background-size:cover;background-repeat:no-repeat;background-attachment:scroll}#html-body [data-pb-style=QAMGBYE]{justify-content:flex-start;display:flex;flex-direction:column;background-position:left top;width:33.3333%;align-self:stretch}#html-body [data-pb-style=NY8QW4T]{background-position:center top}#html-body [data-pb-style=KQQTXQJ]{border-radius:0;min-height:740px;background-color:transparent}#html-body [data-pb-style=JMLVWKT]{justify-content:flex-start;display:flex;flex-direction:column;background-position:left top;background-size:cover;background-repeat:no-repeat;background-attachment:scroll}#html-body [data-pb-style=M0ONRSR]{background-position:center center;background-size:contain;background-repeat:no-repeat;background-attachment:scroll}#html-body [data-pb-style=DJ8EHQY]{border-radius:0;min-height:160px;background-color:transparent}</style><div class="pagebuilder-column-group" style="display: flex;" data-content-type="column-group" data-grid-size="12" data-element="main"><div class="pagebuilder-column" data-content-type="column" data-appearance="full-height" data-background-images="{}" data-element="main" data-pb-style="R8H5KKK"><div data-content-type="banner" data-appearance="poster" data-show-button="never" data-show-overlay="never" data-element="main" class="grid-banner-party"><div data-element="empty_link"><div class="pagebuilder-banner-wrapper" data-background-images="{\&quot;desktop_image\&quot;:\&quot;{{media url=wysiwyg/festa_junina_1.png}}\&quot;,\&quot;mobile_image\&quot;:\&quot;{{media url=wysiwyg/festa_junina_1__1.png}}\&quot;}" data-background-type="image" data-video-loop="true" data-video-play-only-visible="true" data-video-lazy-load="true" data-video-fallback-src="" data-element="wrapper" data-pb-style="QIPK574"><div class="pagebuilder-overlay pagebuilder-poster-overlay" data-overlay-color="" aria-label="" title="" data-element="overlay" data-pb-style="PBX5K54"><div class="pagebuilder-poster-content"><div data-element="content"></div></div></div></div></div></div></div><div class="pagebuilder-column" data-content-type="column" data-appearance="full-height" data-background-images="{}" data-element="main" data-pb-style="Q77SK4I"><div data-content-type="banner" data-appearance="poster" data-show-button="never" data-show-overlay="never" data-element="main" class="grid-banner-party"><div data-element="empty_link"><div class="pagebuilder-banner-wrapper" data-background-images="{\&quot;desktop_image\&quot;:\&quot;{{media url=wysiwyg/aniversario_1.png}}\&quot;,\&quot;mobile_image\&quot;:\&quot;{{media url=wysiwyg/aniversario_1__1.png}}\&quot;}" data-background-type="image" data-video-loop="true" data-video-play-only-visible="true" data-video-lazy-load="true" data-video-fallback-src="" data-element="wrapper" data-pb-style="IEQE0CC"><div class="pagebuilder-overlay pagebuilder-poster-overlay" data-overlay-color="" aria-label="" title="" data-element="overlay" data-pb-style="NY9QN9Q"><div class="pagebuilder-poster-content"><div data-element="content"></div></div></div></div></div></div></div><div class="pagebuilder-column" data-content-type="column" data-appearance="full-height" data-background-images="{}" data-element="main" data-pb-style="QAMGBYE"><div data-content-type="banner" data-appearance="poster" data-show-button="never" data-show-overlay="never" data-element="main" class="grid-banner-party"><div data-element="empty_link"><div class="pagebuilder-banner-wrapper" data-background-images="{\&quot;desktop_image\&quot;:\&quot;{{media url=wysiwyg/carnaval_1.png}}\&quot;,\&quot;mobile_image\&quot;:\&quot;{{media url=wysiwyg/carnaval_1__1.png}}\&quot;}" data-background-type="image" data-video-loop="true" data-video-play-only-visible="true" data-video-lazy-load="true" data-video-fallback-src="" data-element="wrapper" data-pb-style="NY8QW4T"><div class="pagebuilder-overlay pagebuilder-poster-overlay" data-overlay-color="" aria-label="" title="" data-element="overlay" data-pb-style="KQQTXQJ"><div class="pagebuilder-poster-content"><div data-element="content"></div></div></div></div></div></div></div></div><div data-content-type="row" data-appearance="full-bleed" data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-background-type="image" data-video-loop="true" data-video-play-only-visible="true" data-video-lazy-load="true" data-video-fallback-src="" data-element="main" data-pb-style="JMLVWKT"><div data-content-type="banner" data-appearance="poster" data-show-button="never" data-show-overlay="never" data-element="main"><div data-element="empty_link"><div class="pagebuilder-banner-wrapper" data-background-images="{\&quot;desktop_image\&quot;:\&quot;{{media url=wysiwyg/promocoes_1__2.png}}\&quot;,\&quot;mobile_image\&quot;:\&quot;{{media url=wysiwyg/promocoes_2.png}}\&quot;}" data-background-type="image" data-video-loop="true" data-video-play-only-visible="true" data-video-lazy-load="true" data-video-fallback-src="" data-element="wrapper" data-pb-style="M0ONRSR"><div class="pagebuilder-overlay pagebuilder-poster-overlay" data-overlay-color="" aria-label="" title="" data-element="overlay" data-pb-style="DJ8EHQY"><div class="pagebuilder-poster-content"><div data-element="content"></div></div></div></div></div></div></div>'
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
