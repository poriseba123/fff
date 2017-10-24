<?php

include_once 'config/db_conn.php';
include_once 'config/cron_define.php';
include_once 'mail-functions.php';

$getEmailHead = getHeader();
$getEmailFooter = getFooter();
$getEmailBody = '<p style="text-align:justify;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>';
$mailContent = $getEmailHead . $getEmailBody . $getEmailFooter;
$subject = ucwords("Testing Mail");
echo "<pre>";
print_r($mailContent);
echo "</pre>";
$shootEmail = shoot_email("taslimislam02@gmail.com", $subject, $mailContent);

//if (mysqli_num_rows($result) > 0) {
//    
//    while ($row = mysqli_fetch_assoc($result)) {
//        $adviceId = $row['id'];
//        $createrId = $row['user_id'];
//        $adviceQuestion = $row['question'];
//
//        $userDetails = "SELECT * FROM user_master WHERE id = $createrId";
//        $userResult = mysqli_query($con, $userDetails); // get user details
//        if (mysqli_num_rows($userResult) > 0) {
//            $rows = mysqli_fetch_assoc($userResult);
//            $userName = $rows['name'];
//        } else {
//            $userName = "Not Given";
//        }
//        $getFlowers = "SELECT * FROM follow_master INNER JOIN user_master ON follow_master.user_id = user_master.id WHERE follow_master.flower_id  = $createrId AND follow_master.status = 1 AND user_master.status = 1;";
//        $followResult = mysqli_query($con, $getFlowers); // get all follower records
//
//        if (mysqli_num_rows($followResult) > 0) {
//            while ($followers = mysqli_fetch_assoc($followResult)) {
//                $followerId = $followers['user_id'];
//                $followerName = $followers['name'];
//                $followerEmail = $followers['email'];
//                $type = "advice";
//                $detailsLink = HOME_URL . "advice/advicedetails/$adviceId.asp";
//                $getEmailHead = getHeader();
//                $getEmailFooter = getFooter();
//                $getEmailBody = getBody($type, $followerName, $userName, $adviceQuestion, $detailsLink);
//                $mailContent = $getEmailHead . $getEmailBody . $getEmailFooter;
//                $subject = ucwords("one new adviser posted : Champion Clubhouse");
//                
//                $shootEmail = shoot_email($followerEmail, $subject, $mailContent);
//            }
//        }
//        $sql44 = "UPDATE local_adviser SET follower_mail_send='1' WHERE  id = $adviceId";
//
//        $result44 = mysqli_query($con, $sql44);
//    }
//}