<?php

namespace Coding\HelloWorld\Model;

class HelloWorld extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Coding\HelloWorld\Model\ResourceModel\HelloWorld');
    }
    

}
