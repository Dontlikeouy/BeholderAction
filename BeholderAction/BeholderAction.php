<?php

namespace BeholderAction;

use Generator\Skeleton\skeleton\base\src\VK\CallbackApi\VKCallbackApiLongPollExecutor;
use VK\Client\VKApiClient;

class BeholderAction
{
    private CallbackHandler $handler;
    private VKCallbackApiLongPollExecutor $executor;

    public function __construct(int $group_id, string $access_token)
    {
        $client = new VKApiClient('5.131');

        $this->handler = new CallbackHandler();
        $this->executor = new VKCallbackApiLongPollExecutor(
            $client,
            $access_token,
            $group_id,
            $this->handler
        );
    }
    public function listen()
    {
        $ts = time();
        while (true) {
            try {
                $ts = $this->executor->listen($ts);
            } catch (\Exception $ex) {
            }
        }
    }
}
