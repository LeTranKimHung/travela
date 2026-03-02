<?php
$dir = 'C:\\xampp\\htdocs\\travela\\resources\\views';

function processDir($path) {
    if(!is_dir($path)) return;
    $files = scandir($path);
    foreach($files as $f) {
        if($f == '.' || $f == '..') continue;
        $fullPath = $path . DIRECTORY_SEPARATOR . $f;
        if(is_dir($fullPath)) {
            processDir($fullPath);
        } else if(strpos($f, '.blade.php') !== false) {
            processFile($fullPath);
        }
    }
}

function processFile($file) {
    $content = file_get_contents($file);
    if(strpos($content, 'number_format') !== false) {
        // We will replace variations manually since it can be complex
        // Actually, a simple regex:
        // {{ number_format($var) }} VNĐ -> {{ number_format($var) }} VNĐ
    }
}
processDir($dir);
echo "Done";
