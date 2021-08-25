<?php
/**
 * Celebros Qwiser - Magento Extension
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish correct extension functionality.
 * If you wish to customize it, please contact Celebros.
 *
 * @category    Celebros
 * @package     Celebros_Celexport
 */
$installer = $this;

$installer->startSetup();

$installer->run("

    DROP TABLE IF EXISTS {$this->getTable('celebros_cronlog')};
    CREATE TABLE {$this->getTable('celebros_cronlog')} (
      `id` int(11) NOT NULL auto_increment,
      `executed_at` timestamp ON UPDATE CURRENT_TIMESTAMP NULL,
      `event` varchar(120),
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->endSetup(); 