<?php

namespace Webjump\ConfigLocaleAndLanguage\Test\Unit\Setup\Patch\Data;

use Magento\Store\Api\Data\StoreInterface;
use PHPUnit\Framework\TestCase;
use Webjump\ConfigLocaleAndLanguage\Model\LocaleAndLanguageWriter;
use Magento\Store\Model\StoreManagerInterface;
use Webjump\ConfigLocaleAndLanguage\Setup\Patch\Data\ConfigPartyBrLocale;

use function PHPUnit\Framework\assertEquals;

class ConfigPartyBrLocaleTest extends TestCase
{
    public function setUp(): void
    {
        $this->storeInterfaceMock = $this->createMock(StoreInterface::class);

        $this->localeWriterMock = $this->createMock(LocaleAndLanguageWriter::class);
        $this->storeManagerInterfaceMock = $this->createMock(StoreManagerInterface::class);

        $this->configPartyBrLocale = new ConfigPartyBrLocale(
            $this->storeManagerInterfaceMock,
            $this->localeWriterMock
        );
    }

    public function testApply()
    {
        $storeId = 1;

        $this->storeManagerInterfaceMock
        ->expects($this->once())
        ->method("getStore")
        ->with("festas_store_view_pt")
        ->willReturn($this->storeInterfaceMock);

        $this->storeInterfaceMock
        ->expects($this->once())
        ->method("getId")
        ->willReturn($storeId);

        $this->localeWriterMock->expects($this->once())
        ->method("setLocaleAndLanguageBr")
        ->with($storeId);

        $this->configPartyBrLocale->apply();
    }

    public function testGetDependencies()
    {
        $array = [];
        $returned = $this->configPartyBrLocale->getDependencies();

        assertEquals($array, $returned);
    }

    public function testGetAliases()
    {
        $array = [];
        $returned = $this->configPartyBrLocale->getAliases();

        assertEquals($array, $returned);
    }
}
