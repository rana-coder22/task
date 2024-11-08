<?php

namespace AdminGrid\Practice\Block\Adminhtml\MyGrid;

use Magento\Backend\Block\Template;

class Form extends Template
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('AdminGrid_Practice::mygrid/form.phtml'); // Ensure correct path to your template
    }

}
