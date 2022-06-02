<?php
namespace Webjump\ConfigTranslateOrder\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Sales\Model\Order\StatusFactory;

class SetOrderTranslated implements DataPatchInterface
{
    private $moduleDataSetup;
    private $statusFactory; 

    function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        StatusFactory $statusFactory
        )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->statusFactory = $statusFactory;
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
      return [
         'store_view_id_1' => 'Label 1',
         'store_view_id_2' => 'Label 2',
      ];
    }

    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $code = 'status_code';
        $status = $this->statusFactory->create()->load($code);
        if(!$status->getStatus()) {
           // lançar exceção
        }
        $status->setData('store_labels', $this->getStoreLabels());
        $status->save();
        
        $this->moduleDataSetup->getConnection()->endSetup();
    }
}