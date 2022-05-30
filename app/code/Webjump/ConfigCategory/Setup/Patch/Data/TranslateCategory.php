<?php 
namespace Webjump\ConfigCategory\Setup\Patch\Data;

use Magento\Catalog\Model\CategoryRepository;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Catalog\Api\CategoryListInterface;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Store\Model\StoreManagerInterface;

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
        CategoryFactory $categoryFactory,
        StoreManagerInterface $storeManager

    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->categoryRepository = $categoryRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->categoryList = $categoryList;
        $this->categoryFactory = $categoryFactory;
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

    public function getCategoryId(string $urlKey) {
        $categoryFactory = $this->categoryFactory->create();
        $category = $categoryFactory->loadByAttribute('url_key', $urlKey);
        $categoryId = $category->getId();

        return $categoryId;
    }

    public function translate(string $categoryName, string $newName, $storeId)
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

        // Automotivo
        $this->translate("Monte O Seu VOLT3", "Customize your VOLT3", $automotiveStoreId);
        $this->translate("Especificações técnicas do VOLT3", "VOLT3 Technical specifications", $automotiveStoreId);
        $this->translate("Monte O Seu VOLTSX", "Customize your VOLTSX", $automotiveStoreId);
        $this->translate("Especificações técnicas do VOLTSX", "VOLTSX Technical specifications", $automotiveStoreId);
        $this->translate("Monte O Seu ROADMASTER", "Customize your ROADMASTER", $automotiveStoreId);
        $this->translate("Especificações técnicas do ROADMASTER", "ROADMASTER Technical specifications", $automotiveStoreId);
        $this->translate("ACESSÓRIOS", "ACCESSORIES", $automotiveStoreId);
        $this->translate("Calha de Chuva", "Rain Gutter", $automotiveStoreId);
        $this->translate("Central Multimídia", "multimedia center", $automotiveStoreId);
        $this->translate("SUPORTE", "SUPPORT", $automotiveStoreId);

        // Festas
        $this->translate("DATAS COMEMORATIVAS", "COMMEMORATIVE DATES", $partyStoreId);
        $this->translate("Páscoa", "Easter", $partyStoreId);
        $this->translate("Natal", "Christmas", $partyStoreId);
        $this->translate("FESTA TEMÁTICA", "THEME PARTY", $partyStoreId);
        $this->translate("Carnaval", "Carnival", $partyStoreId);
        $this->translate("BALÕES E BEXIGAS", "BALLOONS AND BLADDERS", $partyStoreId);
        $this->translate("DECORAÇÃO", "DECORATION", $partyStoreId);

        $this->moduleDataSetup->getConnection()->endSetup();
    }
}