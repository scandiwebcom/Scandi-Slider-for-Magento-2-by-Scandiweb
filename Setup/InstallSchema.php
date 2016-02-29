<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */
namespace Scandiweb\Slider\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        /**
         * Create slider table
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('scandiweb_slider'))
            ->addColumn(
                'slider_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Slider id'
            )->addColumn(
                'block_id',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Slider block id'
            )->addColumn(
                'title',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Slider title'
            )->addColumn(
                'is_active',
                Table::TYPE_SMALLINT,
                null,
                ['nullable' => false, 'default' => '1'],
                'Is slider active'
            )->addColumn(
                'show_menu',
                Table::TYPE_SMALLINT,
                null,
                ['default' => '1'],
                'Show slide menu'
            )->addColumn(
                'show_navigation',
                Table::TYPE_SMALLINT,
                null,
                ['default' => '1'],
                'Show slide navigation'
            )->addColumn(
                'slide_speed',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'default' => 0],
                'Slide speed'
            )->addColumn(
                'position',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'default' => 0],
                'Slide speed'
            )->addColumn(
                'animation_speed',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'default' => 0],
                'Animation speed'
            )->addColumn(
                'slides_to_display',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'default' => 0],
                'Slides to display'
            )->addColumn(
                'slides_to_scroll',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'default' => 0],
                'Slides to scroll'
            )->addColumn(
                'lazy_load',
                Table::TYPE_SMALLINT,
                null,
                ['default' => '0'],
                'Use lazy load'
            )->addColumn(
                'slides_to_display_tablet',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'default' => '0'],
                'Slides to display on tablet'
            )->addColumn(
                'slides_to_scroll_tablet',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'default' => '0'],
                'Slides to scroll on tablet'
            )->addColumn(
                'slides_to_display_mobile',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'default' => '0'],
                'Slides to display on mobile'
            )->addColumn(
                'slides_to_scroll_mobile',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'default' => '0'],
                'Slides to scroll on mobile'
            )->addIndex(
                $installer->getIdxName('scandiweb_slider', ['slider_id']),
                ['slider_id']
            )->addIndex(
                $installer->getIdxName('scandiweb_slider', ['position']),
                ['position']
            )->setComment(
                'Slider table'
            );
        $installer->getConnection()->createTable($table);

        /**
         * Create slider image table
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('scandiweb_slider_image'))
            ->addColumn(
                'image_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Image id'
            )->addColumn(
                'slider_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Slider id'
            )->addColumn(
                'title',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Slide title'
            )->addColumn(
                'image_location',
                Table::TYPE_TEXT,
                255,
                [],
                'Image location'
            )->addColumn(
                'is_active',
                Table::TYPE_SMALLINT,
                null,
                ['nullable' => false, 'default' => '1'],
                'Image is active'
            )->addColumn(
                'position',
                Table::TYPE_INTEGER,
                null,
                ['nullable' => false, 'default' => '0'],
                'Slide position'
            )->addColumn(
                'slide_link',
                Table::TYPE_TEXT,
                255,
                ['nullable' => true],
                'Slide link'
            )->addColumn(
                'slide_link_text',
                Table::TYPE_TEXT,
                1000,
                ['nullable' => true],
                'Slide link text'
            )->addColumn(
                'display_title',
                Table::TYPE_TEXT,
                255,
                ['nullable' => true],
                'Slide title to display'
            )->addColumn(
                'slide_text',
                Table::TYPE_TEXT,
                4096,
                ['nullable' => true],
                'Slide text to display'
            )->addColumn(
                'iframe_url',
                Table::TYPE_TEXT,
                1000,
                ['nullable' => true],
                'Iframe url'
            )->addColumn(
                'slide_text_position',
                Table::TYPE_SMALLINT,
                null,
                ['nullable' => false, 'default' => '0'],
                'Slide text position'
            )->addIndex(
                $installer->getIdxName('scandiweb_slider_image', ['image_id']),
                ['image_id']
            )->addIndex(
                $installer->getIdxName('scandiweb_slider_image', ['slider_id']),
                ['slider_id']
            )->addIndex(
                $installer->getIdxName('scandiweb_slider_image', ['position']),
                ['position']
            )->addForeignKey(
                $installer->getFkName('scandiweb_slider_image', 'slider_id', 'scandiweb_slider', 'slider_id'),
                'slider_id',
                $installer->getTable('scandiweb_slider'),
                'slider_id',
                Table::ACTION_CASCADE
            )->setComment(
                'Slider image table'
            );
        $installer->getConnection()->createTable($table);

        $table = $installer->getConnection()
            ->newTable($installer->getTable('scandiweb_slider_image_store'))
            ->addColumn(
                'image_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Image id'
            )->addColumn(
                'store_id',
                Table::TYPE_SMALLINT,
                null,
                ['unsigned' => true, 'nullable' => false, 'primary' => true],
                'Store ID'
            )->addIndex(
                $installer->getIdxName('scandiweb_slider_image_store', ['image_id']),
                ['image_id']
            )->addForeignKey(
                $installer->getFkName('scandiweb_slider_image_store', 'image_id', 'scandiweb_slider_image', 'image_id'),
                'image_id',
                $installer->getTable('scandiweb_slider_image'),
                'image_id',
                Table::ACTION_CASCADE
            )->addForeignKey(
                $installer->getFkName('scandiweb_slider_image_store', 'store_id', 'store', 'store_id'),
                'store_id',
                $installer->getTable('store'),
                'store_id',
                Table::ACTION_NO_ACTION
            )->setComment(
                'Slider image to store linkage table'
            );
        $installer->getConnection()->createTable($table);

        $table = $installer->getConnection()
            ->newTable($installer->getTable('scandiweb_slider_image_map'))
            ->addColumn(
                'image_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Image id'
            )->addColumn(
                'title',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Image map title'
            )->addColumn(
                'coordinates',
                Table::TYPE_TEXT,
                null,
                ['nullable' => false],
                'Map coordinates'
            )->addColumn(
                'is_active',
                Table::TYPE_SMALLINT,
                null,
                ['default' => '1'],
                'Map is active'
            )->addColumn(
                'product_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => true],
                'Product id'
            )->addIndex(
                $installer->getIdxName('scandiweb_slider_image_map', ['image_id']),
                ['image_id']
            )->addForeignKey(
                $installer->getFkName('scandiweb_slider_image_map', 'image_id', 'scandiweb_slider_image', 'image_id'),
                'image_id',
                $installer->getTable('scandiweb_slider_image'),
                'image_id',
                Table::ACTION_CASCADE
            );

        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
