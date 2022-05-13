<?php
namespace Webjump\CreateAttributeSets\Setup\Patch\Data;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class CreateSizeCustomAttribute implements DataPatchInterface
{
    private $moduleDataSetup;
    private $eavSetupFactory;

    public function __construct(
        EavSetupFactory $eavSetupFactory,
        ModuleDataSetupInterface $moduleDataSetup
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public static function getDependencies()
    {
        return [
            \Webjump\CreateAttributeSets\Setup\Patch\Data\CreatePartyAttributeSet::class
        ];
    }

    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $eavSetup = $this->eavSetupFactory->create(
            ['setup' => $this->moduleDataSetup]
        );
        
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'size',
            [
                'attribute_set' => 'Party_Attribute_Set',
                'type' => 'varchar',
                'comparable' => '0',
                'filterable_in_search' => '0',
                'filterable' => '0',
                'label' => 'Size',
                'input' => 'text',
                'is_filterable_in_grid' => '0',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_WEBSITE,
                'visible' => '1',
                'required' => '0',
                'user_defined' => '1',
                'unique' => '0',
                'visible_on_front' => '1',
                'searchable' => '0',
                'visible_in_advanced_search' => '0'
            ]
        );

        $entityTypeId = $eavSetup->getEntityTypeId(
            \Magento\Catalog\Model\Product::ENTITY
        );
        
        $attributeSetId = $eavSetup->getAttributeSet(
            $entityTypeId, 
            'Party_Attribute_Set', 
            'attribute_set_id'
        );

        $attributeId = $eavSetup->getAttributeId(
            $entityTypeId,
            'size'
        );

        $eavSetup->addAttributeToSet(
            $entityTypeId,
            $attributeSetId,
            'General',
            $attributeId,
            null
        );

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    public function getAliases()
    {
        return [
        ];
    }
}