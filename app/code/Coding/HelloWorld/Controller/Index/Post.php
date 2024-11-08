<?php

namespace Coding\HelloWorld\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Coding\HelloWorld\Model\BlogFactory;

class Post extends Action
{
    protected $blogFactory;

    public function __construct(Context $context, BlogFactory $blogFactory)
    {
        parent::__construct($context);
        $this->blogFactory = $blogFactory;
    }

    public function execute()
    {
        $emails = $this->blogFactory->create()->getDistinctEmails();
        $this->_view->loadLayout();
        $this->_view->getLayout()->getBlock('custom.email.post')->setEmails($emails);
        $this->_view->renderLayout();
    }
}
