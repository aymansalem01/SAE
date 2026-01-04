<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Session;
use Livewire\Component;
use OpenAI;

class ForTest extends Component
{
    public  $message, $response, $tempM;
    public $type = 'text';
    public $chats, $thisChat = [];
    public function render()
    {
        return view('livewire.for-test');
    }

    public function mount()
    {
        $this->thisChat = Session::get('chat_history', []);
    }
    public function sendMessage($message)
    {
        if($message == ""){
            return;
        }

        $this->reset('message');
        $this->tempM = $message;
        $this->thisChat[] = [
            'role' => 'user',
            'content' => $this->tempM,
            'time' => now('Asia/Amman')->format('h:i A')
        ];

        $client = OpenAI::client(env('OPENAI_API_KEY'));
        $result = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $this->tempM],
            ]
        ]);
        $this->response = $result->choices[0]->message->content;
        $this->thisChat[] = [
            'role' => 'ai',
            'content' => $this->response
        ];

        Session::put('chat_history', $this->thisChat);
        $this->reset('response');
    }

    public function clearChat()
    {
        Session::put('chat_history',[]);
        $this->mount();
    }

}
