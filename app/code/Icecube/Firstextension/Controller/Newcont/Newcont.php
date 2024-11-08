<?php
namespace Icecube\Firstextension\Controller\Newcont;

use Magento\Framework\App\Action\Context;

class Newcont extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;

    public function __construct(Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);

    }

    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        return $resultPage;
    }

}

//use \Magento\Framework\App\Action\Action;
//use \Magento\Framework\View\Result\PageFactory;
//
//
//class Newcont extends Action
//{
//
//    protected $resultPageFactory;
//
//    public function __construct(
//        Context $context,
//        PageFactory $resultPageFactory
//    ) {
//        parent::__construct(
//            $context
//        );
//        $this->resultPageFactory = $resultPageFactory;
//    }
//
//    public function execute()
//    {
//        echo "This is the Firstextension";
////        exit;
//    }
//}
