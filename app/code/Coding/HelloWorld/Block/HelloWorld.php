<?php

namespace Coding\HelloWorld\Block;

class HelloWorld extends \Magento\Framework\View\Element\Template
{
    protected $_coreRegistry = null;
    protected $_collectionFactory;
    protected $_productsFactory;
    protected $_helloworldFactory;
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Coding\HelloWorld\Model\ResourceModel\HelloWorld\CollectionFactory $helloworldFactory,
        array $data = []
    ) {

        $this->_coreRegistry = $registry;
        $this->_helloworldFactory = $helloworldFactory;
        parent::__construct($context, $data);
    }
    public function getHelloCollection()
    {
        $page=($this->getRequest()->getParam('p'))? $this->getRequest()->getParam('p') : 1;
        //get values of current limit
        $pageSize=($this->getRequest()->getParam('limit'))? $this->getRequest()->getParam('limit') : 5;

        $helloCollection = $this->_helloworldFactory->create();
        $helloCollection->setPageSize($pageSize);
        $helloCollection->setCurPage($page);
        return $helloCollection;
    }
    public function _prepareLayout()
    {

        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('Blogs Post'));
        $currentDate = (new \DateTime())->format('Y-m-d H:i:s');


        if ($this->getHelloCollection()) {
            $pager = $this->getLayout()->createBlock('Magento\Theme\Block\Html\Pager','helloworld.blog.pager')
                ->setAvailableLimit(array(5=>5,10=>10,15=>15));
            $pager->setShowPerPage(true);
            $pager->setCollection($this->getHelloCollection());
            $this->setChild('pager', $pager);
            $this->getHelloCollection()->load();
        }
        return $this;
    }
    public function getPagerHtml(){
        return $this->getChildHtml('pager');
    }


}
