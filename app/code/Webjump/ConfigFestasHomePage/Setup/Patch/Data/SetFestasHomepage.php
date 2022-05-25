<?php
namespace Webjump\ConfigFestasHomePage\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class SetFestasHomepage implements DataPatchInterface
{
    private ModuleDataSetupInterface $moduleDataSetup;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup)
{
    $this->moduleDataSetup = $moduleDataSetup;  
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
public function apply() {
    $this->moduleDataSetup->getConnection()->startSetup();
    

    $this->moduleDataSetup->getConnection()->endSetup();
}
}