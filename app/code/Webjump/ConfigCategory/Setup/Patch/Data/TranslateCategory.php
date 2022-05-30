<?php 
namespace Webjump\ConfigCategory\Setup\Patch\Data;

use Magento\Catalog\Model\CategoryRepository;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Catalog\Api\CategoryListInterface;
use Magento\Catalog\Model\CategoryFactory;

class TranslateCategory implements DataPatchInterface
{
    private ModuleDataSetupInterface $moduleDataSetup;
    private CategoryRepository $categoryRepository;
    private SearchCriteriaBuilder $searchCriteriaBuilder;
    private CategoryListInterface $categoryList;
    private CategoryFactory $categoryFactory;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CategoryRepository $categoryRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        CategoryListInterface $categoryList,
        CategoryFactory $categoryFactory

    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->categoryRepository = $categoryRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->categoryList = $categoryList;
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

    public function getCategoryId(string $urlKey) {
        $categoryFactory = $this->categoryFactory->create();
        $category = $categoryFactory->loadByAttribute('url_key', $urlKey);
        $categoryId = $category->getId();

        return $categoryId;
    }

    public function translate(string $categoryName, string $newName, int $storeId)
    {

  $category = $this->categoryFactory->create()->getCollection()
              ->addAttributeToFilter('name',$categoryName)->setPageSize(1)->getFirstItem();
                $category->setName($newName);
                $category->setStoreId($storeId);
                $category->save();  
    }

    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        
        $partyStoreId = $this->storeManager
        ->getStore("party_store_view_us")
        ->getId();

        $automotiveStoreId = $this->storeManager
        ->getStore("automotive_store_view_us")
        ->getId();

        $this->translate("Monte O Seu VOLT3", "Customize your VOLT3", $automotiveStoreId);
        $this->translate("Especificações técnicas do VOLT3", "Rain Gutter", $automotiveStoreId);

        $this->moduleDataSetup->getConnection()->endSetup();
    }
}