<?php

namespace App\Conversations;

use App\User;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\Drivers\Telegram\TelegramDriver;

class startConversation extends Conversation
{

    public $bot;

    public function __construct()
    {
        $bot = app('botman');
    }

    public function adminMessage($Message)
    {
        $bot = app('botman');
        $bot->say("\xF0\x9F\x94\xB4	\xF0\x9F\x94\xB4	\xF0\x9F\x94\xB4	\xF0\x9F\x94\xB4	" . "\n\n" . $Message . "\n\n \xF0\x9F\x94\xB4	\xF0\x9F\x94\xB4	\xF0\x9F\x94\xB4	\xF0\x9F\x94\xB4	", env('ADMIN_ID'), TelegramDriver::class);
    }

    public function storeData()
    {
        $question = Question::create("سلام \n به ربات رزرو غذای سابین خوش آمدید.\n\n
        با این ربات میتوانید غذای ناهار خود را برای هفته جاری رزرو نمایید.")
            ->fallback('Unable to ask question')
            ->callbackId('start')
            ->addButtons([
                Button::create('شروع استفاده از ربات')->value('startUse'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->getValue() === 'startUse') {
                $user = $this->bot->getUser();
                $fistName = $user->getFirstName();
                $lastName = $user->getLastName();
                $username = $user->getUsername();
                $chatId = $user->getId();
                $u = User::where('chat_id', $chatId)->first();
                if (!$u) {
                    $userInfo = new User();
                    $userInfo->first_name = $fistName;
                    $userInfo->last_name = $lastName;
                    $userInfo->chat_id = $chatId;
                    $userInfo->username = $username;
                    $userInfo->save();
                    $userID = $userInfo['id'];
                    $adminMessage = $fistName . " " . $lastName . "\n\n" . " عضو سیستم شد.";
                    $this->adminMessage($adminMessage);
                } else {
                    $userID = $u['id'];
                    $adminMessage = $fistName . " " . $lastName . "\n\n" . " وارد سیستم شد.";
                    $this->adminMessage($adminMessage);
                }
                $this->askDay($userID);
            }
        });
    }


    public function askDay($userID)
    {
        $btn = '';
        for ($currentDay = jdate('N', time()); $currentDay == 7; $currentDay++) {
            $btn .=
                "Button::create('" . jdate("l", strtotime("+" . $currentDay . " days", time())) . "')->value('" . $currentDay . "'),";
        }
        $question = Question::create("لطفاً روز هفته را مشخص نمایید.")
            ->fallback('Unable to ask question')
            ->callbackId('start')
            ->addButtons([
                $btn
            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedDay = $answer->getValue();
            switch ($selectedDay) {
                case 1:
                    break;
                case 2:
                    break;
                case 3:
                    break;
                case 4:
                    break;
                case 5:
                    break;
                case 6:
                    break;
                case 7:
                    break;
            }
        });

    }

    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        //
    }
}
