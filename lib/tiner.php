<?php

function tiner() {
    $router = str_replace('./', '', param('r', 'core'));
    if(strpos($router, '/') === false) $router .= '/index';
    $file = './src/' . $router . '.php';
    if(!file_exists($file)) { echo error('Not Found', 404); return; }
    require_once $file;
    $handler = str_replace('/', '_', $router);
    if(!function_exists($handler)) { echo error('Not Implment'); return; }
    echo $handler();
}

function error($message, $code = 0) {
    return render('core/error', array('message' => $message));
}

function param($key, $default = null) {
    return isset($_REQUEST[$key]) ? $_REQUEST[$key] : $default;
}

function render($name, $data = array()) {
    $__file__ = './src/' . $name . '.phtml';
    extract($data); ob_start(); include $__file__;
    $__content__ = ob_get_contents(); ob_end_clean();
    return $__content__;
}

?>
