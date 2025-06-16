<?php

namespace App\Livewire;

use App\Events\MessageSent;
use App\Models\ChatMessage;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use GuzzleHttp\Psr7\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class Chat extends Component
{
    use WithFileUploads;

    public $uploadedFile;
    public $users;
    public $selectedUser;
    public $newMessage;
    public $messages;
    public $loginID;

    public function mount()
    {
        $this->users = User::whereNot("id", Auth::id())->latest()->get();
        $this->selectedUser = $this->users->first();
        $this->loadmessages();
        $this->loginID = Auth::id();

    }

    public function selectUsers($id)
    {
        $this->selectedUser = User::find($id);
        $this->loadmessages();
    }

    public function loadmessages()
    {
        $this->messages = ChatMessage::query()
            ->where(function($q){
                $q->where("sender_id", Auth::id())
                    ->where("receiver_id", $this->selectedUser->id);
            })
            ->orWhere(function($q){
                $q->where("sender_id", $this->selectedUser->id)
                    ->where("receiver_id", Auth::id());
            })->get();
            
    }

    public function submit()
    {
        if (!$this->newMessage && !$this->uploadedFile) return;

        $data = [
            "sender_id" => Auth::id(),
            "receiver_id" => $this->selectedUser->id,
            "message" => $this->newMessage,
        ];

        if ($this->uploadedFile) {
            $file = $this->uploadedFile->store('chat_files', 'public');

            $data['file_path'] = $file;
            $data['file_name'] = $this->uploadedFile->getClientOriginalName();
            $data['file_type'] = $this->uploadedFile->getMimeType();
            $data['file_size'] = $this->uploadedFile->getSize();
        }

        $message = ChatMessage::create($data);

        $this->messages->push($message);
        $this->newMessage = '';
        $this->uploadedFile = null;

        broadcast(new MessageSent($message));
    }


    public function updatedNewMessage($value)
    {
        $this->dispatch("userTyping", userID: $this->loginID, userName: Auth::user()->name, selectedUserID: $this->selectedUser->id);
    }

    public function getListeners() 
    {
        return [
            "echo-private:chat.{$this->loginID},MessageSent" => "newChatMessageNotification"
        ];
    }

    public function newChatMessageNotification($message)
    {
        if($message['sender_id'] == $this->selectedUser->id) {
            $messageObj = ChatMessage::find($message['id']);
            $this->messages->push($messageObj);
        }
    }

    public function removeFile()
    {
        $this->uploadedFile = null;
    }


    public function render()
    {
        return view('livewire.chat');
    }
}
