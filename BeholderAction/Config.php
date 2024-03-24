<?php

namespace BeholderAction;

use VK\Client\VKApiClient;

class Config
{

    public const GROUP_ID = 0;
    public const ACCESS_TOKEN = "";

    public static function readJson(string $path)
    {
        if (file_exists($path)) {
            return json_decode(file_get_contents($path));
        } else {
            return NULL;
        }
    }

    //Сообщения при отписки от группы
    public static $leaveGroup_begin;
    public static $leaveGroup;


    //Сообщения при подписки на в группы
    public static $joinGroup_begin;
    public static $joinGroup;

    public static function init()
    {
        try {
            Config::$leaveGroup_begin = Config::readJson("Assets\leaveGroup\leaveGroup_begin.json");
            Config::$leaveGroup = Config::readJson("Assets\leaveGroup\leaveGroup.json");
            Config::$joinGroup_begin = Config::readJson("Assets\joinGroup\joinGroup_begin.json");
            Config::$joinGroup = Config::readJson("Assets\joinGroup\joinGroup.json");
        } catch (\Throwable $th) {
            Error::writeError($th);
        }
    }
}
