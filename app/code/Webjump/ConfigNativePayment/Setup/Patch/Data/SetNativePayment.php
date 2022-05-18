<?php

namespace WebJump\ConfigNativePayment\Setup\Patch\Data;

use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class SetNativePayment implements DataPatchInterface 
{
  //  public const SCOPE_INTERFACE

  private $moduleDataSetup;
  private $writer;
  private $scopeConfig;

  public function __construct(
    ModuleDataSetupInterface $moduleDataSetup,
    WriterInterface $writer,
    ScopeConfigInterface $scopeConfig
  )
  {
    $this->moduleDataSetup = $moduleDataSetup;
    $this->writer = $writer;
    $this->scopeConfig = $scopeConfig;
  }

  public static function getDependencies()
  {
      return [
      ];
  }

  public function apply() 
  {

  }

  public function getAliases()
  {
      return [
      ];
  }
}