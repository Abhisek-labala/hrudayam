<?php
if (!function_exists('load_mpdf')) {
    function load_mpdf() {
        // Path to mpdf autoload
        include_once APPPATH . 'third_party/mpdf/vendor/autoload.php';
        
        // If manually loaded without autoloader
        // include_once APPPATH . 'third_party/mpdf/src/Mpdf.php';
        
        return new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_header' => 10,
            'margin_footer' => 10,
            'tempDir' => sys_get_temp_dir() . '/mpdf' // Optional: Set a temp directory
        ]);
    }
}