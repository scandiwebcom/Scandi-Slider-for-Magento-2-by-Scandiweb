<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */
namespace Scandiweb\Slider\Controller\Adminhtml\Slide;

class Save extends \Magento\Backend\App\Action
{
    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Scandiweb_Slider::slide_save');
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getParam('slide');

        /* @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {

            /* @var \Scandiweb\Slider\Model\Slide $model */
            $model = $this->_objectManager->create('Scandiweb\Slider\Model\Slide');

            $id = $this->getRequest()->getParam('slide_id');
            if ($id) {
                $model->load($id);
            }

            unset($data['image']);
            unset($data['image_mobile']);

            $model->setData($data);

            try {

                if (isset($_FILES['image']['name']) && $_FILES['image']['name']) {
                    /* @var \Magento\MediaStorage\Model\File\Uploader $uploader */
                    $uploader = $this->_objectManager->create(
                        'Magento\MediaStorage\Model\File\Uploader',
                        ['fileId' => 'image']
                    );
                    $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);

                    /* @var \Magento\Framework\Image\Adapter\AdapterInterface $imageAdapter */
                    $imageAdapter = $this->_objectManager->get('Magento\Framework\Image\AdapterFactory')->create();

                    $uploader->addValidateCallback('image', $imageAdapter, 'validateUploadFile')
                        ->setAllowRenameFiles(true)
                        ->setFilesDispersion(true);

                    /* @var \Magento\Framework\Filesystem\Directory\Read $mediaDirectory */
                    $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
                        ->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
                    $result = $uploader->save(
                        $mediaDirectory->getAbsolutePath(\Scandiweb\Slider\Model\Slider::MEDIA_PATH)
                    );
                    $model->setData('image', \Scandiweb\Slider\Model\Slider::MEDIA_PATH . $result['file']);
                } else if (isset($data['image']['delete']) && $data['image']['delete']) {
                    $model->unsetData('image');
                }

                if (isset($_FILES['image_mobile']['name']) && $_FILES['image_mobile']['name']) {
                    /* @var \Magento\MediaStorage\Model\File\Uploader $uploader */
                    $uploader = $this->_objectManager->create(
                        'Magento\MediaStorage\Model\File\Uploader',
                        ['fileId' => 'image_mobile']
                    );
                    $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);

                    /* @var \Magento\Framework\Image\Adapter\AdapterInterface $imageAdapter */
                    $imageAdapter = $this->_objectManager->get('Magento\Framework\Image\AdapterFactory')->create();
                    $uploader->addValidateCallback('image_mobile', $imageAdapter, 'validateUploadFile')
                        ->setAllowRenameFiles(true)
                        ->setFilesDispersion(true);

                    /* @var \Magento\Framework\Filesystem\Directory\Read $mediaDirectory */
                    $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
                        ->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
                    $result = $uploader->save(
                        $mediaDirectory->getAbsolutePath(\Scandiweb\Slider\Model\Slider::MEDIA_PATH)
                    );
                    $model->setData('image_mobile', \Scandiweb\Slider\Model\Slider::MEDIA_PATH . $result['file']);
                } else if (isset($data['image_mobile']['delete']) && $data['image_mobile']['delete']) {
                    $model->unsetData('image_mobile');
                }

                $model->save();
                $this->messageManager->addSuccess(__('Slide successfully saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['slide_id' => $model->getId(), '_current' => true]);
                }

                return $resultRedirect->setPath('slideradmin/slider/edit', ['slider_id' => $model->getSliderId()]);
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the slide.'));
            }

            $this->_getSession()->setFormData($data);

            return $resultRedirect->setPath('*/*/edit', ['slide_id' => $this->getRequest()->getParam('slide_id')]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
