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
        StoreManagerInterface $storeManager)
{
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
    ->getStore()
    ->getId();

    $pageData = [
        'title' => 'Festas BR', // cms page title
        'page_layout' => '1column', // cms page layout
        'meta_keywords' => 'RH Cms Meta Keywords', // cms page meta keywords
        'meta_description' => 'RH Cms Meta Description', // cms page meta description
        'identifier' => 'festasBR', // cms page identifier
        'content_heading' => 'Rohan Custom CMS Page', // cms page content heading
        'content' => '<h1>RH Custom Cms Page Content</h1>', // cms page content
        'layout_update_xml' => '', // cms page layout xml
        'url_key' => 'festasBR', // cms page url key
        'is_active' => 1, // status enabled or disabled
        'stores' => [0, 1], // You can set store id single or multiple values in array.
        'sort_order' => 0, // cms page sort order
    ];
    $this->moduleDataSetup->startSetup();
    $this->pageFactory->create()->setData($pageData)->save();
    $this->moduleDataSetup->endSetup();
}
}