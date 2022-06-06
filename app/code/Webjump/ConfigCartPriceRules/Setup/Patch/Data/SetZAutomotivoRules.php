<?php
namespace Webjump\ConfigCartPriceRules\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\SalesRule\Model\RuleFactory;
use Magento\Framework\App\State;
use Magento\Store\Model\StoreManagerInterface;

class SetZAutomotivoRules implements DataPatchInterface
{
    private ModuleDataSetupInterface $moduleDataSetup;
    private RuleFactory $ruleFactory;
    private State $state;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        RuleFactory $ruleFactory,
        State $state,
        StoreManagerInterface $storeManager
        )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->ruleFactory = $ruleFactory;
        $this->state = $state;
        $this->storeManager = $storeManager;
    }

    public function getAliases()
    {
        return [
        ];
    }

    public static function getDependencies()
    {
        return [
        ];
    }

    public function createRuleCustomerGroup(string $name, string $description, string $discount, int $customerGroupId, int $websiteId){
        $storeViewUSFestasId = $this->storeManager
        ->getStore("party_store_view_us")
        ->getId();
        
        $storeViewUSAutomotivoId = $this->storeManager
        ->getStore("automotive_store_view_us")
        ->getId();

        $storeViewBRFestasId = $this->storeManager
        ->getStore("festas_store_view_pt")
        ->getId();

        $storeViewBRAutomotivoId = $this->storeManager
        ->getStore("automotivo_store_view_pt")
        ->getId();
        
        $ruleData = [
            "name" => $name,
            "description" => $description,
            "from_date" => null,
            "to_date" => null,
            "uses_per_customer" => "0",
            "is_active" => "1",
            "stop_rules_processing" => "1",
            "is_advanced" => "1",
            "product_ids" => null,
            "sort_order" => "2",
            "simple_action" => "by_percent",
            "discount_amount" => $discount,
            "discount_qty" => null,
            "discount_step" => "0",
            "apply_to_shipping" => "0",
            "times_used" => "0",
            "is_rss" => "1",
            "coupon_type" => "1",
            "use_auto_generation" => "0",
            "uses_per_coupon" => "0",
            "simple_free_shipping" => "0",
            "customer_group_ids" => [$customerGroupId], // 0 = Not Logged, 1 = General, 2 = Wholesale, 3 = Retailer
            "website_ids" => [$websiteId],
            "coupon_code" => null,
            "store_labels" => [
                $storeViewUSFestasId => "10% off",
                $storeViewUSAutomotivoId => "10% off",
                $storeViewBRFestasId => "de 10%",
                $storeViewBRAutomotivoId => "de 10%"
            ],
            "conditions_serialized" => '',
            "actions_serialized" => ''
        ];

         $ruleModel = $this->ruleFactory->create();
         $ruleModel->setData($ruleData);
         $ruleModel->save();
    }


    public function apply() {
        $this->moduleDataSetup->getConnection()->startSetup();
        
        $this->createRuleCustomerGroup("NotLoggedAutomotivo10", "Usuários não logados recebem 10% de desconto", "10.000", 1, 2);

        $this->moduleDataSetup->getConnection()->endSetup();
    }
}