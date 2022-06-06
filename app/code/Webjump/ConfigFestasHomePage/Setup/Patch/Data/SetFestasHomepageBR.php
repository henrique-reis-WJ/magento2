<?php

namespace Webjump\ConfigFestasHomePage\Setup\Patch\Data;

use Magento\Cms\Model\PageFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class SetFestasHomepageBR implements DataPatchInterface
{
    private ModuleDataSetupInterface $moduleDataSetup;
    private PageFactory $pageFactory;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        PageFactory $pageFactory,
        StoreManagerInterface $storeManager
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->pageFactory = $pageFactory;
        $this->storeManager = $storeManager;
    }

    public function getAliases()
    {
        return [
        ];
    }

    public static function getDependencies()
    {
        return [
        ];
    }

    public function apply()
    {
        $StoreViewGetId = $this->storeManager
        ->getStore("festas_store_view_pt")
        ->getId();

        $pageData = [
        'title' => 'festasbr', // cms page title
        'page_layout' => 'cms-full-width', // cms page layout
        'meta_keywords' => '', // cms page meta keywords
        'meta_description' => '', // cms page meta description
        'identifier' => 'festasbr', // cms page identifier
        'content_heading' => '', // cms page content heading
        'content' => '<div data-content-type="block" data-appearance="default" data-element="main">{{widget type="Magento\Cms\Block\Widget\Block" template="widget/static_block/default.phtml" block_id="main-banner-party" type_name="CMS Static Block"}}</div><div data-content-type="block" data-appearance="default" data-element="main">{{widget type="Magento\Cms\Block\Widget\Block" template="widget/static_block/default.phtml" block_id="grid-banner-party" type_name="CMS Static Block"}}</div><div data-content-type="block" data-appearance="default" data-element="main">{{widget type="Magento\Cms\Block\Widget\Block" template="widget/static_block/default.phtml" block_id="carousel-theme-party" type_name="CMS Static Block"}}</div>', // cms page content
        'layout_update_xml' => '', // cms page layout xml
        'url_key' => 'festasbr', // cms page url key
        'is_active' => 1, // status enabled or disabled
        'stores' => [$StoreViewGetId], // You can set store id single or multiple values in array.
        'sort_order' => 0, // cms page sort order
        ];
        $this->moduleDataSetup->startSetup();
        $this->pageFactory->create()->setData($pageData)->save();
        $this->moduleDataSetup->endSetup();
    }
}
