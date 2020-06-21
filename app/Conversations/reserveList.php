<?php

namespace App\Conversations;

use App\reserve;
use App\User;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class reserveList extends Conversation
{

    public function list()
    {
        $userInfo = $this->bot->getUser();
        $date = strtotime(date("Y/m/d 00:00:00"));
        $dateEnd = strtotime(date("Y/m/d 23:59:59"));
        $user = User::where('chat_id', $userInfo->getId())->first();
        if (isset($user['id'])) {
            $lists = reserve::with('foodDay')->where('user_id', $user['id'])->get();
            if (sizeof($lists) >= 1) {
                foreach ($lists as $list) {
                    if (strtotime($list['foodDay']['date']) >= $date) {
                        $message = '🍱 غذا: ' . $list['foodDay']['food']['title'] . "\n\n";
                        $message .= '🗓 تاریخ: ' . jdate("l | d | F | y", strtotime($list['foodDay']['date']));
                        if (strtotime($list['foodDay']['date']) > $date || strtotime($list['foodDay']['date']) > $dateEnd) {
                            $question = Question::create($message)
                                ->fallback('Unable to ask question')
                                ->callbackId('start')
                                ->addButtons(
                                    [
                                        Button::create('حذف')->value('dayID_' . $list['id'])
                                    ]);
                            $this->ask($question, function (Answer $answer) {

                                $response = $answer->getValue();
                                $response = explode('_', $response);
                                if (isset($response[1])) {
                                    $reserve = reserve::find($response[1]);
                                    $reserve->delete();
                                    $message = 'رزرو غذای شما حذف گردید.' . "\n\n";
                                    $message .= 'رزرو غذا' . "\n";
                                    $message .= '/reserve';
                                    $this->say($message);
                                } else {
                                    $this->list();
                                }

                            });
                        } else {
                            $this->say($message);
                        }
                    } else {
                        $message = 'شما غذای رزرو شده ای در سیستم ندارید.' . "\n\n";
                        $message .= 'رزرو غذا' . "\n";
                        $message .= '/reserve';
                        $this->say($message);
                    }
                }
            } else {
                $message = 'شما غذای رزرو شده ای در سیستم ندارید.' . "\n\n";
                $message .= 'رزرو غذا' . "\n";
                $message .= '/reserve';
                $this->say($message);
            }
        }
    }

    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        //
        $this->list();
    }
}
