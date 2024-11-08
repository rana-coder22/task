<?php

namespace AdminGrid\Practice\Block\Adminhtml;

class MyGrid extends \Magento\Backend\Block\Widget\Container
{
    /**
     * @var string
     */
    protected $_template = 'grid.phtml';

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param array $data
     */
    public function __construct(\Magento\Backend\Block\Widget\Context $context,array $data = [])
    {
        parent::__construct($context, $data);
    }

    /**
     * Prepare button and grid
     *
     * @return \Magento\Catalog\Block\Adminhtml\Product
     */
    protected function _prepareLayout()
    {
        $this->setChild(
            'grid',
            $this->getLayout()->createBlock('AdminGrid\Practice\Block\Adminhtml\MyGrid\Grid', 'admin.myadmingrid.grid')
        );

        // Add button to create new record
        $this->buttonList->add(
            'add_new',
            [
                'label' => __('Add New Record'),
                'class' => 'add',
                'onclick' => 'setLocation(\'' . $this->getAddUrl() . '\')',
                'sortOrder' => 10
            ]
        );        return parent::_prepareLayout();
    }

    public function getAddUrl()
    {
        return $this->getUrl('grid/index/add'); // Change 'grid/index/add' to your actual action
    }

    /**
     * Render grid
     *
     * @return string
     */
    public function getGridHtml()
    {
        return $this->getChildHtml('grid');
    }

}
