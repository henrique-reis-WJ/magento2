<?php

namespace Webjump\ConfigNativeShipping\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Store\Model\StoreManagerInterface;

class SetNativeShipping implements DataPatchInterface
{
    private ModuleDataSetupInterface $moduleDataSetup;
    private WriterInterface $writer;
    private StoreManagerInterface $storeManager;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        WriterInterface $writer,
        StoreManagerInterface $storeManager
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->writer = $writer;
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

    public function setShippingSettingsWebsite(string $websiteCode)
    {

        $websiteGetId = $this->storeManager
        ->getWebsite($websiteCode)
        ->getId();

        $this->writer->save(
            "general/country/allow",
            "BR,US",
            "websites",
            $websiteGetId
        );

        $this->writer->save(
            "carriers/tablerate/active",
            "1",
            "websites",
            $websiteGetId
        );

        $this->writer->save(
            "carriers/tablerate/condition_name",
            "package_weight",
            "websites",
            $websiteGetId
        );

        $this->writer->save(
            "carriers/tablerate/include_virtual_price",
            "0",
            "websites",
            $websiteGetId
        );

        $this->writer->save(
            "carriers/tablerate/handling_fee",
            null,
            "websites",
            $websiteGetId
        );

        $this->writer->save(
            "carriers/tablerate/sallowspecific",
            "1",
            "websites",
            $websiteGetId
        );

        $this->writer->save(
            "carriers/tablerate/specificcountry",
            "BR,US",
            "websites",
            $websiteGetId
        );

        $this->writer->save(
            "carriers/tablerate/showmethod",
            "1",
            "websites",
            $websiteGetId
        );

        $this->writer->save(
            "carriers/tablerate/sort_order",
            "0",
            "websites",
            $websiteGetId
        );

        $this->writer->save(
            "carriers/flatrate/active",
            "0",
            "websites",
            $websiteGetId
        );
    }

    public function setShippingStore(string $storeViewCode, string $language)
    {

        $StoreViewGetId = $this->storeManager
        ->getStore($storeViewCode)
        ->getId();

        if ($language == "br") {
            $this->writer->save(
                "carriers/tablerate/title",
                "Correios",
                "stores",
                $StoreViewGetId
            );

            $this->writer->save(
                "carriers/tablerate/name",
                "Taxa de Tabela",
                "stores",
                $StoreViewGetId
            );

            $this->writer->save(
                "carriers/tablerate/specificerrmsg",
                "Este método de envio não está disponível. Para usar este método de envio, entre em contato conosco.",
                "stores",
                $StoreViewGetId
            );
        } elseif ($language == "en") {
            $this->writer->save(
                "carriers/tablerate/title",
                "Amazon",
                "stores",
                $StoreViewGetId
            );

            $this->writer->save(
                "carriers/tablerate/name",
                "Table Rate",
                "stores",
                $StoreViewGetId
            );
        }
    }

    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        // Setting Websites Default Config
        $this->setShippingSettingsWebsite("automotivo");
        $this->setShippingSettingsWebsite("festas");

        //Setting StoreView Default Config
        $this->setShippingStore("automotivo_store_view_pt", "br");
        $this->setShippingStore("automotive_store_view_us", "en");
        $this->setShippingStore("festas_store_view_pt", "br");
        $this->setShippingStore("party_store_view_us", "en");

        $this->moduleDataSetup->getConnection()->endSetup();
    }
}
