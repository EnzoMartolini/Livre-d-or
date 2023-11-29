<?php
class Message {

    private $message;
    private $username;
    private $date;

    public function __construct(string $username, string $message, ?Datetime $date=null) 
    {
        $this->username = $username;
        $this->message = $message;
        $this->date = $date;
    }


    public function isValide()
    {
        if (strlen($this->username)<3)
        {
            return "Ce pseudo est trop court";
        }
        if (strlen($this->message)<10)
        {
            return "Le message est trop court";
        }
    }
    


}