<?php 
namespace Webjump\WebsitesStore\Setup\Patch\Data;

use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\View\Design\Theme\ThemeProviderInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Api\WebsiteRepositoryInterface;
use Magento\Setup\Module\Setup;

class SetUrl implements DataPatchInterface
{
    public function methodName(Type $args): void
    {
        # code...
    }
}

?>