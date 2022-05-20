<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb1b2b6e99a44a08bd0e376f12b35bcb5
{
    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'OLERead' => __DIR__ . '/../..' . '/php-excel-reader/excel_reader2.php',
        'SpreadsheetReader' => __DIR__ . '/../..' . '/SpreadsheetReader.php',
        'SpreadsheetReader_CSV' => __DIR__ . '/../..' . '/SpreadsheetReader_CSV.php',
        'SpreadsheetReader_ODS' => __DIR__ . '/../..' . '/SpreadsheetReader_ODS.php',
        'SpreadsheetReader_XLS' => __DIR__ . '/../..' . '/SpreadsheetReader_XLS.php',
        'SpreadsheetReader_XLSX' => __DIR__ . '/../..' . '/SpreadsheetReader_XLSX.php',
        'Spreadsheet_Excel_Reader' => __DIR__ . '/../..' . '/php-excel-reader/excel_reader2.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInitb1b2b6e99a44a08bd0e376f12b35bcb5::$classMap;

        }, null, ClassLoader::class);
    }
}
