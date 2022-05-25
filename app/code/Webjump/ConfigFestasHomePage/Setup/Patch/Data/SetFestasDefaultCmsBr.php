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

public function apply()
{
    $StoreViewGetId = $this->storeManager
    ->getStore("festas_store_view_pt")
    ->getId();

    $this->moduleDataSetup->startSetup();
    $this->moduleDataSetup->endSetup();
}
}