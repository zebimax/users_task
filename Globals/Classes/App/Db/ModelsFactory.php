<?php

namespace Globals\Classes\App\Db;


use Globals\Classes\Db;
use Globals\Classes\Exceptions\Db\BadModelException;
use Models;

class ModelsFactory
{
    private static $models = [
        'users' => 'Users',
        'translate_keys' => 'TranslateKeys',
        'translate_data' => 'TranslateData',
        'locales' => 'Locales'
    ];

    private static $modelsDir = 'Models';

    /**
     * @param $model
     * @param Db $db
     * @return mixed
     * @throws BadModelException
     */
    public static function create($model, Db $db)
    {
        if (!isset(self::$models[$model])) {
            throw new BadModelException($model);
        }
        $modelClass = self::$modelsDir . '\\' . self::$models[$model];
        return new $modelClass($db);
    }
} 