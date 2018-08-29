<?php
    require "../controlers/UserController.php";
    session_start();
    if (isset($_GET['messages'])){

        foreach( UserController::getAllMessages() as $message):

            //status of user
            if ($message->status == 0){
               $online  = "offline-icon";
            }else{
               $online  = "online-icon";
            }

            //show messages
           if ($_SESSION['user_id'] == $message->user_id ):
               $msg_content = placeMessage($message);
                echo " <div class=\"right-message-area\">
                    <div class=\"right-message\">
    
                        <div class=\"right-sender-name-date\">
    
                            <span class=\"message-time\">$message->msg_time</span>
                        </div>
                        <div class=\"right-message-content\">
                           $msg_content
                        </div>
    
                    </div>
                </div>";
            else:
                echo "<div class=\"left-message-area\">
                <div class=\"sender-img-block\">
                    <img src=\"/uploads/$message->img\" class=\"sender-img\">
                    
                    <span class=\"$online\"></span>
                </div>
                <div class=\"left-message\">

                    <div class=\"sender-name-date\">
                        <span class=\"sender-name\">$message->name</span>
                        <span class=\"message-time\">$message->msg_time</span>
                    </div>
                    <div class=\"left-message-content\">
                        <p>
                            $message->message
                        </p>
                    </div>

                </div>
            </div>";
            endif;



        endforeach;

    }else {
           http_response_code(404);
    }
function placeMessage($message){
        $message_type = $message->message_type;

        switch($message_type){
            case "text":
                return "<p>$message->message</p>";
            case "jpg"  :
            case "jpeg" :
            case "png"  :
                return "<img src='/uploads/$message->message' class='chat-file-img'>";
            case "pdf"  :

                return "";
            case "xls"  :
                return "";
            case "docx" :
                return "";
            case  "zip" :
                return "";
        }


}
