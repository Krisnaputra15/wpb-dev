<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Snappy PDF / Image Configuration
    |--------------------------------------------------------------------------
    |
    | This option contains settings for PDF generation.
    |
    | Enabled:
    |
    |    Whether to load PDF / Image generation.
    |
    | Binary:
    |
    |    The file path of the wkhtmltopdf / wkhtmltoimage executable.
    |
    | Timeout:
    |
    |    The amount of time to wait (in seconds) before PDF / Image generation is stopped.
    |    Setting this to false disables the timeout (unlimited processing time).
    |
    | Options:
    |
    |    The wkhtmltopdf command options. These are passed directly to wkhtmltopdf.
    |    See https://wkhtmltopdf.org/usage/wkhtmltopdf.txt for all options.
    |
    | Env:
    |
    |    The environment variables to set while running the wkhtmltopdf process.
    |
    */

    'pdf' => [
        'enabled' => true,
        'binary'  => env('WKHTML_PDF_BINARY', 'C:\PROGRA~1\wkhtmltopdf\bin\wkhtmltopdf.exe'),
        'timeout' => false,
        'options' => [
            'enable-local-file-access' => true, // Allow loading local files (CSS, images)
            'no-stop-slow-scripts' => true,    // Prevent stopping slow scripts
            'disable-smart-shrinking' => true, // Prevent layout distortion
            'margin-top' => 10,
            'margin-right' => 10,
            'margin-bottom' => 10,
            'margin-left' => 10,
            'page-size' => 'A4',
            'encoding' => 'UTF-8',
        ],
        'env'     => [],
    ],

    'image' => [
        'enabled' => true,
        'binary'  => env('WKHTML_IMG_BINARY', 'C:\PROGRA~1\wkhtmltopdf\bin\wkhtmltoimage.exe'),
        'timeout' => false,
        'options' => [
            'enable-local-file-access' => true,
        ],
        'env'     => [],
    ],

];
