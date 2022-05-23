<?php
namespace Webjump\ConfigNativeShipping\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;

class SetNativeShipping implements DataPatchInterface
{
    private ModuleDataSetupInterface $moduleDataSetup;
    private WriterInterface $writer;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        WriterInterface $writer
        )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->writer = $writer;
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

    public function setShippingSettings(string $websiteId) {
       
     $this->writer->save (
        "carriers/tablerate/active",
        "1",
        "websites",
        $websiteId
    );

    $this->writer->save (
        "carriers/tablerate/title",
        "Amazon",
        "websites",
        $websiteId
    );

    $this->writer->save (
        "carriers/tablerate/name",
        "Table Rate",
        "websites",
        $websiteId
    );

    $this->writer->save (
        "carriers/tablerate/condition_name",
        "package_weight",
        "websites",
        $websiteId
    );
    
    $this->writer->save (
        "carriers/tablerate/include_virtual_price",
        "0",
        "websites",
        $websiteId
    );

    $this->writer->save (
        "carriers/tablerate/handling_fee",
        null,
        "websites",
        $websiteId
    );

    $this->writer->save (
        "carriers/tablerate/sallowspecific",
        "1",
        "websites",
        $websiteId
    );

    $this->writer->save (
        "carriers/tablerate/specificcountry",
        "BR,US",
        "websites",
        $websiteId
    );

    $this->writer->save (
        "carriers/tablerate/showmethod",
        "1",
        "websites",
        $websiteId
    );

    $this->writer->save (
        "carriers/tablerate/sort_order",
        "0",
        "websites",
        $websiteId
    );

    }

    public function apply() {
        $this->moduleDataSetup->getConnection()->startSetup();
        
        $this->setShippingSettings(1);

        $this->moduleDataSetup->getConnection()->endSetup();
    }
}