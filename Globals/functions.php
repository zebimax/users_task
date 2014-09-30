<?php
use Globals\Classes\Exceptions\NotLocaleException;

defined('DEFAULT_LANG') || define('DEFAULT_LANG', 'ru');
function get_global_config($configKey, $default = null)
{
    return App::getApp()->getConfig($configKey, $default);
}

function translate($key, $default = '')
{
    $default = $default ? $default : $key;
    $app = App::getApp();
    $db = $app->getDb();
    if ($app->getIdentity()->getIsAuth()) {
        $locale = $app->getIdentity()->getLocale();
    } else {
        $locale = $db->getModel('locales')->getBy(['lang' => DEFAULT_LANG]);
    }

    if ((!isset($locale['id']) || !$locale['id'])) {
        if (!$app->getConfig('strict_locale')) {
            return $default;
        }
        throw new NotLocaleException('');
    }
    $query = 'SELECT d.translate
                FROM translate_keys k JOIN translate_data d
                ON d.key_id = k.id
                WHERE k.key = ? and d.locale_id = ?';

    $result = $db->execute($query, [$key, $locale['id']]);
    $str = isset($result['translate']) ? $result['translate'] : $default;
    return $str;
}

function get_identity()
{
    return App::getApp()->getIdentity();
}