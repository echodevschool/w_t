<?php

namespace App\Controller;

use App\Services\Telegram;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TelegramController extends AbstractController
{
    #[Route('/tg/wh', name: 'tg_webhook')]
    public function webhook()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            //file_put_contents($this->getParameter('kernel.project_dir').'/public/request_tg.txt', $this->makeContent(var_export($data, true)), FILE_APPEND);
            $telegram = new Telegram($this->getParameter('telegram.token'));
            if (isset($data['message']['chat']['id']) && isset($data['message']['text'])) {
                $text = 'don\'t know';
                if ($data['message']['text'] === 'secret') {
                    $text = 'Congratulations!';
                }
                $telegram->sendMessage($data['message']['chat']['id'], $text);
            }

            return new JsonResponse(1);
        } catch (\Exception $exception) {
            file_put_contents($this->getParameter('kernel.project_dir').'/public/error_tg.txt', $this->makeContent($exception->getMessage()), FILE_APPEND);
        }
    }

    private function makeContent($data): string
    {
        return '============================================================'.PHP_EOL
            .(new \DateTime())->format('d.m.Y H:i:s').PHP_EOL
            .'============================================================'.PHP_EOL
            .$data.PHP_EOL
            .'============================================================'.PHP_EOL;
    }
}