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

            //get message time
            $msg_time = getMessageTime($message->msg_time);

            //show messages
           if ($_SESSION['user_id'] == $message->user_id ):
               //get message type
               $msg_content = placeMessage($message);
                echo " <div class=\"right-message-area\">
                    <div class=\"right-message\">
    
                        <div class=\"right-sender-name-date\">
    
                            <span class=\"message-time\">$msg_time</span>
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
                        <span class=\"message-time\">$msg_time</span>
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
            case "xls"  :
            case "docx" :
            case  "zip" :
                return "<a href='/uploads/$message->message'>$message->message</a>";
        }


}
function getMessageTime($dbmsg_time){

        $time_zone = timezone_name_from_abbr("", $_COOKIE['timezone']*60, false);
        date_default_timezone_set("africa/cairo");

        $msg_time      = strtotime($dbmsg_time);
        $current_time  = time();

        $seconds = $current_time-$msg_time;

        $minutes = floor($seconds/60);
        $hours   = floor($minutes/60);
        $days    = floor($hours/24);
        $weeks   = floor($days/7);
        $monthes = floor($weeks/4);
        $years   = floor($monthes/12);

        if ($seconds < 60){
            return "Just now";
        }elseif ($minutes < 60){
            return "$minutes minutes ago";
        }elseif ($hours < 24 ){
            return "$hours hours ago";
        }elseif ($days < 7){
            return "$days days ago";
        }elseif ($weeks < 4){
            return "$weeks weeks ago";
        }elseif ($monthes < 12 ){
            return "$monthes months ago ";
        }else{
            return "$years years ago";
        }
}
