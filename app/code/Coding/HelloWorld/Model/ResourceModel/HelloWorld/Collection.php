<?php

namespace Coding\HelloWorld\Model\ResourceModel\HelloWorld;


use Coding\HelloWorld\Model\ResourceModel\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'post_id';

    /**
     * Load data for preview flag
     *
     * @var bool
     */
    protected $_previewFlag;

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Coding\HelloWorld\Model\HelloWorld', 'Coding\HelloWorld\Model\ResourceModel\HelloWorld');
    }


    public function setFirstStoreFlag($flag = false)
    {
        $this->_previewFlag = $flag;
        return $this;
    }

    /**
     * Add filter by store
     *
     * @param int|array|\Magento\Store\Model\Store $store
     * @param bool $withAdmin
     * @return $this
     */
    public function addStoreFilter($store, $withAdmin = true)
    {

        return $this;
    }

    /**
     * Perform operations after collection load
     *
     * @return $this
     */
    protected function _afterLoad()
    {

        return parent::_afterLoad();
    }

    /**
     * Perform operations before rendering filters
     *
     * @return void
     */
    protected function _renderFiltersBefore()
    {
        return parent::_renderFiltersBefore();
    }
}
