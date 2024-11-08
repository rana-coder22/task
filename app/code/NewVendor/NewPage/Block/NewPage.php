<?php
namespace NewVendor\NewPage\Block;

use Magento\Framework\View\Element\Template;

class NewPage extends Template
{
    public function getText()
    {
        return "Welcome to the new page created programmatically in Magento 2!";
    }
}
