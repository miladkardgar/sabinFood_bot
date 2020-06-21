<?php

namespace App\Conversations;

use App\User;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\Drivers\Telegram\TelegramDriver;
use Illuminate\Support\Facades\Artisan;

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

    public function start()
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
//                    $this->adminMessage($adminMessage);
                } else {
                    $userID = $u['id'];
                    $adminMessage = $fistName . " " . $lastName . "\n\n" . " وارد سیستم شد.";
//                    $this->adminMessage($adminMessage);
                }
                Artisan::call('cache:clear');
                sleep(2);
                $this->askDay($userID);
            }
        });
    }


    public function askDay($userID)
    {
        $message = "ثبت نام شما تکمیل شد. \n\n";
        $message .= "برای استفاده از ربات میتوانید از منو زیر شروع کنید.\n\n";
        $message .= "رزرو غذا" . "\n";
        $message .= "/reserve" . "\n\n";
        $message .= "مشاهده غذاهای رزرو شده" . "\n";
        $message .= "/reserveList" . "\n";
        $this->say($message);
    }

    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        //
        $this->start();
    }
}
