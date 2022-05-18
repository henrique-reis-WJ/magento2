<?php

namespace WebJump\ConfigNativePayment\Setup\Patch\Data;

use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Store\Model\StoreManagerInterface;

class SetNativePayment implements DataPatchInterface 
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

  public function setValueAutomotivo(string $dbPath, string $dbValue) {
    
    $automotivoWebsiteId = $this->storeManager // Gets automotivo Website Id by name
    ->getWebsite("automotivo")
    ->getId();

    $this->writer->save(
      $dbPath, // Here we specify the path stored in DB
      $dbValue, // Here we specify the value in DB
      "websites",
      $automotivoWebsiteId
    );
  }

  public function setValueFestas(string $dbPath, string $dbValue) {
    
    $festasWebsiteId = $this->storeManager // Gets festas Website Id by name
    ->getWebsite("festas")
    ->getId();

    $this->writer->save(
      $dbPath, // Here we specify the path stored in DB
      $dbValue, // Here we specify the value in DB
      "websites",
      $festasWebsiteId
    );
  }

  public function apply() 
  {
    $this->moduleDataSetup->getConnection()->startSetup();

    //Configuring Automotivo Money Payment
    $this->setValueAutomotivo("payment/checkmo/active", "1");
    $this->setValueAutomotivo("payment/checkmo/title", "Pagamento por Dinheiro");
    $this->setValueAutomotivo("payment/checkmo/order_status", "pending");
    $this->setValueAutomotivo("payment/checkmo/specificcountry", "BR");
    $this->setValueAutomotivo("payment/checkmo/sort_order", "0");

    //Configuring Automotivo Bank Transfer
    $this->setValueAutomotivo("payment/banktransfer/active", "1");
    $this->setValueAutomotivo("payment/banktransfer/title", "Pagamento por Transferência Bancária");
    $this->setValueAutomotivo("payment/banktransfer/order_status", "pending");
    $this->setValueAutomotivo("payment/banktransfer/specificcountry", "BR");
    $this->setValueAutomotivo("payment/banktransfer/sort_order", "1");

    //Configuring Festas Money Payment
    $this->setValueFestas("payment/checkmo/active", "1");
    $this->setValueFestas("payment/checkmo/title", "Pagamento por Dinheiro");
    $this->setValueFestas("payment/checkmo/order_status", "pending");
    $this->setValueFestas("payment/checkmo/specificcountry", "BR");
    $this->setValueFestas("payment/checkmo/sort_order", "0");

    //Configuring Automotivo Bank Transfer
    $this->setValueFestas("payment/banktransfer/active", "1");
    $this->setValueFestas("payment/banktransfer/title", "Pagamento por Transferência Bancária");
    $this->setValueFestas("payment/banktransfer/order_status", "pending");
    $this->setValueFestas("payment/banktransfer/specificcountry", "BR");
    $this->setValueFestas("payment/banktransfer/sort_order", "1");

    $this->moduleDataSetup->getConnection()->endSetup();
  }

  public function getAliases()
  {
      return [
      ];
  }
}