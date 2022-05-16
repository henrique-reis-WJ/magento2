<?php
namespace Webjump\ConfigLocaleAndLanguage;

use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class LocaleAndLanguageWriter
{
    const CURRENCY_DEFAULT_PATH = "currency/options/default";
    const CURRENCY_ALLOW_PATH = "currency/options/allow";
    const CURRENCY_BASE_PATH = "currency/options/base";
    const LOCALE_CODE_PATH = "general/locale/code";
    const LOCALE_WEIGHT_PATH = "general/locale/weight_unit";
    const LOCALE_TIMEZONE_PATH = "general/locale/timezone";
    const COUNTRY_DEFAULT_PATH = "general/country/default";

    const COUNTRY = "BR";
    const CURRENCY = "BRL";
    const LOCALE_CODE = "pt_BR";
    const WEIGHT_UNIT = "kgs";
    const TIMEZONE = "America/Sao_Paulo";

    const COUNTRY_US = "US";
    const CURRENCY_US = "USD";
    const LOCALE_CODE_US = "en_US";
    const WEIGHT_UNIT_US = "lbs";
    const TIMEZONE_US = "America/Los_Angeles";

    const SCOPE = "stores";

    private $moduleDataSetup;
    private $writer;

    function __construct(
        WriterInterface $writer,
        ModuleDataSetupInterface $moduleDataSetup
    )
    {
        $this->writer = $writer;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    public function setLocaleAndLanguageBr($storeId)
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $this->writer->save(
            self::CURRENCY_ALLOW_PATH,
            self::CURRENCY,
            self::SCOPE,
            $storeId
        );
    
        $this->writer->save(
            self::CURRENCY_DEFAULT_PATH,
            self::CURRENCY,
            self::SCOPE,
            $storeId
        );
    
        $this->writer->save(
            self::CURRENCY_BASE_PATH,
            self::CURRENCY,
            self::SCOPE,
            $storeId
        );
    
        $this->writer->save(
            self::LOCALE_CODE_PATH,
            self::LOCALE_CODE,
            self::SCOPE,
            $storeId
        );
    
        $this->writer->save(
            self::LOCALE_WEIGHT_PATH,
            self::WEIGHT_UNIT,
            self::SCOPE,
            $storeId
        );
    
        $this->writer->save(
            self::LOCALE_TIMEZONE_PATH,
            self::TIMEZONE,
            self::SCOPE,
            $storeId
        );
    
        $this->writer->save(
            self::COUNTRY_DEFAULT_PATH,
            self::COUNTRY,
            self::SCOPE,
            $storeId
        );

        $this->moduleDataSetup->getConnection()->endSetup();
    }
    
    public function setLocaleAndLanguageUs($storeId)
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $this->writer->save(
            self::CURRENCY_ALLOW_PATH,
            self::CURRENCY_US,
            self::SCOPE,
            $storeId
        );
    
        $this->writer->save(
            self::CURRENCY_DEFAULT_PATH,
            self::CURRENCY_US,
            self::SCOPE,
            $storeId
        );
    
        $this->writer->save(
            self::CURRENCY_BASE_PATH,
            self::CURRENCY_US,
            self::SCOPE,
            $storeId
        );
    
        $this->writer->save(
            self::LOCALE_CODE_PATH,
            self::LOCALE_CODE_US,
            self::SCOPE,
            $storeId
        );
    
        $this->writer->save(
            self::LOCALE_WEIGHT_PATH,
            self::WEIGHT_UNIT_US,
            self::SCOPE,
            $storeId
        );
    
        $this->writer->save(
            self::LOCALE_TIMEZONE_PATH,
            self::TIMEZONE_US,
            self::SCOPE,
            $storeId
        );
    
        $this->writer->save(
            self::COUNTRY_DEFAULT_PATH,
            self::COUNTRY_US,
            self::SCOPE,
            $storeId
        );
        
        $this->moduleDataSetup->getConnection()->endSetup();
    }
}
