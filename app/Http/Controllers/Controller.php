<?php

namespace App\Http\Controllers;

use Http\Adapter\Guzzle6\Client;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected $telegramToken;

    public function __construct()
    {
        $this->telegramToken = env('TELEGRAM_TOKEN');
    }
    public function setWebhook()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get('https://api.telegram.org/bot'.$this->telegramToken.'/setWebhook?url=https://195.248.242.47/botman');

        echo "<hr>";
        echo "<br>";
        echo "<h3>Set Information</h3>";
        echo "<br><br>";
        echo "Result Code: " .  $response->getStatusCode(); # 200
        echo "<br>";
        echo "result: " .  $response->getBody(); # '{"id": 1420053, "name": "guzzle", ...}'
        echo "<br>";
        echo "<hr>";
        $this->info();
    }
    public function getWebhookInfo()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get('https://api.telegram.org/bot'.$this->telegramToken.'/getWebhookInfo');
        echo "<hr>";
        echo "<br>";
        echo "<h3>Info</h3>";
        echo "<br><br>";
        echo "Result Code: " .  $response->getStatusCode(); # 200
        echo "<br>";
        echo "result: " .  $response->getBody(); # '{"id": 1420053, "name": "guzzle", ...}'
        echo "<br>";
        echo "<hr>";


    }
    public function getUpdate()
    {
        $client = new \GuzzleHttp\Client();
        $this->disable();
        $response = $client->get('https://api.telegram.org/bot'.$this->telegramToken.'/getUpdates');
        echo "<hr>";
        echo "<br>";
        echo "<h3>Update Info</h3>";
        echo "<br><br>";
        echo $response->getStatusCode(); # 200
//        echo $response->getBody(); # '{"id": 1420053, "name": "guzzle", ...}'
        $updateId = 0;
        $res = json_decode($response->getBody(), true)['result'];
        if (sizeof($res) >= 1) {
            $this->disable();
            foreach ($res as $val => $item) {
                $updateId = $item['update_id'];
            }
            echo "<br>";
            echo "<h3>delete Pending Message</h3>";
            echo "<br><br>";
            echo "update ID: " .  $updateId;
            echo "<br>";
            $client = new \GuzzleHttp\Client();
            $updateId += 1;
            echo "new Update ID: " . $updateId;
            $response = $client->get('https://api.telegram.org/bot'.$this->telegramToken.'/getUpdates?offset=' . $updateId);
            echo "<br>";
            echo "result: " . $response->getStatusCode(); # 200
            $this->setWebhook();
        }
        echo "<br>";
        echo "<hr>";
        $this->info();

    }
    public function disable()
    {
        $this->info();
        $client = new \GuzzleHttp\Client();
        $response = $client->get('https://api.telegram.org/bot'.$this->telegramToken.'/setWebhook');
        echo "<hr>";
        echo "<br>";
        echo "<h3>disabled</h3>";
        echo "<br><br>";
        echo $response->getStatusCode(); # 200
        echo "<br>";
        echo $response->getBody(); # '{"id": 1420053, "name": "guzzle", ...}'
        echo "<br>";
        echo "<hr>";

    }
    public function info()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get('https://api.telegram.org/bot'.$this->telegramToken.'/getWebhookInfo');
        echo "<hr>";
        echo "<br>";
        echo "<h3>Info</h3>";
        echo "<br><br>";
        echo "Result Code: " .  $response->getStatusCode(); # 200
        echo "<br>";
        echo "result: " .  $response->getBody(); # '{"id": 1420053, "name": "guzzle", ...}'
        echo "<br>";
        echo "<hr>";
    }
}
