<?php

namespace BeholderAction;

use VK\Client\VKApiClient;

class Send
{
    /**
     * Отправляет сообщение
     * @param string $message Представляет сообщение в которое можно сделать вставки: {group} - Название сообщества, {user} - Фамилия Имя (tag)
     * @summary 
     */
    public static function sendMessage(string $message, int $group_id, array $object)
    {
        $client = new VKApiClient('5.131');
        $user_id = $object["user_id"];

        $user = $client->users()->get(Config::ACCESS_TOKEN, [
            "user_ids" => "$user_id",
            "fields" => "domain"
        ])[0];
        $group = $client->groups()->getById(Config::ACCESS_TOKEN, [
            "group_id" => "$group_id",
            "fields" => "name"
        ])[0];

        // Заменяет {user} на такой вид: Фамилия Имя (tag)
        $message = preg_replace('/{user}/', "[id$user_id|{$user["last_name"]} {$user["first_name"]} ({$user["domain"]})]", $message) ?? $message;

        // Заменяет {group} на такой вид: Название сообщества
        $message = preg_replace('/{group}/', "[club$group_id|{$group["name"]}]", $message) ?? $message;

        $client->messages()->send(Config::ACCESS_TOKEN, [
            "user_id" => $user_id,
            "random_id" => 0,
            "message" => $message
        ]);
    }
}
