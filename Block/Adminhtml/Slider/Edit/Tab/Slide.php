<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */
namespace Scandiweb\Slider\Block\Adminhtml\Slider\Edit\Tab;

use Magento\Backend\Block\Widget\Grid as WidgetGrid;

class Slide extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /* @var \Scandiweb\Slider\Model\ResourceModel\Slide\Collection $_slideCollection */
    protected $_slideCollection;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Scandiweb\Slider\Model\ResourceModel\Slide\Collection $slideCollection,
        array $data = []
    ) {
        $this->_slideCollection = $slideCollection;
        parent::__construct($context, $backendHelper, $data);
        $this->setEmptyText(__('No Slider Found'));
    }

    /**
     * @return \Scandiweb\Slider\Block\Adminhtml\Slider\Edit\Tab\Slide
     */
    protected function _prepareCollection()
    {
        $this->setCollection($this->_slideCollection);

        return parent::_prepareCollection();
    }

    /**
     * @return \Scandiweb\Slider\Block\Adminhtml\Slider\Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'image_id',
            [
                'header' => __('Slide Id'),
                'index' => 'image_id',
            ]
        );

        $this->addColumn(
            'title',
            [
                'header' => __('Title'),
                'index' => 'title',
            ]
        );

        $this->addColumn(
            'image',
            [
                'header' => __('Image'),
                'index' => 'image',
                'filter' => false,
            ]
        );

        $this->addColumn(
            'start_time',
            [
                'header' => __('Starting time'),
                'type' => 'datetime',
                'index' => 'start_time',
                'class' => 'xxx',
                'width' => '50px',
                'timezone' => true,
            ]
        );

        $this->addColumn(
            'end_time',
            [
                'header' => __('Ending time'),
                'type' => 'datetime',
                'index' => 'end_time',
                'class' => 'xxx',
                'width' => '50px',
                'timezone' => true,
            ]
        );

        $this->addColumn(
            'position',
            [
                'header' => __('Position'),
                'index' => 'position',
            ]
        );

        $this->addColumn(
            'is_active',
            [
                'header' => __('Status'),
                'index' => 'is_active',
                'type' => 'options',
                'options' => [0 => __('Disabled'), 1 => __('Enabled')],
                'search' => 0
            ]
        );

        $this->addColumn(
            'position',
            [
                'header' => __('Position'),
                'index' => 'position',
            ]
        );

        return $this;
    }
}
