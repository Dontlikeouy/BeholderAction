<?php

namespace BeholderAction;

use VK\CallbackApi\VKCallbackApiHandler;

class CallbackHandler extends VKCallbackApiHandler
{
	private static function joinMassage($message_begin, $message_general)
	{
		$message = "";
		$message .= $message_begin[rand(0, count($message_begin) - 1)];
		for ($i = 0; $i < rand(1, 3); $i++) {
			$message .= ", ";
			$message .= $message_general[rand(0, count($message_general) - 1)];
		}
		$message .= ".";
		return $message;
	}
	public function groupLeave(int $group_id, ?string $secret, array $object)
	{
		try {
			Send::sendMessage(message: CallbackHandler::joinMassage(Config::$leaveGroup_begin, Config::$leaveGroup), group_id: $group_id, object: $object);
		} catch (\Throwable $th) {
			Error::writeError($th);
		}
	}

	public function groupJoin(int $group_id, ?string $secret, array $object)
	{
		try {
			Send::sendMessage(message: CallbackHandler::joinMassage(Config::$joinGroup_begin, Config::$joinGroup), group_id: $group_id, object: $object);
		} catch (\Throwable $th) {
			Error::writeError($th);
		}
	}
}
