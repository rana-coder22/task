<?php

namespace Coding\HelloWorld\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Coding\HelloWorld\Model\HelloWorld;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Coding_HelloWorld::helloworld1';
    protected $dataProcessor;
    protected $dataPersistor;
    protected $model;

    public function __construct(
        Action\Context $context,
        PostDataProcessor $dataProcessor,
        HelloWorld $model,
        DataPersistorInterface $dataPersistor
    ) {
        $this->dataProcessor = $dataProcessor;
        $this->dataPersistor = $dataPersistor;
        $this->model = $model;
        parent::__construct($context);
    }

    public function execute()
    {

        $data = $this->getRequest()->getPostValue();
//        dd($data);
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {

            if (isset($data['logo'][0]['name']) && isset($data['logo'][0]['tmp_name'])) {
                $data['image'] =$data['logo'][0]['name'];
                $this->imageUploader = \Magento\Framework\App\ObjectManager::getInstance()->get(
                    'Coding\HelloWorld\HelloWorldImageUpload'
                );
                $this->imageUploader->moveFileFromTmp($data['image']);
            } elseif (isset($data['logo'][0]['image']) && !isset($data['logo'][0]['tmp_name'])) {
                $data['image'] = $data['logo'][0]['image'];
            } else {
                $data['image'] = null;
            }


            $data = $this->dataProcessor->filter($data);


            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $this->model->load($id);
            }


            $this->model->setData($data);

            $this->_eventManager->dispatch(
                'helloworld_prepare_save',
                ['helloworld' => $this->model, 'request' => $this->getRequest()]
            );

            if (!$this->dataProcessor->validate($data)) {
                return $resultRedirect->setPath('*/*/edit', ['id' => $this->model->getId(), '_current' => true]);
            }

            try {
                $this->model->save();
                $this->messageManager->addSuccess(__('You saved the Post.'));
                $this->dataPersistor->clear('helloworld');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath(
                        '*/*/edit',
                        ['id' => $this->model->getId(),
                            '_current' => true]
                    );
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Post.'));
            }

            $this->dataPersistor->set('helloworld', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
