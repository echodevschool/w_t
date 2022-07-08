<?php

namespace App\Controller;

use App\Services\Telegram;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TelegramController extends AbstractController
{
    #[Route('/tg/wh', name: 'tg_webhook')]
    public function webhook()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        //{"update_id":396557433,
        //"message":{"message_id":12,"from":{"id":5231676868,"is_bot":false,"first_name":"Vladislav","username":"echo_ref","language_code":"ru"},"chat":{"id":5231676868,"first_name":"Vladislav","username":"echo_ref","type":"private"},"date":1657295244,"text":"TEST123"}}
        $telegram = new Telegram($this->getParameter('telegram.token'));
        $message = file_get_contents('php://input');
        file_put_contents('message.txt', $message);
        $telegram->sendMessage('-1001542886992', $data['message']['text'].' | '.$data['message']['chat']['id']);
    }
}