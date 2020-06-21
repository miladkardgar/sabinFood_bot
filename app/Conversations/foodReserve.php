<?php

namespace App\Conversations;

use App\dayFood;
use App\reserve;
use App\User;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use Illuminate\Support\Facades\Artisan;

class foodReserve extends Conversation
{

    public function start()
    {
        $userInfo = $this->bot->getUser();
        $user = User::where('chat_id', $userInfo->getId())->first();
        if (isset($user['id'])) {
            $date = date("Y-m-d", time());
            $data = dayFood::with('food')->where('date', '>', $date)->limit(5)->get();
            $final = $data->map(function ($data) {
                $type = 'شام';
                if ($data['type'] == 'lunch') {
                    $type = 'ناهار';
                }
                return [
                    'id' => $data['id'],
                    'title' => $data['food']['title'],
                    'price' => $data['food']['price'],
                    'type' => $type,
                    'date' => $data['date']
                ];
            })->toArray();
            foreach ($final as $item) {
                $this->bot->userStorage()->save([
                    'user_id' => $user['id']
                ]);
                $message = "کاربر: " . $user['first_name'] . " " . $user['last_name'] . "\n";
                $message .= "تاریخ: ";
                $message .= jdate("l | d | F | y", strtotime($item['date'])) . "\n";
                $message .= "نوع غذا:" . " ";
                $message .= $item['title'] . "\n";
                $message .= "قیمت:" . " ";
                $message .= number_format($item['price']) . " تومان\n";
                $message .= "وعده:" . " ";
                $message .= $item['type'] . "\n";
                $question = Question::create($message)
                    ->fallback('Unable to ask question')
                    ->callbackId('start')
                    ->addButtons(
                        [
                            Button::create('رزرو')->value('dayID_' . $item['id'])
                        ]);

                $this->ask($question, function (Answer $answer) {
                    $response = $answer->getValue();
                    $response = explode("_", $response);
                    $this->bot->userStorage()->save([
                        'foodDay' => $response[1],
                    ]);
                    $this->askDescription();
                });
            }
        } else {
            $this->say('کاربر غیر مجاز');
        }
    }

    public function askDescription()
    {
        $message = "توضیحات مربوط به سفارش را تایپ نمایید.";
        $question = Question::create($message)
            ->fallback('Unable to ask question')
            ->callbackId('start')
            ->addButtons(
                [
                    Button::create('توضیحی ندارم.')->value('none')
                ]);

        $this->ask($question, function (Answer $answer) {
            $response = $answer->getValue();
            if ($response == "none") {
                $description = '';
            } else {
                $description = $answer->getText();
            }
            $checkUser = reserve::where(
                [
                    ['user_id', '=', $this->bot->userStorage()->get('user_id')],
                    ['dayFood_id', '=', $this->bot->userStorage()->get('foodDay')],
                ]
            )->first();
            if (!isset($checkUser['id'])) {
                reserve::create(
                    [
                        'user_id' => $this->bot->userStorage()->get('user_id'),
                        'dayFood_id' => $this->bot->userStorage()->get('foodDay'),
                        'description' => $description
                    ]
                );
            $dayInfo = dayFood::find($this->bot->userStorage()->get('foodDay'));
            $message = "✅ روزو غذا برای روز " . "\n\n 📆️" . jdate("l | d | F | y", strtotime($dayInfo['date'])) . "\n\n" . "با موفقیت انجام پذیرفت.😊";
            $this->say($message);
            }else{
                $message = "رزرو غذای شما قبلا ثبت شده است.";
                $this->say($message);
            }
        });

}

/**
 * Start the conversation.
 *
 * @return mixed
 */
public
function run()
{
    //
    $this->start();
}
}
