<?php

namespace Final\Task\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Sales\Api\OrderRepositoryInterface;


class OrderDetail extends Template
{

    protected $orderRepository;

    public function __construct(
        Context $context,
        OrderRepositoryInterface $orderRepository
    ) {
        parent::__construct($context);
        $this->orderRepository = $orderRepository;
    }
    public function getStatus()
    {
        return $this->getData('status');
    }

}
