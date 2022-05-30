<?php
namespace Webjump\ConfigCategory\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Catalog\Model\CategoryFactory;

class TranslateCategory implements DataPatchInterface
{
    private ModuleDataSetupInterface $moduleDataSetup;
    private CategoryFactory $categoryFactory;

    public function __construct(        
        ModuleDataSetupInterface $moduleDataSetup,
        CategoryFactory $categoryFactory)
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->categoryFactory = $categoryFactory;
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
        
    }
}