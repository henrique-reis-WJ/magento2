<?php 
namespace Webjump\ConfigCategory\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\CategoryRepository;


class CreateCategoryAutomotivo implements DataPatchInterface
{   
    private CategoryFactory $categoryFactory;
    private CategoryRepository $categoryRepository;
    private $moduleDataSetup;
    
    function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CategoryFactory $categoryFactory,
        Category $category,
        CategoryRepository $categoryRepository
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->categoryFactory = $categoryFactory;
        $this->category = $category;
        $this->categoryRepository = $categoryRepository;
    }
    public static function getDependencies()
    {
        return [];
    }

    public function createAutomotivoCategory()
    {
        $category = $this->categoryFactory->create();
        $category->setName("Automotivo");
        $category->setParentId("1"); 
        $category->setIsActive(true);
        $this->categoryRepository->save($category);
    }

    public function createFestasCategory()
    {
        $category = $this->categoryFactory->create();
        $category->setName("Festas");
        $category->setParentId("1"); 
        $category->setIsActive(true);
        $this->categoryRepository->save($category);
    }


    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        
        $this->createAutomotivoCategory();
        $this->createFestasCategory();

        $this->moduleDataSetup->getConnection()->endSetup();
    }
    public function getAliases()
    {
        return [];
    }
}
