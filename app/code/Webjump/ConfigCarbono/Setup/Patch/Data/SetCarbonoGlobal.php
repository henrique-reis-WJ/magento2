<?php
namespace Webjump\ConfigCarbono\Setup\Patch\Data;

use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\View\Design\Theme\ThemeProviderInterface;
use Magento\Setup\Module\Setup;

class SetCarbonoGlobal implements DataPatchInterface
{
    const THEME_PATH = "design/theme/theme_id";
    private $moduleDataSetup;
    private $writer;
    private $themeProvider;

    function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        WriterInterface $writer,
        ThemeProviderInterface $themeProvider
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->writer = $writer;
        $this->themeProvider = $themeProvider;
    }

    public static function getDependencies()
    {
        return [
        ];
    }

    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $themeId = $this->themeProvider
            ->getThemeByFullPath("frontend/Webjump/theme-frontend-carbono")
            ->getId();

        $this->writer->save(self::THEME_PATH,$themeId);
        
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    public function getAliases()
    {
        return [
        ];
    }
}