<?php
class Message {

    private $message;
    private $username;

    public function __construct(string $username, string $message, ?Datetime $date=null) 
    {
        $this->username = $username;
        $this->message = $message;
    }


    public function isValide()
    {
        return empty($this->getError());
    }

    public function getError(){
        $errors = [];
        if (strlen($this->username)<3)
        {
            $errors["username"] = "Le pseudo est trop court";
        };
        if (strlen($this->message)< 10){
            $errors["message"] = "Le message est trop court";
        }

        return $errors;
    }

    function toHTML() {
        return <<<HTML
        <strong>{$this->username}</strong></br>
        <p>{$this->message}</p>
HTML;    
}
    
    public function toJSON(): string
    {
        return json_encode([ 
         'username' => $this->username,
         'message' => $this->message,
        ]);
    }


}