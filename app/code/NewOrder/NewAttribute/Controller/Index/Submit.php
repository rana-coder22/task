<?php

namespace NewOrder\NewAttribute\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use NewOrder\NewAttribute\Model\DataFactory;
use Magento\Framework\App\Request\DataPost;
use Magento\Framework\Filesystem;
use Magento\Framework\File\UploaderFactory;
use Magento\Framework\Exception\LocalizedException;

class Submit extends Action
{
    protected $dataFactory;
    protected $uploaderFactory;
    protected $filesystem;

    public function __construct(
        Context $context,
        DataFactory $dataFactory,
        UploaderFactory $uploaderFactory,
        Filesystem $filesystem
    ) {
        parent::__construct($context);
        $this->dataFactory = $dataFactory;
        $this->uploaderFactory = $uploaderFactory;
        $this->filesystem = $filesystem;
    }

    public function execute()
    {
        if ($this->getRequest()->isPost()) {
            try {
                $data = $this->getRequest()->getPostValue();

                // Handle file upload
                if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
                    $uploader = $this->uploaderFactory->create(['fileId' => 'image']);
                    $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                    $uploader->setFilesDispersion(false);
                    $mediaDirectory = $this->filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
                    $path = $mediaDirectory->getAbsolutePath('customform/');

                    $result = $uploader->save($path);
                    $data['image'] = 'customform/' . $result['file']; // Store the path in the data array
                }

                // Save data to the database
                $model = $this->dataFactory->create();
                $model->setData($data);
                $model->save();

                // Redirect to a success page or show a success message
                $this->messageManager->addSuccessMessage(__('Data has been successfully saved.'));
                return $this->_redirect('customform/index/submit'); // Redirect to the same form page or another page
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
                $logger = new \Zend_Log();
                $logger->addWriter($writer);
                $logger->info('Something went wrong while saving data.' . $e);
                $this->messageManager->addErrorMessage(__('Something went wrong while saving data.'));
            }
        }

        // Load layout if it's not a POST request
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}
