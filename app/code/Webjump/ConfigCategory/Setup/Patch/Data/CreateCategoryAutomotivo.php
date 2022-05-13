<?php 
namespace Webjump\ConfigCategory\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\CategoryRepository;


class CreateCategoryAutomotivo implements DataPatchInterface
{   
    private Category $category;
    private CategoryRepository $categoryRepository;
    private $moduleDataSetup;
    function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        Category $category,
        CategoryRepository $categoryRepository
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->category = $category;
        $this->categoryRepository = $categoryRepository;
    }
    public static function getDependencies()
    {
        return [];
    }

    public function createCategories(string $name, int $Rootid)
    {
        $category = $this->category;
        $category->setName($name);
        $category->setParentId($Rootid); 
        $category->setIsActive(true);
        $this->categoryRepository->save($category);
    }

    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        
        $this->createCategories('Automotivo', 1);
        $this->createCategories('Festas', 2);


        $this->moduleDataSetup->getConnection()->endSetup();
    }
    public function getAliases()
    {
        return [];
    }
}
