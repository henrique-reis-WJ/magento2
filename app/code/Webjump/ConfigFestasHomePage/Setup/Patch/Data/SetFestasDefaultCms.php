<?php
namespace Webjump\ConfigFestasHomePage\Setup\Patch\Data;

use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class SetFestasHomepageBR implements DataPatchInterface
{
    private ModuleDataSetupInterface $moduleDataSetup;
    private StoreManagerInterface $storeManager;
    private WriterInterface $writer;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        StoreManagerInterface $storeManager,
        WriterInterface $writer)
{
    $this->moduleDataSetup = $moduleDataSetup;
    $this->storeManager = $storeManager;
    $this->writer = $writer;  
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

public function setDefaultCmsPage (string $storeViewCode, string $contentUrlKey) {

    $StoreViewGetId = $this->storeManager
    ->getStore($storeViewCode)
    ->getId();

    $this->writer->save (
        "web/default/cms_home_page",
        $contentUrlKey, // Here we put the value that is set in contentUrlKey
        "stores",
        $StoreViewGetId // Here we put the StoreId
    );

}

public function apply()
{
    $this->moduleDataSetup->startSetup();

    $this->moduleDataSetup->endSetup();
}
}