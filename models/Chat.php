<?php
    class Chat extends DataBase
    {
        public function insert($data){

            $message      = $data['message'];
            $user_id      = $data['user_id'];
            $message_type = $data['message_type'];

            $sql = $this->conn->prepare("INSERT INTO messages (`message`, `message_type`, `user_id`) 
                                        VALUES  (?,?,?)");
            return $sql->execute(array($message,$message_type,$user_id));
        }

    }