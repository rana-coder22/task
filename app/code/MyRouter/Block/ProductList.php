<?php
namespace Vendor\MyRouter\Block;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Catalog\Helper\Image as ImageHelper;

class ProductList extends Template
{
    protected $productCollectionFactory;
    protected $imageHelper;

    public function __construct(
        Template\Context $context,
        CollectionFactory $productCollectionFactory,
        ImageHelper $imageHelper,
        array $data = []
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->imageHelper = $imageHelper;
        parent::__construct($context, $data);
    }

    public function getProductCollection()
    {
        $collection = $this->productCollectionFactory->create();
        $collection->addAttributeToSelect('*'); // Select all attributes or specify specific attributes
        $collection->setPageSize(10); // Limit the number of products displayed, e.g., 10

        return $collection;
    }

    public function getProductImageUrl($product)
    {
        return $this->imageHelper->init($product, 'product_base_image')->getUrl();
    }
}
