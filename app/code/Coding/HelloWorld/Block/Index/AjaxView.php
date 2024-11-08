<?php

namespace Coding\HelloWorld\Block\Index;

use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;
use Coding\HelloWorld\Model\BlogFactory;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class AjaxView extends Template
{
    protected $scopeConfig;

    protected $blogFactory;

    public function __construct(
        Template\Context $context,
        BlogFactory $blogFactory,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    )
    {
        $this->blogFactory = $blogFactory;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    public function getEmails()
    {
        return [
            'email' => $this->getData('email'),
            'startDate' => $this->getData('startDate'),
            'endDate' => $this->getData('endDate')
        ];
    }

    public function getPosts()
    {
        $params = $this->getEmails();

        $collection = $this->blogFactory->create()->getCollection();

        if ($params['email']) {
            $collection->addFieldToFilter('email', $params['email']);
        }
        if ($params['startDate']) {
            $collection->addFieldToFilter('start_date', ['gteq' => $params['startDate'] . ' 00:00:00']);
        }
        if ($params['endDate']) {
            $collection->addFieldToFilter('end_date', ['lteq' => $params['endDate'] . ' 23:59:59']);
        }

        $postLimit = (int)$this->scopeConfig->getValue(
            'demo/general/postlimit', // Replace with the correct path
            ScopeInterface::SCOPE_STORE
        );

        // Add pagination logic
        if ($postLimit <= 0) {
            $postLimit = 5;
        }

        // Apply the Post Limit to the collection pagination
        $currentPage = (int)$this->getData('currentPage') ?: 1; // Get current page
        $collection->setPageSize($postLimit);
        $collection->setCurPage($currentPage);

        return $collection->getItems();
    }

    public function getTotalPages()
    {
        $params = $this->getEmails();
        $collection = $this->blogFactory->create()->getCollection();

        if ($params['email']) {
            $collection->addFieldToFilter('email', $params['email']);
        }
        if ($params['startDate']) {
            $collection->addFieldToFilter('start_date', ['gteq' => $params['startDate'] . ' 00:00:00']);
        }
        if ($params['endDate']) {
            $collection->addFieldToFilter('end_date', ['lteq' => $params['endDate'] . ' 23:59:59']);
        }

        // Fetch the Post Limit from the configuration again
        $postLimit = (int)$this->scopeConfig->getValue(
            'demo/general/postlimit', // Replace with the correct path
            ScopeInterface::SCOPE_STORE
        );

        // If the Post Limit is not set or invalid, default to 5
        if ($postLimit <= 0) {
            $postLimit = 5;
        }

        // Return total pages based on collection size and dynamic post limit
        return ceil($collection->getSize() / $postLimit);
    }



    protected function _prepareLayout()
    {

        return parent::_prepareLayout();
    }
    }
