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
class Celebros_Celexport_Helper_Client_Remote
{
    public function send(
        $protocol,
        $config,
        $zipFilePath
    ) {
        if ($protocol == 'sftp') {
            $conn = new Varien_Io_Sftp();
        } else {
            $conn = new Varien_Io_Ftp();
        }

        try {
            $conn->open(
                $config
            );
            $upload = $conn->write(basename($zipFilePath), $zipFilePath);
        } catch (Exception $e){
            return $e;
        }
        
        return $upload;
    }
}