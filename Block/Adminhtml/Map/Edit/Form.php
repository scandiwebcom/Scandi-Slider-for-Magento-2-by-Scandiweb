<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */
namespace Scandiweb\Slider\Block\Adminhtml\Map\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /* @var $_slideModel \Scandiweb\Slider\Model\Slide $slide */
    protected $_slideModel;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Scandiweb\Slider\Model\Slide $slide,
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Scandiweb\Slider\Model\Slide $slide,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        $this->_formFactory = $formFactory;
        $this->_slideModel = $slide;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return \Scandiweb\Slider\Block\Adminhtml\Map\Edit\Form
     */
    protected function _prepareForm()
    {
        /* @var \Scandiweb\Slider\Model\Map $model */
        $model = $this->_coreRegistry->registry('map');

        /* @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => [
                'id' => 'edit_form',
                'action' => $this->getData('action'),
                'method' => 'post',
                'enctype' => 'multipart/form-data']
            ]
        );
        $form->setUseContainer(true);
        $this->setForm($form);

        /* @var $fieldset \Magento\Framework\Data\Form\Element\Fieldset */
        $fieldset = $form->addFieldset(
            'content_fieldset',
            ['legend' => __('Image Map Information'), 'class' => 'fieldset-wide']
        );

        if ($model->getMapId()) {
            $fieldset->addField('map_id', 'hidden', ['name' => 'map_id']);
        }

        if ($model->getSlideId()) {
            $fieldset->addField('slide_id', 'hidden', ['name' => 'slide_id']);
        }

        $fieldset->addField(
            'title',
            'text',
            [
                'name' => 'title',
                'label' => __('Map Title'),
                'title' => __('Map Title'),
                'required' => true,
            ]
        );

        $fieldset->addField(
            'is_active',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'is_active',
                'required' => true,
                'options' => ['1' => __('Enabled'), '0' => __('Disabled')]
            ]
        );

        $this->_slideModel->load($model->getSlideId());

        $fieldset->addField(
            'coordinates',
            'textarea',
            [
                'label' => __('Coordinates'),
                'title' => __('Coordinates'),
                'name' => 'coordinates',
                'readonly' => 1
            ]
        );

        $this->getForm()->setValues($model->getData());

        $fieldset->addField(
            'image_location',
            'hidden',
            [
                'name'  => 'image_location',
                'value' => $this->_slideModel->getImageUrl()
            ]
        );

        return parent::_prepareForm();
    }
}
