<?php 

namespace Webjump\ConfigCategory\Unit\Test\Setup\Patch\Data;

use PHPUnit\Framework\TestCase;
use Webjump\ConfigCategory\Setup\Patch\Data\CreateCategory;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Catalog\Model\CategoryRepository;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Catalog\Model\Category;

class CreateCategoryTest extends TestCase {

    protected CreateCategory $category;
    protected $expectedCount;

    public function setUp() : void
    {
        $this->moduleDataSetupMock = $this->createMock(
            ModuleDataSetupInterface::class
        );
        $this->categoryFactoryMock = $this->createMock(
            CategoryFactory::class
        );
        $this->categoryRepositoryMock = $this->createMock(
            CategoryRepository::class
        );
        $this->category = new CreateCategory(
            $this->moduleDataSetupMock,
            $this->categoryFactoryMock,
            $this->categoryRepositoryMock
        );
        $this->adapterInterfaceMock = $this->createMock(
            AdapterInterface::class
        );
        $this->categoryModelMock = $this->getMockBuilder(
            Category::class
        )
        ->disableOriginalConstructor()
        ->addMethods([
            "setAttributeSetId"
        ])
        ->onlyMethods([
            "setData",
            "getDefaultAttributeSetId",
            "loadByAttribute",
            "getId"
            ])
        ->getMock();

    }

    public function testConstructorClass()
    {
        $this->assertInstanceOf(
            CreateCategory::class,
            $this->category
        );
    }

    public function testApply()
    {
        $defaultSetId = 1;
        $defaultId = "4";

        $this->moduleDataSetupMock->expects($this->exactly(2))
            ->method("getConnection")
            ->willReturn($this->adapterInterfaceMock);
        
        $this->adapterInterfaceMock->expects($this->once())
            ->method("startSetup")
            ->willReturnSelf();

        $this->adapterInterfaceMock->expects($this->once())
            ->method("endSetup")
            ->willReturnSelf();
        
        $this->categoryFactoryMock->expects($this->exactly(14))
            ->method("create")
            ->willReturn($this->categoryModelMock);
        
        $this->categoryModelMock->expects($this->exactly(13))
            ->method("setData")
            ->withConsecutive(
                ["Automotivo"],
                ["automotivo"],
                [true],
                [true],
                [true],
                ["1"],
                ['VOLT3'],
                ['volt3'],
                [true],
                [true],
                [true],
                ['PRODUCTS_AND_PAGE'],
                [$defaultId]
            )
            ->willReturnSelf();

        $this->categoryModelMock->expects($this->exactly(13))
            ->method("getDefaultAttributeSetId")
            ->willReturn($defaultSetId);
        
        $this->categoryModelMock->expects($this->exactly(13))
            ->method("setAttributeSetId")
            ->with($defaultSetId)
            ->willReturnSelf();
        
        $this->categoryRepositoryMock->expects($this->exactly(13))
            ->method("save")
            ->with($this->categoryModelMock)
            ->willReturn($this->categoryModelMock);    
        
        $this->categoryModelMock->expects($this->exactly(1))
            ->method("loadByAttribute")
            ->withConsecutive(
                ['url_key', 'automotivo'],
                )
            ->willReturn($this->categoryModelMock);

        $this->categoryModelMock->expects($this->exactly(1))
            ->method("getId")
            ->willReturn($defaultId);

        $this->category->apply();

    }
}