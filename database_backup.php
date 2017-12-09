<?php
$date=date('d-m-Y');
$days_ago = date('d-m-Y', strtotime('-2 days', strtotime($date)));
$file='/var/www/html/backup/poriseba_backup_'.$days_ago.'.sql';
 if (file_exists($file)) {
	 //echo "hi";
        unlink($file);
    } 
$filename='poriseba_backup_'.date('d-m-Y').'.sql';
$result=exec('mysqldump poriseba --password=doctorpass --user=root --single-transaction >/var/www/html/backup/'.$filename.' 2>&1',$output);
