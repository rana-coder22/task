<?php

namespace NewOrder\NewAttribute\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Data extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('custom_form_data', 'entity_id');
    }
}
