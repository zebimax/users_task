<?php
function get_global_config($configKey, $default = null)
{
    $configs = App::getApp()->getConfigs();
    return (isset($configs[$configKey])) ? $configs[$configKey] : $default;
}

function translate($key, $default = '')
{
    $db = App::getApp()
}