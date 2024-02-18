<?php

namespace common\services;

use linslin\yii2\curl\Curl;

class SmsPilotService
{
    public const API_URL = 'https://smspilot.ru/api.php';
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = getenv('SMS_PILOT_API_KEY');
    }

    /**
     * @throws \Exception
     */
    public function sendOne(string $message, string $phoneNumber): array
    {
        $curl = new Curl();

        $curl->get(self::API_URL, [
            'send' => $message,
            'to' => $phoneNumber,
            'apikey' => $this->apiKey,
        ]);

        return [
            $curl->response,
            $curl->responseCode
        ];
    }
}
