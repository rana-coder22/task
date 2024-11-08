<?php

namespace AdminGrid\Practice\Block\Adminhtml\MyGrid;

use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    public function __construct($name, $primaryFieldName, $requestFieldName, $collection, $meta = [], $data = [])
    {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $collection, $meta, $data);
    }
}
