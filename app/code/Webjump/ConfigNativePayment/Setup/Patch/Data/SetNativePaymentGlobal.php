<?php

namespace WebJump\ConfigNativePayment\Setup\Patch\Data;

use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Store\Model\StoreManagerInterface;

class SetNativePaymentGlobal implements DataPatchInterface 
{
  //  public const SCOPE_INTERFACE

  private $moduleDataSetup;
  private $writer;
  private $storeManager;

  public function __construct(
    ModuleDataSetupInterface $moduleDataSetup,
    WriterInterface $writer,
    StoreManagerInterface $storeManager
  )
  {
    $this->moduleDataSetup = $moduleDataSetup;
    $this->writer = $writer;
    $this->storeManager = $storeManager;
  }

  public static function getDependencies()
  {
      return [
      ];
  }

  public function apply() 
  {
    $this->moduleDataSetup->getConnection()->startSetup();

    $automotivoWebsiteId = $this->storeManager
    ->getWebsite("automotivo")
    ->getId();

    $festasWebsiteId = $this->storeManager
    ->getWebsite("festas")
    ->getId();

    $this->writer->save(
      "payment/checkmo/active", 
      "1", 
      "websites",
      $automotivoWebsiteId
  );

    $this->moduleDataSetup->getConnection()->endSetup();
  }

  public function getAliases()
  {
      return [
      ];
  }
}