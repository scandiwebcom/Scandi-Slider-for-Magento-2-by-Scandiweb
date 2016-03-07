<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */
namespace Scandiweb\Slider\Block\Adminhtml\Slider;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /* @var \Magento\Framework\Registry */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'slider_id';
        $this->_blockGroup = 'Scandiweb_Slider';
        $this->_controller = 'adminhtml_slider';

        parent::_construct();

        if ($this->_isAllowedAction('Scandiweb_Slider::slider_save')) {
            $this->buttonList->update('save', 'label', __('Save Slider'));
            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Save and Continue Edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                        ],
                    ]
                ],
                -100
            );
        } else {
            $this->buttonList->remove('save');
        }

        if ($this->_isAllowedAction('Scandiweb_Slider::slider_delete')) {
            $this->buttonList->update('delete', 'label', __('Delete Slider'));
        } else {
            $this->buttonList->remove('delete');
        }
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('slider')->getId()) {
            return __("Edit Slider '%1'", $this->escapeHtml($this->_coreRegistry->registry('slider')->getTitle()));
        } else {
            return __('New Slider');
        }
    }

    /**
     * @param  string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    /**
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl(
            'slideradmin/*/save',
            ['_current' => true, 'back' => 'edit', 'active_tab' => '{{tab_id}}']
        );
    }
}
