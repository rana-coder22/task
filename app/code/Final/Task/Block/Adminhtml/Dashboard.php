<?php
namespace Final\Task\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory as OrderCollectionFactory;
use Magento\Sales\Model\ResourceModel\Order\Item\CollectionFactory as OrderItemCollectionFactory;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Helper\Image;

class Dashboard extends Template
{
    protected $orderCollectionFactory;
    protected $orderItemCollectionFactory;
    protected $productFactory;
    protected $imageHelper;

    public function __construct(
        Context $context,
        OrderCollectionFactory $orderCollectionFactory,
        OrderItemCollectionFactory $orderItemCollectionFactory,
        ProductFactory $productFactory,
        Image $imageHelper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->orderCollectionFactory = $orderCollectionFactory;
        $this->orderItemCollectionFactory = $orderItemCollectionFactory;
        $this->productFactory = $productFactory;
        $this->imageHelper = $imageHelper;
    }

    public function getSku()
    {
        return $this->getData('sku');
    }
    public function getOrdersBySku()
    {
        $sku = $this->getSku();

        // Get order items collection and filter by SKU
        $orderItemCollection = $this->orderItemCollectionFactory->create()
            ->addFieldToFilter('sku', $sku); // Filter by SKU

        // Get the corresponding orders based on the order item collection
        $orderIds = $orderItemCollection->getColumnValues('order_id');

        if (empty($orderIds)) {
            return []; // No orders found for this SKU
        }

        // Now get the order collection for those order IDs
        $orderCollection = $this->orderCollectionFactory->create()
            ->addFieldToFilter('entity_id', ['in' => $orderIds]);

        return $orderCollection;
    }

    public function getProductImageUrl($sku)
    {
        try {
            // Load product by SKU
            $product = $this->productFactory->create()->loadByAttribute('sku', $sku);
            if (!$product) {
                return 'Image not found. Please try again';  // Product not found for the given SKU
            }
            // Get the product image URL (thumbnail image)
            $url = $this->imageHelper->init($product, 'product_thumbnail_image')->getUrl();
            return $url;
        } catch (\Exception $e) {
            return 'Image not found';
        }
    }
}
