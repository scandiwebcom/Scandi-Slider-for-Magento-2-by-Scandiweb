<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */
namespace Scandiweb\Slider\Block\Adminhtml\Slide\Edit\Tab;

class Slide extends \Magento\Backend\Block\Widget\Form\Generic implements
    \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return \Scandiweb\Slider\Block\Adminhtml\Slide\Edit\Tab\Slide
     */
    protected function _prepareForm()
    {
        /* @var $model \Scandiweb\Slider\Model\Slide */
        $model = $this->_coreRegistry->registry('slide');

        /* @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('slide_');

        /* @var $fieldset \Magento\Framework\Data\Form\Element\Fieldset */
        $fieldset = $form->addFieldset(
            'content_fieldset',
            ['legend' => __('General'), 'class' => 'fieldset-wide']
        );

        if ($model->getSliderId()) {
            $fieldset->addField('slider_id', 'hidden', ['name' => 'slider_id']);
        }

        if ($model->getSlideId()) {
            $fieldset->addField('slide_id', 'hidden', ['name' => 'slide_id']);
        }

        $fieldset->addField(
            'title',
            'text',
            [
                'name' => 'title',
                'label' => __('Slide Title'),
                'title' => __('Slide Title'),
                'required' => true,
            ]
        );

        $fieldset->addField(
            'image',
            'image',
            [
                'name' => 'image',
                'label' => __('Image'),
                'title' => __('Image'),
                'required' => true,
            ]
        );

        $fieldset->addField(
            'embed_code',
            'text',
            [
                'label' => __('Video Embed Code'),
                'title' => __('Video Embed Code'),
                'name' => 'embed_code',
                'note' => __(
                    'Copy youtube or vimeo or any iframe code from "share" '
                    . 'tab here if you want to display video in slide.'
                )
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

        /* Check is single store mode */
        if (!$this->_storeManager->isSingleStoreMode()) {
            $field = $fieldset->addField(
                'store_id',
                'multiselect',
                [
                    'name' => 'stores[]',
                    'label' => __('Store View'),
                    'title' => __('Store View'),
                    'required' => true,
                    'values' => $this->_systemStore->getStoreValuesForForm(false, true),
                ]
            );

            /* @var $renderer \Magento\Backend\Block\Store\Switcher\Form\Renderer\Fieldset\Element */
            $renderer = $this->getLayout()->createBlock(
                'Magento\Backend\Block\Store\Switcher\Form\Renderer\Fieldset\Element'
            );
            $field->setRenderer($renderer);
        } else {
            $fieldset->addField(
                'store_id',
                'hidden',
                ['name' => 'stores[]', 'value' => $this->_storeManager->getStore(true)->getId()]
            );
            $model->setStoreId($this->_storeManager->getStore(true)->getId());
        }

        $dateFormat = $this->_localeDate->getDateFormat(
            \IntlDateFormatter::SHORT
        );

        $fieldset->addField(
            'start_time',
            'date',
            [
                'name' => 'start_time',
                'label' => __('Start Time'),
                'date_format' => $dateFormat,
                'class' => 'validate-date validate-date-range date-range-custom_theme-from'
            ]
        );

        $fieldset->addField(
            'end_time',
            'date',
            [
                'name' => 'end_time',
                'label' => __('End Time'),
                'date_format' => $dateFormat,
                'class' => 'validate-date validate-date-range date-range-custom_theme-to'
            ]
        );

        $fieldset->addField(
            'position',
            'text',
            [
                'label' => __('Position'),
                'title' => __('Position'),
                'name' => 'position',
            ]
        );

        $fieldset->addField(
            'slide_link',
            'text',
            [
                'label' => __('Slide Link'),
                'title' => __('Slide Link'),
                'name' => 'slide_link',
                'note' => __('Full URL where slide should redirect after click on it.')
            ]
        );

        $fieldset->addField(
            'display_title',
            'text',
            [
                'label' => __('Display Title'),
                'title' => __('Display Title'),
                'name' => 'display_title',
            ]
        );

        $wysiwygConfig = $this->_wysiwygConfig->getConfig(
            [
                'tab_id' => $this->getTabId(),
            ]
        );

        $fieldset->addField(
            'slide_text',
            'editor',
            [
                'label' => __('Slide Text'),
                'title' => __('Slide Text'),
                'name' => 'slide_text',
                'style' => 'height:36em;',
                'config' => $wysiwygConfig,
            ]
        );

        $fieldset->addField(
            'slide_text_position',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'slide_text_position',
                'required' => true,
                'options' => ['0' => __('Left'), '1' => __('Right'), '2' => __('Center')]
            ]
        );

        $values = $model->getData();
        $values['image'] = $model->getImageUrl();

        $form->setValues($values);
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Slide');
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Slide');
    }

    /**
     * @return bool
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * @param  string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
