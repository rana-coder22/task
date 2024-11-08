<?php

namespace Coding\HelloWorld\Block;

use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;

class Post extends Template
{
    protected $emails;
    protected $_scopeConfig;

    public function __construct(
        Template\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->_scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    public function setEmails($emails)
    {
        $this->emails = $emails;
        return $this;
    }

    public function getEmails()
    {
        // Retrieve restricted emails from the configuration
        $restrictedEmails = $this->_scopeConfig->getValue('demo/general/restrictions');

        if(empty($restrictedEmails)) {
            $restrictedEmails = '';
        }

        $restrictedEmails = explode(',', $restrictedEmails);

        // Filter out restricted emails from the list of emails
        return array_filter($this->emails, function ($email) use ($restrictedEmails) {
            return !in_array($email, $restrictedEmails);
        });
    }
}
