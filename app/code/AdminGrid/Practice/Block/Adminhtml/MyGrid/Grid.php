<?php
namespace AdminGrid\Practice\Block\Adminhtml\MyGrid;

use Magento\Backend\Block\Widget\Grid\Extended;
use AdminGrid\Practice\Model\ResourceModel\Post\CollectionFactory; // Adjust to your model's resource collection

class Grid extends Extended
{
    protected $collectionFactory;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        CollectionFactory $collectionFactory, // Inject your collection factory here
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory; // Assign the collection factory
        parent::__construct($context, $backendHelper, $data);
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setId('postGrid');
        $this->setDefaultSort('created_at');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
        $this->setVarNameFilter('post_filter');
    }

    protected function _prepareCollection()
    {
        // Get the collection from your custom model
        $collection = $this->collectionFactory->create(); // Create an instance of your custom collection

        // Set the collection for the grid
        $this->setCollection($collection);

        return parent::_prepareCollection(); // Call the parent method for any additional processing
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'title',
            [
                'header' => __('Title'),
                'index' => 'title',
            ]
        );

        $this->addColumn(
            'description',
            [
                'header' => __('Description'),
                'index' => 'description',
            ]
        );

        $this->addColumn(
            'created_at',
            [
                'header' => __('Creation Time'),
                'index' => 'created_at',
                'type' => 'datetime', // Set the type for datetime column
            ]
        );

        $this->addColumn(
            'action',
            [
                'header' => __('Actions'),
                'renderer' => \Magento\Backend\Block\Widget\Grid\Column\Renderer\Action::class,
                'index' => 'entity_id',
                'actions' => [
                    [
                        'caption' => __('Edit'),
                        'url' => ['base' => 'grid/index/edit'],
                        'field' => 'id'
                    ],
                    [
                        'caption' => __('Delete'),
                        'url' => ['base' => 'grid/index/delete'],
                        'field' => 'id'
                    ],
                ],
            ]
        );

        return parent::_prepareColumns();
    }

    public function getGridUrl()
    {
        return $this->getUrl('grid/index/index', ['_current' => true]);
    }

    public function getRowUrl($row)
    {
        return '#';
    }

}
