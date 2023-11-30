<?php
require_once 'message.php';
class GuestBook {

    private $file;

    public function __construct(string $file) {
        $directory = dirname($file); 
        if (!is_dir($directory)) {
            mkdir($directory,0777, true);
        }
        if (!file_exists($file)) {
            touch($file);
        }
        $this->file = $file;
    }

    public function addMessage(Message $message): void {
        file_put_contents($this->file, $message->toJSON() . PHP_EOL, FILE_APPEND);
    }

    public function getMessage(): array {
        $content = trim(file_get_contents($this->file));
        $lines = explode(PHP_EOL, $content);
        $messages = [];

        foreach ($lines as $line) {
            $data = json_decode($line, true);
            
            // Vérifiez si les clés existent avant de créer un nouveau message
            if (isset($data['username'], $data['message'])) {
                $messages[] = new Message($data['username'], $data['message']);
            }
        }    

        return $messages;
    }

    
}