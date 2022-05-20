<?php
namespace Webjump\ConfigCartPriceRules\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\SalesRule\Model\RuleFactory;
use Magento\Framework\App\State;

class SetCustomerGroups implements DataPatchInterface
{
    private ModuleDataSetupInterface $moduleDataSetup;
    private RuleFactory $ruleFactory;
    private State $state;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        RuleFactory $ruleFactory,
        State $state
        )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->ruleFactory = $ruleFactory;
        $this->state = $state;
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
            "sort_order" => "0",
            "simple_action" => "cart_fixed",
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
            "store_labels" => [],
            "conditions_serialized" => '',
            "actions_serialized" => ''
        ];

         $ruleModel = $this->ruleFactory->create();
         $ruleModel->setData($ruleData);
         $ruleModel->save();
    }


    public function apply() {
        $this->moduleDataSetup->getConnection()->startSetup();
        
        $this->createRuleCustomerGroup("NotLoggedAutomotivo10", "Usuários não logados recebem 10% de desconto", "10.000", 0, 2);        
        $this->createRuleCustomerGroup("NotLoggedFestas5", "Usuários não logados recebem 5% de desconto", "5.000", 0, 3);

        $this->moduleDataSetup->getConnection()->endSetup();
    }
}