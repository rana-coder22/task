<?php

namespace Custom\CAttribute\Observer;

use Magento\Customer\Model\Session;
use Magento\Framework\Event\ObserverInterface;

class CustomPrice implements ObserverInterface
{
    protected  $customerSession;

    public function __construct(
        Session $customerSession
    )
    {
        $this->customerSession = $customerSession;
    }

    public function execute(\Magento\Framework\Event\Observer $observer) {
        $customer = $this->customerSession->getCustomer();

//        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
//        $logger = new \Zend_Log();
//        $logger->addWriter($writer);

        if ($this->customerSession->isLoggedIn())
        {
            $discountStatus = $customer->getData('custom_discount');
            if($discountStatus==1)
            {
                $item = $observer->getEvent()->getData('quote_item');
                $item = ($item->getParentItem() ? $item->getParentItem() : $item);

                $originalPrice = $item->getPrice(); // Original price
                $price = $originalPrice * 0.5; // 50% off

//                $item->setCustomPrice($price);
//                $item->setOriginalCustomPrice($price);
//                $item->getProduct()->setIsSuperMode(true);
            }

        } else{
            echo "";

        }

    }
}
