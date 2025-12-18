<?php

namespace App\Livewire;

use Livewire\Component;
use OpenAI;

class ChatBot extends Component
{
    public $thread , $message  , $response , $temp ;
    public $type = 'text';
    public $chats , $thisChat = [] ;


    public function render()
    {
        return view('livewire.chat-bot');
    }

    public function sendMessage()
    {
        $client = OpenAI::client(env('OPENAI_API_KEY'));
        $result = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $this->message],
            ]
        ]);
        $this->response = $result->choices[0]->message->content;
        
    }
}
