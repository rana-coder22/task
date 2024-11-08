<?php
namespace Coding\HelloWorld\Block;

use Magento\Framework\View\Element\Template;
use Coding\HelloWorld\Model\ResourceModel\HelloWorld\CollectionFactory;

class BlogList extends Template
{
    protected $blogCollectionFactory;

    public function __construct(
        Template\Context $context,
        CollectionFactory $blogCollectionFactory,
        array $data = []
    ) {
        $this->blogCollectionFactory = $blogCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getBlogs()
    {
        $collection = $this->blogCollectionFactory->create();
        $currentDate = (new \DateTime())->format('Y-m-d H:i:s');

        $collection->addFieldToFilter('end_date', array('gt' => array($currentDate)));
        return $collection;
    }

    public function getBlogUrl($blogId)
    {

        return $this->getUrl('blog/view/index', ['id' => $blogId]);
    }
}
