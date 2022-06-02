<?php
namespace Webjump\ConfigTranslateOrder\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Sales\Model\Order\StatusFactory;

class SetOrderTranslatedFraud implements DataPatchInterface
{
    private $moduleDataSetup;
    private $statusFactory; 

    function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        StatusFactory $statusFactory,
        StoreManagerInterface $storeManager
        )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->statusFactory = $statusFactory;
        $this->storeManager = $storeManager;
    }


    public static function getDependencies()
    {
        return [
        ];
    }
    
    public function getAliases()
    {
        return [
        ];
    }

    private function getStoreLabels(): array
    {
    $storeViewFestasId = $this->storeManager
        ->getStore("party_store_view_us")
        ->getId();
        
    $storeViewAutomotivoId = $this->storeManager
        ->getStore("automotive_store_view_us")
        ->getId();

      return [
         $storeViewFestasId => "Fraud", // Here we define Status Label
         $storeViewAutomotivoId => "Fraud" // Here we define Status Label
      ];
    }

    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $code = "fraud";
        $status = $this->statusFactory->create()->load($code);
        if(!$status->getStatus()) {
           // lançar exceção
        }
        $status->setData('store_labels', $this->getStoreLabels());
        $status->save();

        $this->moduleDataSetup->getConnection()->endSetup();
    }
}