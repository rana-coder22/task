<?php
//namespace Final\Task\Helper;
//
//use Magento\Framework\App\Helper\AbstractHelper;
//use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
//
//class OrderHelper extends AbstractHelper
//{
//    protected $orderCollectionFactory;
//
//    public function __construct(
//        \Magento\Framework\App\Helper\Context $context,
//        CollectionFactory $orderCollectionFactory
//    ) {
//        parent::__construct($context);
//        $this->orderCollectionFactory = $orderCollectionFactory;
//    }
//
//    public function getOrdersBySku($sku)
//    {
//        $ordersGroupedByStatus = [];
//
//
//        $orderCollection = $this->orderCollectionFactory->create()
//            ->addFieldToSelect('*')
//            ->join(
//                ['oi' => 'sales_order_item'],
//                'main_table.entity_id = oi.order_id',
//                ['sku']
//            )
//            ->addFieldToFilter('oi.sku', ['eq' => $sku]);
//
//        foreach ($orderCollection as $order) {
//            $status = $order->getStatus();
//            $ordersGroupedByStatus[$status][] = $order;
//        }
//
//        return $ordersGroupedByStatus;
//    }
//}
