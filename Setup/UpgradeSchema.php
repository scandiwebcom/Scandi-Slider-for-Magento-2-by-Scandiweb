<?php
/**
 * @vendor Scandiweb
 * @module Scandiweb_Slider
 * @author Kristaps Stalidzāns <info@scandiweb.com>
 * @copyright Copyright (c) 2017 Scandiweb, Ltd (http://scandiweb.com)
 * @license http://opensource.org/licenses/afl-3.0.php Academic Free License (AFL 3.0)
 */
namespace Scandiweb\Slider\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Scandiweb\Slider\Setup\Setup as ParentSetup;

class UpgradeSchema extends ParentSetup implements UpgradeSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    )
    {
        $this->_content = $context;
        $setup->startSetup();

        if ($this->getVersion('1.0.2')) {
            $this->addCustomerEmailColumn($setup);
        }

        $setup->endSetup();
    }

    /**
     * Adds email column to review table
     *
     * @param $setup
     */
    protected function addCustomerEmailColumn($setup)
    {
        // Get module table
        $tableName = $setup->getTable('scandiweb_slider_slide');

        // Check if the table already exists
        if ($setup->getConnection()->isTableExists($tableName)) {

            $connection = $setup->getConnection();
            $connection->addColumn(
                $tableName,
                'image_mobile',
                [
                    'type' => Table::TYPE_TEXT,
                    'length' => 150,
                    'nullable' => true,
                    'comment' => 'Mobile image'
                ]
            );
        }
    }
}
