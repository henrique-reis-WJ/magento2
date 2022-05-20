<?php

namespace Webjump\ConfigNativePayment\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Webjump\ConfigNativePayment\SetPaymentGlobal;

class SetPaymentMethodStores implements DataPatchInterface
{
    private $moduleDataSetup;
    private $storePaymentSet;


    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        SetPaymentGlobal $storePaymentSet
    )

    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->storePaymentSet = $storePaymentSet;

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

        $this->storePaymentSet->setGlobalSettings("automotivo");
        $this->storePaymentSet->setGlobalSettings("festas");

        $this->storePaymentSet->setPaymentMoney("automotivo_store_view_pt", "br");
        $this->storePaymentSet->setPaymentBankTransfer("automotivo_store_view_pt", "br");

        $this->storePaymentSet->setPaymentMoney("automotive_store_view_us", "en");
        $this->storePaymentSet->setPaymentBankTransfer("automotive_store_view_us", "en");

        $this->storePaymentSet->setPaymentMoney("festas_store_view_pt", "br");
        $this->storePaymentSet->setPaymentBankTransfer("festas_store_view_pt", "br");

        $this->storePaymentSet->setPaymentMoney("party_store_view_us", "en");
        $this->storePaymentSet->setPaymentBankTransfer("party_store_view_us", "en");

        $this->moduleDataSetup->getConnection()->endSetup();
    }
}