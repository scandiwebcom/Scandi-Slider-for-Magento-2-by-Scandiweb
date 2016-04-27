<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */
namespace Scandiweb\Slider\Model\ResourceModel\Slide;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public function _construct()
    {
        $this->_init('Scandiweb\Slider\Model\Slide', 'Scandiweb\Slider\Model\ResourceModel\Slide');
    }

    /**
     * @param  int $sliderId
     * @return \Scandiweb\Slider\Model\ResourceModel\Slide\Collection
     */
    public function addSliderFilter($sliderId)
    {
        $this->addFieldToFilter('slider_id', $sliderId);

        return $this;
    }

    /**
     * @param  bool $isActive
     * @return \Scandiweb\Slider\Model\ResourceModel\Slide\Collection
     */
    public function addIsActiveFilter($isActive = true)
    {
        $this->addFieldToFilter('is_active', $isActive);

        return $this;
    }
}
