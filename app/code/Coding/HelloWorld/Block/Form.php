<?php
namespace Coding\HelloWorld\Block;

use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;

class Form extends Template
{
    public function __construct(Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }
    public function getSubmitUrl()
    {
        return $this->getUrl('samplepost/index/submit', ['_secure' => true]);
    }
}
