<?php
namespace Webjump\ConfigTranslateOrder\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class SetOrderTranslated implements DataPatchInterface
{
    private $moduleDataSetup;

    function __construct(
        ModuleDataSetupInterface $moduleDataSetup
        )
    {
        $this->moduleDataSetup = $moduleDataSetup;
    }


    public static function getDependencies()
    {
        return [
        ];
    }
    
    public function getAliases()
    {
        return [
        ];
    }

    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();



        $this->moduleDataSetup->getConnection()->endSetup();
    }
}