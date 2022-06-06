<?php
namespace Webjump\ConfigCartPriceRules\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\SalesRule\Model\RuleFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\State;

class SetZCoupon implements DataPatchInterface
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

    public function createCouponRule(){
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
            "name" => "20% Coupon",
            "description" => null,
            "from_date" => null,
            "to_date" => null,
            "uses_per_customer" => "0",
            "is_active" => "1",
            "stop_rules_processing" => "1",
            "is_advanced" => "1",
            "product_ids" => null,
            "sort_order" => "0",
            "simple_action" => "by_percent",
            "discount_amount" => "20%",
            "discount_qty" => null,
            "discount_step" => "0",
            "apply_to_shipping" => "0",
            "times_used" => "0",
            "is_rss" => "1",
            "coupon_type" => "2",
            "use_auto_generation" => "0",
            "uses_per_coupon" => "0",
            "simple_free_shipping" => "0",
            "customer_group_ids" => [0, 1, 2, 3], // 0 = Not Logged, 1 = General, 2 = Wholesale, 3 = Retailer
            "website_ids" => [0, 1, 2, 3, 4, 5],
            "coupon_code" => 'QUERO20',
            "store_labels" => [                
            $storeViewUSFestasId => "20% off",
            $storeViewUSAutomotivoId => "20% off",
            $storeViewBRFestasId => "de 20%",
            $storeViewBRAutomotivoId => "de 20% "],
            'conditions_serialized' => json_encode([
                'type' => \Magento\SalesRule\Model\Rule\Condition\Combine::class,
                'attribute' => null,
                'operator' => null,
                'value' => '1',
                'is_value_processed' => null,
                'aggregator' => 'all',
                'conditions' => [
                    [
                        'type' => \Magento\SalesRule\Model\Rule\Condition\Combine\Address::class,
                        'attribute' => null,
                        'operator' => null,
                        'value' => '1',
                        'is_value_processed' => null,
                        'aggregator' => 'all'
                    ],
                ],
            ]),
            "actions_serialized" => ''
        ];

         $ruleModel = $this->ruleFactory->create();
         $ruleModel->setData($ruleData);
         $ruleModel->save();
    }



    public function apply() {
        $this->moduleDataSetup->getConnection()->startSetup();
        
        $this->state->setAreaCode(\Magento\Framework\App\Area::AREA_FRONTEND);

        $this->createCouponRule();

        $this->moduleDataSetup->getConnection()->endSetup();
    }
}