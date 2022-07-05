<?php

namespace App\Services;

use GuzzleHttp\Client;

class Telegram
{
    public function __construct(protected string $token) {}

    public function sendMessage(string | int $chatId, string $text, array $additionalParams = [])
    {
        $request = [
            'chatId' => $chatId,
            'text' => $text
        ];

        if (isset($additionalParams['parse_mode'])) {
            $request['parse_mode'] = $additionalParams['parse_mode'];
        }
        if (isset($additionalParams['disable_web_page_preview'])) {
            $request['disable_web_page_preview'] = $additionalParams['disable_web_page_preview'];
        }
        if (isset($additionalParams['disable_notification'])) {
            $request['disable_notification'] = $additionalParams['disable_notification'];
        }
        if (isset($additionalParams['reply_to_message_id'])) {
            $request['reply_to_message_id'] = $additionalParams['reply_to_message_id'];
        }
        if (isset($additionalParams['reply_markup'])) {
            $request['reply_markup'] = $additionalParams['reply_markup'];
        }

        $this->handleRequest('sendMessage', $request);
    }

    protected function handleRequest(string $method, array $request)
    {
        //dd($request);
        $client = new Client();
        $url = 'https://api.telegram.org/'.$this->token.'/'.$method;
        $client->request('GET', 'https://api.telegram.org/bot5137970276:AAFUmw3IFBKcL4TvsMPY1d_4obI54s9oN_E/sendMessage', [
            'query' => $request
        ]);
//        $response = $client->post($url, [
//            'query' => $request
//        ]);
//        $content = $response->getBody()->getContents();
//        dd($content);
    }
}