<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */
namespace Scandiweb\Slider\Model\ResourceModel\Map;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public function _construct()
    {
        $this->_init('Scandiweb\Slider\Model\Map', 'Scandiweb\Slider\Model\ResourceModel\Map');
    }

    /**
     * @param  int $slideId
     * @return $this
     */
    public function addSlideFilter($sliderId)
    {
        $this->addFieldToFilter('slide_id', $sliderId);

        return $this;
    }
}