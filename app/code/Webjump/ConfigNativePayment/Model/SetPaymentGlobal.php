<?php

namespace Webjump\ConfigNativePayment\Model;

use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Store\Model\StoreManagerInterface;


Class SetPaymentGlobal {

    public function __construct(
        WriterInterface $writer,
        StoreManagerInterface $storeManager
    )
    {
        $this->writer = $writer;
        $this->storeManager = $storeManager;
    }
    
    
    public function setGlobalSettings(string $websiteCode)
    {
        $websiteGetId = $this->storeManager
        ->getWebsite($websiteCode)
        ->getId();

        $this->writer->save(
            "payment/checkmo/active",
            "1",
            "websites",
            $websiteGetId
        );

        $this->writer->save(
            "payment/checkmo/order_status",
            "pending",
            "websites",
            $websiteGetId
        );

        $this->writer->save(
            "payment/checkmo/allowspecific",
            "1",
            "websites",
            $websiteGetId
         );
 
         $this->writer->save(
             "payment/checkmo/specificcountry",
             "BR,US",
             "websites",
             $websiteGetId
         );

         $this->writer->save(
            "payment/checkmo/sort_order",
            "0",
            "websites",
            $websiteGetId
        );
        
        $this->writer->save(
            "payment/banktransfer/specificcountry",
            "BR,US",
            "websites",
            $websiteGetId
        );

        $this->writer->save(
            "payment/banktransfer/active",
            "1",
            "websites",
            $websiteGetId
        );

        $this->writer->save(
           "payment/banktransfer/sort_order",
           "1",
           "websites",
           $websiteGetId
        );

        $this->writer->save(
            "payment/banktransfer/order_status",
            "pending",
            "websites",
            $websiteGetId
        );

    }
    
    public function setPaymentMoney(string $storeViewCode, string $language)
    {
        
        $StoreViewGetId = $this->storeManager
        ->getStore($storeViewCode)
        ->getId();
        
        if ($language == 'br'){

            $this->writer->save(
                "payment/checkmo/title",
                "Pagamento em Dinheiro",
                "stores",
                $StoreViewGetId
            ); 

        } else if ($language == "en") {

            $this->writer->save(
                "payment/checkmo/title",
                "Money order",
                "stores",
                $StoreViewGetId
            ); 
        }
        
        
        $this->writer->save(
            "payment/checkmo/active",
            "1",
            "stores",
            $StoreViewGetId
        );

        
        $this->writer->save(
            "payment/checkmo/order_status",
            "pending",
            "stores",
            $StoreViewGetId
        );

        $this->writer->save(
           "payment/checkmo/allowspecific",
           "1",
           "stores",
           $StoreViewGetId
        );

        $this->writer->save(
            "payment/checkmo/specificcountry",
            "BR,US",
            "stores",
            $StoreViewGetId
        );

        $this->writer->save(
            "payment/checkmo/sort_order",
            "0",
            "stores",
            $StoreViewGetId
        );
    }

    public function setPaymentBankTransfer(string $storeViewCode, string $language)
    {

        $StoreViewGetId = $this->storeManager
        ->getStore($storeViewCode)
        ->getId();

        if ($language == "br")
        {
            $this->writer->save(
                "payment/banktransfer/instructions",
                "Nome da conta do banco: AutomotivoWebjump\n
                Número da conta do banco: 99999\n
                Nome do banco: Webjump\n
                Endereço do banco: São Paulo - SP",
                "stores",
                $StoreViewGetId
            );

            $this->writer->save(
                "payment/banktransfer/title",
                "Pagamento por Transferência Bancária",
                "stores",
                $StoreViewGetId
            );

        } else if ($language == "en") 
        {
            $this->writer->save(
                "payment/banktransfer/instructions",
                "Bank account name: WebjumpParty\n
                Bank account number: 99999\n
                Bank name: Webjump\n
                Bank address: California - United States",
                "stores",
                $StoreViewGetId
            );

            $this->writer->save(
                "payment/banktransfer/title",
                "Bank Transfer Payment",
                "stores",
                $StoreViewGetId
            );
        }
        
        $this->writer->save(
            "payment/banktransfer/specificcountry",
            "BR,US",
            "stores",
            $StoreViewGetId
        );

        $this->writer->save(
            "payment/banktransfer/active",
            "1",
            "stores",
            $StoreViewGetId
        );

        $this->writer->save(
           "payment/banktransfer/sort_order",
           "1",
           "stores",
           $StoreViewGetId
        );

        $this->writer->save(
            "payment/banktransfer/order_status",
            "pending",
            "stores",
            $StoreViewGetId
        );
    }


}