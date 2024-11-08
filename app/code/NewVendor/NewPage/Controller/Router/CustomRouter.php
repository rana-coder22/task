<?php
namespace NewVendor\NewPage\Controller\Router;

use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;

class CustomRouter implements RouterInterface
{
    protected $actionFactory;

    public function __construct(ActionFactory $actionFactory)
    {
        $this->actionFactory = $actionFactory;
    }

    public function match(RequestInterface $request)
    {
        $uri = $request->getPathInfo();

        // Check if the URI matches your desired path
        if ($uri == '/newpage.html') {
            $request->setModuleName('NewVendor_NewPage')
                ->setControllerName('index')
                ->setActionName('index');
            return $this->actionFactory->create(\NewVendor\NewPage\Controller\Index\Index::class);
        }
        return null; // Return null if no match
    }
}
