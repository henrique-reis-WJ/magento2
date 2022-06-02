<?php

namespace Webjump\ConfigAttributeAndOptionsTranslation\Setup\Patch\Data;

use Magento\Store\Model\StoreManagerInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Catalog\Api\ProductAttributeRepositoryInterface;
use Magento\Eav\Api\Data\AttributeFrontendLabelInterfaceFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class ConfigAttributeOptionsTranslation implements DataPatchInterface
{
    private $storeManager;
    private $eavSetupFactory;
    private $productAttributeRepository;
    private $attributeFrontendLabel;
    private $moduleDataSetup;

    public function __construct(
        StoreManagerInterface $storeManager,
        EavSetupFactory $eavSetupFactory,
        ProductAttributeRepositoryInterface $productAttributeRepository,
        AttributeFrontendLabelInterfaceFactory $attributeFrontendLabel,
        ModuleDataSetupInterface $moduleDataSetup
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->storeManager = $storeManager;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->productAttributeRepository = $productAttributeRepository;
        $this->attributeFrontendLabel = $attributeFrontendLabel;
    }

    public function getAliases()
    {
        return [
        ];
    }

    public static function getDependencies()
    {
        return [
            \Webjump\CreateAttributeSets\Setup\Patch\Data\AddColorAttributeToSets::class
        ];
    }

    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $eavSetup = $this->eavSetupFactory->create(
            ['setup' => $this->moduleDataSetup]
        );

        $festasPtStoreId = $this->storeManager
        ->getStore("festas_store_view_pt")
        ->getId();

        $automotivoPtStoreId = $this->storeManager
        ->getStore("automotivo_store_view_pt")
        ->getId();

        $festasUsStoreId = $this->storeManager
        ->getStore("party_store_view_us")
        ->getId();

        $automotivoUsStoreId = $this->storeManager
        ->getStore("automotive_store_view_us")
        ->getId();

        $entityTypeId = $eavSetup->getEntityTypeId(
            \Magento\Catalog\Model\Product::ENTITY
        );

        $attributeId = $eavSetup->getAttributeId(
            $entityTypeId,
            'color'
        );

        $attribute = $this->productAttributeRepository->get($attributeId);
        
        $whiteOption = $attribute->getSource()->getOptionId("White");
        $blackOption = $attribute->getSource()->getOptionId("Black");
        $redOption = $attribute->getSource()->getOptionId("Red");
        $blueOption = $attribute->getSource()->getOptionId("Blue");
        $yellowOption = $attribute->getSource()->getOptionId("Yellow");
        $greenOption = $attribute->getSource()->getOptionId("Green");
        $orangeOption = $attribute->getSource()->getOptionId("Orange");
        $pinkOption = $attribute->getSource()->getOptionId("Pink");
        
        $options = [
            'attribute_id' => $attributeId,
            'values' => [
                $whiteOption => [
                    $festasPtStoreId => "Branco",
                    $automotivoPtStoreId => "Branco",
                    $festasUsStoreId => "White",
                    $automotivoUsStoreId => "White"
                ],
                $blackOption => [
                    $festasPtStoreId => "Preto",
                    $automotivoPtStoreId => "Preto",
                    $festasUsStoreId => "Black",
                    $automotivoUsStoreId => "Black"
                ],
                $redOption => [
                    $festasPtStoreId => "Vermelho",
                    $automotivoPtStoreId => "Vermelho",
                    $festasUsStoreId => "Red",
                    $automotivoUsStoreId => "Red"
                ],
                $blueOption => [
                    $festasPtStoreId => "Azul",
                    $automotivoPtStoreId => "Azul",
                    $festasUsStoreId => "Blue",
                    $automotivoUsStoreId => "Blue"
                ],
                $yellowOption => [
                    $festasPtStoreId => "Amarelo",
                    $automotivoPtStoreId => "Amarelo",
                    $festasUsStoreId => "Yellow",
                    $automotivoUsStoreId => "Yellow"
                ],
                $greenOption => [
                    $festasPtStoreId => "Verde",
                    $automotivoPtStoreId => "Verde",
                    $festasUsStoreId => "Green",
                    $automotivoUsStoreId => "Green"
                ],
                $orangeOption => [
                    $festasPtStoreId => "Laranja",
                    $automotivoPtStoreId => "Laranja",
                    $festasUsStoreId => "Orange",
                    $automotivoUsStoreId => "Orange"
                ],
                $pinkOption => [
                    $festasPtStoreId => "Rosa",
                    $automotivoPtStoreId => "Rosa",
                    $festasUsStoreId => "Pink",
                    $automotivoUsStoreId => "Pink"
                ]
                ]
        ];

        $attribute->setData($options);


        $this->moduleDataSetup->getConnection()->endSetup();
    }
}