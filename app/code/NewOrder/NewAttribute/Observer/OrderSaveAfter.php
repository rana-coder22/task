<?php

namespace NewOrder\NewAttribute\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class OrderSaveAfter implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        // Get the order object from the event
        $order = $observer->getEvent()->getOrder();

        // Determine the current hour
        $currentHour = (int)date('H');

        // Set the order time based on the current hour
        if ($currentHour < 12) {
            $timeOfOrder = 'Morning';
        } elseif ($currentHour < 18) {
            $timeOfOrder = 'Afternoon';
        } else {
            $timeOfOrder = 'Night';
        }

        // Set the custom order attribute
        $order->setData('custom_order_attribute', $timeOfOrder);

        // Save the order to include the new attribute
        $order->save();
    }
}
