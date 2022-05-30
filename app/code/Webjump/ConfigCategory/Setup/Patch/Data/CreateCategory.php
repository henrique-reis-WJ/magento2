<?php 
namespace Webjump\ConfigCategory\Setup\Patch\Data;

use Magento\Catalog\Model\CategoryFactory;
use Magento\Catalog\Model\CategoryRepository;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class CreateCategory implements DataPatchInterface
{
    private ModuleDataSetupInterface $moduleDataSetup;
    private CategoryRepository $categoryRepository;
    private CategoryFactory $categoryFactory;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CategoryFactory $categoryFactory,
        CategoryRepository $categoryRepository
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->categoryFactory = $categoryFactory;
        $this->categoryRepository = $categoryRepository;
    }

    public function createCategories(array $categories): void
    {
        foreach ($categories as $item) {
            $category = $this->categoryFactory->create();
            $category
                ->setData($item)
                ->setAttributeSetId($category->getDefaultAttributeSetId());
            $this->categoryRepository->save($category);
        }
    }

    public function categoryRoot(string $name, string $urlKey): array
    {
        $categories = [];

        $categories[] = [
            'name' => $name,
            'url_key' => $urlKey,
            'is_active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'parent_id' => '1'
        ];

        return $categories;
    }

    public function subCategories(string $name, string $urlKey, string $rootKey): array
    {
        $category = $this->categoryFactory->create();
        $parentCategory = $category->loadByAttribute('url_key', $rootKey);
        $categories = [];

        $categories [] = [
            'name' => $name,
            'url_key' => $urlKey,
            'is_active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'parent_id' => $parentCategory->getId()
        ];
        return $categories;
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

        $this->createCategories($this->categoryRoot('Automotivo', 'automotivo'));
        //Categoria VOLT3
        
        $this->createCategories($this->subCategories('VOLT3', 'volt3', 'automotivo')); // Categoria, URLKey, ParentCategory
        $this->createCategories($this->subCategories('Monte O Seu VOLT3', 'monte-o-seu3', 'volt3'));
        $this->createCategories($this->subCategories('Especificações técnicas do VOLT3', 'especificacoes-tecnicas3', 'volt3'));
        
        //Categoria VOLT SX

        $this->createCategories($this->subCategories('VOLT SX', 'voltsx', 'automotivo')); // Categoria, URLKey, ParentCategory
        $this->createCategories($this->subCategories('Monte O Seu VOLTSX', 'monte-o-seusx', 'voltsx'));
        $this->createCategories($this->subCategories('Especificações técnicas do VOLTSX', 'especificacoes-tecnicassx', 'voltsx'));

        //Categoria ROADMASTER

        $this->createCategories($this->subCategories('ROADMASTER', 'roadmaster', 'automotivo')); // Categoria, URLKey, ParentCategory
        $this->createCategories($this->subCategories('Monte O Seu ROADMASTER', 'monte-o-seuroad', 'roadmaster'));
        $this->createCategories($this->subCategories('Especificações técnicas do ROADMASTER', 'especificacoes-tecnicasroad', 'roadmaster'));


        //Categoria ACCESSORIES

        $this->createCategories($this->subCategories('ACESSÓRIOS', 'acessorios', 'automotivo')); // Categoria, URLKey, ParentCategory
        $this->createCategories($this->subCategories('Calha de Chuva', 'calha', 'accessories'));
        $this->createCategories($this->subCategories('Central Multimídia', 'central', 'accessories'));
        
        //Categoria SUPPORT

        $this->createCategories($this->subCategories('SUPORTE', 'suporte', 'automotivo'));

        //Root Category Festas
        
        $this->createCategories($this->categoryRoot('Festas', 'festas'));

        //Categoria DATAS COMEMORATIVAS
        
        $this->createCategories($this->subCategories('DATAS COMEMORATIVAS', 'datasComemorativas', 'festas')); // Categoria, URLKey, ParentCategory
        $this->createCategories($this->subCategories('Páscoa', 'pascoa', 'datasComemorativas'));
        $this->createCategories($this->subCategories('Natal', 'natal', 'datasComemorativas'));

        //Categoria Festa Temática

        $this->createCategories($this->subCategories('FESTA TEMÁTICA', 'festaTematica', 'festas')); // Categoria, URLKey, ParentCategory
        $this->createCategories($this->subCategories('Halloween', 'halloween', 'festaTematica'));
        $this->createCategories($this->subCategories('Carnaval', 'carnaval', 'festaTematica'));

        // Categoria Balões e Bexigas

        $this->createCategories($this->subCategories('BALÕES E BEXIGAS', 'bexigas', 'festas')); // Categoria, URLKey, ParentCategory

        // Categoria DECORAÇÃO

        $this->createCategories($this->subCategories('DECORAÇÃO', 'decoracao', 'festas')); // Categoria, URLKey, ParentCategory

        $this->moduleDataSetup->getConnection()->endSetup();
    }
}