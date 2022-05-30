<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Webjump\CreateGridBlockPartyUS\Setup\Patch\Data;
use Magento\Cms\Model\BlockFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
class CreateGridBlockUS implements DataPatchInterface, PatchRevertableInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * @var BlockFactory
     */
    private $blockFactory;
    const IDENTIFIER_BLOCK = 'grid-banner-party-us';
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
        $this->createBannerBlockUS();
        $this->moduleDataSetup->getConnection()->endSetup();
    }
    /**
     *  Method to create cms landing page
     */
    protected function createBannerBlockUS()
    {
        $cmsBlock = $this->blockFactory->create()->load(self::IDENTIFIER_BLOCK, 'identifier');
        $cmsBlockData = [
            'is_active' => 1,
            'title' => 'Grid Banner Party US',
            'identifier' => self::IDENTIFIER_BLOCK,
            'stores' => [5],
            'content' => '<style>#html-body [data-pb-style=PSMIEN6],#html-body [data-pb-style=TT6O16V]{background-size:cover;background-repeat:no-repeat;background-attachment:scroll}#html-body [data-pb-style=PSMIEN6]{justify-content:flex-start;display:flex;flex-direction:column;background-position:left top;width:33.3333%;align-self:stretch}#html-body [data-pb-style=TT6O16V]{background-position:center top}#html-body [data-pb-style=RLN6HP4]{border-radius:0;min-height:740px;background-color:transparent}#html-body [data-pb-style=FD9YF6J],#html-body [data-pb-style=V9S8J9R]{background-size:cover;background-repeat:no-repeat;background-attachment:scroll}#html-body [data-pb-style=V9S8J9R]{justify-content:flex-start;display:flex;flex-direction:column;background-position:left top;width:33.3333%;align-self:stretch}#html-body [data-pb-style=FD9YF6J]{background-position:center top}#html-body [data-pb-style=RNFS254]{border-radius:0;min-height:740px;background-color:transparent}#html-body [data-pb-style=E8R2CUI],#html-body [data-pb-style=L71LTGD]{background-size:cover;background-repeat:no-repeat;background-attachment:scroll}#html-body [data-pb-style=E8R2CUI]{justify-content:flex-start;display:flex;flex-direction:column;background-position:left top;width:33.3333%;align-self:stretch}#html-body [data-pb-style=L71LTGD]{background-position:center top}#html-body [data-pb-style=GNQ2IA5]{border-radius:0;min-height:740px;background-color:transparent}#html-body [data-pb-style=P69478R]{justify-content:flex-start;display:flex;flex-direction:column;background-position:left top;background-size:cover;background-repeat:no-repeat;background-attachment:scroll}#html-body [data-pb-style=WI1I576]{background-position:center center;background-size:contain;background-repeat:no-repeat;background-attachment:scroll}#html-body [data-pb-style=C6AGRYS]{border-radius:0;min-height:160px;background-color:transparent}</style><div class="pagebuilder-column-group" style="display: flex;" data-content-type="column-group" data-grid-size="12" data-element="main"><div class="pagebuilder-column" data-content-type="column" data-appearance="full-height" data-background-images="{}" data-element="main" data-pb-style="PSMIEN6"><div data-content-type="banner" data-appearance="poster" data-show-button="never" data-show-overlay="never" data-element="main" class="grid-banner-party"><div data-element="empty_link"><div class="pagebuilder-banner-wrapper" data-background-images="{\&quot;desktop_image\&quot;:\&quot;{{media url=wysiwyg/Festa_Junina_Desktop.png}}\&quot;,\&quot;mobile_image\&quot;:\&quot;{{media url=wysiwyg/Festa_Junina_Mobile.png}}\&quot;}" data-background-type="image" data-video-loop="true" data-video-play-only-visible="true" data-video-lazy-load="true" data-video-fallback-src="" data-element="wrapper" data-pb-style="TT6O16V"><div class="pagebuilder-overlay pagebuilder-poster-overlay" data-overlay-color="" aria-label="" title="" data-element="overlay" data-pb-style="RLN6HP4"><div class="pagebuilder-poster-content"><div data-element="content"></div></div></div></div></div></div></div><div class="pagebuilder-column" data-content-type="column" data-appearance="full-height" data-background-images="{}" data-element="main" data-pb-style="V9S8J9R"><div data-content-type="banner" data-appearance="poster" data-show-button="never" data-show-overlay="never" data-element="main" class="grid-banner-party"><div data-element="empty_link"><div class="pagebuilder-banner-wrapper" data-background-images="{\&quot;desktop_image\&quot;:\&quot;{{media url=wysiwyg/Aniversario_Desktop_1.png}}\&quot;,\&quot;mobile_image\&quot;:\&quot;{{media url=wysiwyg/Aniversario_Mobile_1.png}}\&quot;}" data-background-type="image" data-video-loop="true" data-video-play-only-visible="true" data-video-lazy-load="true" data-video-fallback-src="" data-element="wrapper" data-pb-style="FD9YF6J"><div class="pagebuilder-overlay pagebuilder-poster-overlay" data-overlay-color="" aria-label="" title="" data-element="overlay" data-pb-style="RNFS254"><div class="pagebuilder-poster-content"><div data-element="content"></div></div></div></div></div></div></div><div class="pagebuilder-column" data-content-type="column" data-appearance="full-height" data-background-images="{}" data-element="main" data-pb-style="E8R2CUI"><div data-content-type="banner" data-appearance="poster" data-show-button="never" data-show-overlay="never" data-element="main" class="grid-banner-party"><div data-element="empty_link"><div class="pagebuilder-banner-wrapper" data-background-images="{\&quot;desktop_image\&quot;:\&quot;{{media url=wysiwyg/Carnaval_Desktop_4.png}}\&quot;,\&quot;mobile_image\&quot;:\&quot;{{media url=wysiwyg/Carnaval_Mobile_4.png}}\&quot;}" data-background-type="image" data-video-loop="true" data-video-play-only-visible="true" data-video-lazy-load="true" data-video-fallback-src="" data-element="wrapper" data-pb-style="L71LTGD"><div class="pagebuilder-overlay pagebuilder-poster-overlay" data-overlay-color="" aria-label="" title="" data-element="overlay" data-pb-style="GNQ2IA5"><div class="pagebuilder-poster-content"><div data-element="content"></div></div></div></div></div></div></div></div><div data-content-type="row" data-appearance="full-bleed" data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-background-type="image" data-video-loop="true" data-video-play-only-visible="true" data-video-lazy-load="true" data-video-fallback-src="" data-element="main" data-pb-style="P69478R"><div data-content-type="banner" data-appearance="poster" data-show-button="never" data-show-overlay="never" data-element="main"><div data-element="empty_link"><div class="pagebuilder-banner-wrapper" data-background-images="{\&quot;desktop_image\&quot;:\&quot;{{media url=wysiwyg/Promocoes_Desktop_4.png}}\&quot;,\&quot;mobile_image\&quot;:\&quot;{{media url=wysiwyg/Promocoes_Mobile_2.png}}\&quot;}" data-background-type="image" data-video-loop="true" data-video-play-only-visible="true" data-video-lazy-load="true" data-video-fallback-src="" data-element="wrapper" data-pb-style="WI1I576"><div class="pagebuilder-overlay pagebuilder-poster-overlay" data-overlay-color="" aria-label="" title="" data-element="overlay" data-pb-style="C6AGRYS"><div class="pagebuilder-poster-content"><div data-element="content"></div></div></div></div></div></div></div>'
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