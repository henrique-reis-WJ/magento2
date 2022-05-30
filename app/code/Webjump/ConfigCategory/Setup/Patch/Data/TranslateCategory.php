<?php 
namespace Webjump\ConfigCategory\Setup\Patch\Data;

use Magento\Catalog\Model\CategoryRepository;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class CreateCategory implements DataPatchInterface
{
    private ModuleDataSetupInterface $moduleDataSetup;
    private CategoryRepository $categoryRepository;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CategoryRepository $categoryRepository
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->categoryRepository = $categoryRepository;
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
        $this->moduleDataSetup->getConnection()->startSetup();



        $this->moduleDataSetup->getConnection()->endSetup();
    }
}