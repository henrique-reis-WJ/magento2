<?php

namespace WebJump\ConfigNativePayment\Setup\Patch\Data;

use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Store\Model\StoreManagerInterface;

class SetNativePayment implements DataPatchInterface 
{

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

  public function setValueAutomotivoUS(string $dbPath, string $dbValue) {
    
    $automotivoStoreUsId = $this->storeManager // Gets automotivo storeview Id by name
    ->getStore("automotive_store_view_us")
    ->getId();

    $this->writer->save(
      $dbPath, // Here we specify the path stored in DB
      $dbValue, // Here we specify the value in DB
      "stores",
      $automotivoStoreUsId
    );
  }

  public function setValueAutomotivoBR(string $dbPath, string $dbValue) {
    
    $automotivoStoreBrId = $this->storeManager // Gets automotivo storeview Id by name
    ->getStore("automotivo_store_view_pt")
    ->getId();

    $this->writer->save(
      $dbPath, // Here we specify the path stored in DB
      $dbValue, // Here we specify the value in DB
      "stores",
      $automotivoStoreBrId
    );
  }

  public function setValueFestasUS(string $dbPath, string $dbValue) {
    
    $festasStoreUsId = $this->storeManager // Gets festas storeview Id by name
    ->getStore("party_store_view_us")
    ->getId();

    $this->writer->save(
      $dbPath, // Here we specify the path stored in DB
      $dbValue, // Here we specify the value in DB
      "stores",
      $festasStoreUsId
    );
  }

  public function setValueFestasBR(string $dbPath, string $dbValue) {
    
    $festasStoreBrId = $this->storeManager // Gets festas storeview Id by name
    ->getStore("festas_store_view_pt")
    ->getId();

    $this->writer->save(
      $dbPath, // Here we specify the path stored in DB
      $dbValue, // Here we specify the value in DB
      "stores",
      $festasStoreBrId
    );
  }

  public function apply() 
  {
    $this->moduleDataSetup->getConnection()->startSetup();

    //Configuring Automotivo Money Payment US
    $this->setValueAutomotivoUS("payment/checkmo/active", "1");
    $this->setValueAutomotivoUS("payment/checkmo/title", "Money Payment");
    $this->setValueAutomotivoUS("payment/checkmo/order_status", "pending");
    $this->setValueAutomotivoUS("payment/checkmo/specificcountry", "US");
    $this->setValueAutomotivoUS("payment/checkmo/sort_order", "0");

    //Configuring Automotivo Money Payment BR
    $this->setValueAutomotivoBR("payment/checkmo/active", "1");
    $this->setValueAutomotivoBR("payment/checkmo/title", "Pagamento em Dinheiro");
    $this->setValueAutomotivoBR("payment/checkmo/order_status", "pending");
    $this->setValueAutomotivoBR("payment/checkmo/specificcountry", "BR");
    $this->setValueAutomotivoBR("payment/checkmo/sort_order", "0");

    //Configuring Automotivo Bank Transfer US
    $this->setValueAutomotivoUS("payment/banktransfer/active", "1");
    $this->setValueAutomotivoUS("payment/banktransfer/title", "Bank Transfer Payment");
    $this->setValueAutomotivoUS("payment/banktransfer/order_status", "pending");
    $this->setValueAutomotivoUS("payment/banktransfer/specificcountry", "US");
    $this->setValueAutomotivoUS("payment/banktransfer/sort_order", "1");
    $this->setValueAutomotivoUS("payment/banktransfer/instructions", "
    Bank account name: WebjumpAutomotive
    Bank account number: 99999
    Bank name: Webjump
    Bank address: California - United States");

    //Configuring Automotivo Bank Transfer BR
    $this->setValueAutomotivoBR("payment/banktransfer/active", "1");
    $this->setValueAutomotivoBR("payment/banktransfer/title", "Pagamento por Transferência Bancária");
    $this->setValueAutomotivoBR("payment/banktransfer/order_status", "pending");
    $this->setValueAutomotivoBR("payment/banktransfer/specificcountry", "BR");
    $this->setValueAutomotivoBR("payment/banktransfer/sort_order", "1");
    $this->setValueAutomotivoBR("payment/banktransfer/instructions", "
    Nome da conta do banco: AutomotivoWebjump
    Número da conta do banco: 99999
    Nome do banco: Webjump
    Endereço do banco: São Paulo - SP");

    //Configuring Festas Money Payment US
    $this->setValueFestasUS("payment/checkmo/active", "1");
    $this->setValueFestasUS("payment/checkmo/title", "Money Payment");
    $this->setValueFestasUS("payment/checkmo/order_status", "pending");
    $this->setValueFestasUS("payment/checkmo/specificcountry", "US");
    $this->setValueFestasUS("payment/checkmo/sort_order", "0");

    //Configuring Festas Money Payment BR
    $this->setValueFestasBR("payment/checkmo/active", "1");
    $this->setValueFestasBR("payment/checkmo/title", "Pagamento por Dinheiro");
    $this->setValueFestasBR("payment/checkmo/order_status", "pending");
    $this->setValueFestasBR("payment/checkmo/specificcountry", "BR");
    $this->setValueFestasBR("payment/checkmo/sort_order", "0");

    //Configuring Festas Bank Transfer US
    $this->setValueFestasUS("payment/banktransfer/active", "1");
    $this->setValueFestasUS("payment/banktransfer/title", "Bank Transfer Payment");
    $this->setValueFestasUS("payment/banktransfer/order_status", "pending");
    $this->setValueFestasUS("payment/banktransfer/specificcountry", "US");
    $this->setValueFestasUS("payment/banktransfer/sort_order", "1");
    $this->setValueFestasUS("payment/banktransfer/instructions", "
    Bank account name: WebjumpAutomotive
    Bank account number: 99999
    Bank name: Webjump
    Bank address: California - United States");

    //Configuring Festas Bank Transfer BR
    $this->setValueFestasBR("payment/banktransfer/active", "1");
    $this->setValueFestasBR("payment/banktransfer/title", "Pagamento por Transferência Bancária");
    $this->setValueFestasBR("payment/banktransfer/order_status", "pending");
    $this->setValueFestasBR("payment/banktransfer/specificcountry", "BR");
    $this->setValueFestasBR("payment/banktransfer/sort_order", "1");
    $this->setValueFestasBR("payment/banktransfer/instructions", "
    Nome da conta do banco: FestasWebjump
    Número da conta do banco: 99999
    Nome do banco: Webjump
    Endereço do banco: São Paulo - SP");
    
    $this->moduleDataSetup->getConnection()->endSetup();
  }

  public function getAliases()
  {
      return [
      ];
  }
}