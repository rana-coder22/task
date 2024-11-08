<?php
namespace Coding\HelloWorld\Plugin\Block;

use Magento\Framework\Data\Tree\NodeFactory;
use Magento\Framework\UrlInterface;

class Topcat
{
    protected $nodeFactory;
    protected $urlInterface;

    public function __construct(
        NodeFactory $nodeFactory,
        UrlInterface $urlInterface
    ) {
        $this->nodeFactory = $nodeFactory;
        $this->urlInterface = $urlInterface;
    }

    public function beforeGetHtml(
        \Magento\Theme\Block\Html\Topmenu $subject,
                                          $outermostClass = '',
                                          $childrenWrapClass = '',
                                          $limit = 0
    ) {
        $node = $this->nodeFactory->create(
            [
                'data' => $this->getNodeAsArray(),
                'idField' => 'id',
                'tree' => $subject->getMenu()->getTree()
            ]
        );
        $subject->getMenu()->addChild($node);
    }

    public function getNodeAsArray()
    {
        return [
            'name' => __('Blog'), // Menu label
            'id' => 'custom-blogs-menu', // Unique ID for the menu
            'url' => $this->urlInterface->getUrl('blog'), // URL to your custom module
            'has_active' => false,
            'is_active' => $this->isActive()
        ];
    }

    private function isActive()
    {
        $activeUrls = 'blog';
        $currentUrl = $this->urlInterface->getCurrentUrl();
        if (strpos($currentUrl, $activeUrls) !== false) {
            return true;
        }
        return false;
    }
}
