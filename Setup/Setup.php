<?php
/**
 * @vendor Scandiweb
 * @module Scandiweb_Slider
 * @author Kristaps Stalidzāns <info@scandiweb.com>
 * @copyright Copyright (c) 2017 Scandiweb, Ltd (http://scandiweb.com)
 * @license http://opensource.org/licenses/afl-3.0.php Academic Free License (AFL 3.0)
 */
namespace Scandiweb\Slider\Setup;

use Magento\Framework\Setup\ModuleContextInterface;

abstract class Setup
{
    /**
     * @var ModuleContextInterface
     */
    protected $_content;

    /**
     * @param $version
     * @return bool
     */
    public function getVersion($version)
    {
        if (version_compare($this->_content->getVersion(), $version, '<')) {
            $this->registerVersion($version);

            return true;
        }

        return false;
    }

    /**
     * @param $version
     */
    protected function registerVersion($version)
    {
        $this->printLine("\033[35mSlider migration version " . $version . " \033[0m");
    }

    /**
     * @param $message
     */
    protected function printLine($message)
    {
        echo PHP_EOL . $message . PHP_EOL;
    }
}
