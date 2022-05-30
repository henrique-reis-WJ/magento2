<?php

namespace Webjump\ConfigLocaleAndLanguage\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use Webjump\ConfigLocaleAndLanguage\Model\LocaleAndLanguageWriter;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class LocaleAndLanguageWriterTest extends TestCase
{

    private $moduleDataSetup;
    private $writer;

public function testConstructor()
{
    $localeMock = $this->getMockBuilder("LocaleAndLanguageWriter")
    ->disableOriginalConstructor()
    ->getMock();

    $writerMock = $this->getMockBuilder("WriterInterface")->getMock();

    $moduleMock = $this->getMockBuilder("ModuleDataSetupInterface")->getMock();

    $localeMock->expects($this->once())
        ->with(
        $this->writer->equalTo($writerMock),
        $this->moduleDataSetup->equalTo($moduleMock)
        );
}

}