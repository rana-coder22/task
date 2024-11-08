<?php

namespace Custom\CAttribute\Plugin\Catalog\Model;

use Magento\Customer\Model\Session;

class Product
{

    protected $customerSession;


    public function __construct(Session $customerSession)
    {
        $this->customerSession = $customerSession;
    }


    public function afterGetSpecialPrice(
        \Magento\Catalog\Model\Product $subject,
                                       $result
    ) {
        $customer = $this->customerSession->getCustomer();

        // Check if the customer is logged in
        if ($this->customerSession->isLoggedIn()) {
            $discountAllowed = $customer->getData('custom_discount');
            // Check if discount is allowed and set a custom special price
            if ($discountAllowed == 1) {
//                echo $discountAllowed;
//                exit();
                $originalPrice = $subject->getPrice();
//                dd($originalPrice);

                $discountedPrice = $originalPrice * 0.5; // Calculate 50% discount

//                dd($discountedPrice);
                return $discountedPrice;

                // Ensure the special price is less than the original price
//                return $discountedPrice < $originalPrice ? $discountedPrice : $originalPrice;
            }
        }

        // Return the original special price if conditions are not met
        return $result;
    }
}
