<?php

namespace Webjump\ConfigLocaleAndLanguage\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use Webjump\ConfigLocaleAndLanguage\Model\LocaleAndLanguageWriter;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class LocaleAndLanguageWriterTest extends TestCase
{
public function setUp(): void
{
    $this->writerInterface = $this->createMock(WriterInterface::class);
    $this->moduleDataSetup = $this->createMock(ModuleDataSetupInterface::class);

    $this->localeWriter = new LocaleAndLanguageWriter(
        $this->writerInterface,
        $this->moduleDataSetup
    );
}

public function testSetLocaleAndLanguageBr()
{
    $this->moduleDataSetup
        ->expects($this->exactly(2))
        ->method("getConnection");

    /*
    $connection = $this->moduleDataSetup->getConnection();

    $connection
        ->expects($this->exactly(1))
        ->method("startSetup");
    
    $connection
        ->expects($this->exactly(1))
        ->method("endSetup");
    */

    $this->writerInterface
        ->expects($this->exactly(7))
        ->method('save')
        ->withConsecutive(
                [
            LocaleAndLanguageWriter::CURRENCY_ALLOW_PATH,
            LocaleAndLanguageWriter::CURRENCY,
            LocaleAndLanguageWriter::SCOPE,
            0
        ],
        [
            LocaleAndLanguageWriter::CURRENCY_DEFAULT_PATH,
            LocaleAndLanguageWriter::CURRENCY,
            LocaleAndLanguageWriter::SCOPE,
            0
        ],
        [
            LocaleAndLanguageWriter::CURRENCY_BASE_PATH,
            LocaleAndLanguageWriter::CURRENCY,
            LocaleAndLanguageWriter::SCOPE,
            0
        ],
        [
            LocaleAndLanguageWriter::LOCALE_CODE_PATH,
            LocaleAndLanguageWriter::LOCALE_CODE,
            LocaleAndLanguageWriter::SCOPE,
            0
        ],
        [
            LocaleAndLanguageWriter::LOCALE_WEIGHT_PATH,
            LocaleAndLanguageWriter::WEIGHT_UNIT,
            LocaleAndLanguageWriter::SCOPE,
            0
        ],
        [
            LocaleAndLanguageWriter::LOCALE_TIMEZONE_PATH,
            LocaleAndLanguageWriter::TIMEZONE,
            LocaleAndLanguageWriter::SCOPE,
            0
        ],
        [
            LocaleAndLanguageWriter::COUNTRY_DEFAULT_PATH,
            LocaleAndLanguageWriter::COUNTRY,
            LocaleAndLanguageWriter::SCOPE,
            0
        ],
        );

        $result = $this->localeWriter->setLocaleAndLanguageBr(0);
        $this->assertNull($result);
}

}