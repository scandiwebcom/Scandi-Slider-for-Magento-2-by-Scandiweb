<?php
/**
 * Scandiweb_Slide
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slide
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */
namespace Scandiweb\Slider\Block\Adminhtml\Map;

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

    protected function _construct()
    {
        $this->_objectId = 'map_id';
        $this->_blockGroup = 'Scandiweb_Slider';
        $this->_controller = 'adminhtml_map';

        parent::_construct();

        if ($this->_isAllowedAction('Scandiweb_Slide::map_save')) {
            $this->buttonList->update('save', 'label', __('Save Image Map'));
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

        if ($this->_isAllowedAction('Scandiweb_Slider::map_delete')) {
            $this->buttonList->update('delete', 'label', __('Delete Image Map'));
        } else {
            $this->buttonList->remove('delete');
        }
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('map')->getId()) {
            return __("Edit Image Map '%1'", $this->escapeHtml($this->_coreRegistry->registry('map')->getTitle()));
        } else {
            return __('New Image Map');
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

    /**
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl(
            'slideradmin/slide/edit',
            ['slide_id' => $this->_coreRegistry->registry('map')->getSlideId()]
        );
    }
}
