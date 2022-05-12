<?php 
namespace Webjump\ConfigCategories\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Model\Category;
use Magento\Setup\Module\Setup;

class SetCategories implements DataPatchInterface
{
    private $moduleDataSetup;
    protected $_category;

    function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        \Magento\Catalog\Model\Category $category
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->_category = $category;
    }

    public static function getDependencies()
    {
        return [];
    }

    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $category = $this->_category;
        $category->setName('MageCheck');
        $category->setParentId(0); 
        $category->setIsActive(true);
        $category->setCustomAttributes([
        'description' => 'category example',
        'meta_title' => 'category example',
        'meta_keywords' => '',
        'meta_description' => '',
        ]);
        $this->_categoryRepository->save($category);

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    public function getAliases()
    {
        return [];
    }
}
