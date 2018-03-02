<?php

error_reporting(E_ALL&~E_NOTICE);

$master_array=[];
$mysqli = new mysqli("localhost", "root", "doctorpass", "poriseba");
$result = $mysqli->query("SELECT `id`,`table_name` FROM `services_list` WHERE status='1'");
while($rows = $result->fetch_assoc())
{
	if(!empty($rows)){
		$tablename=$rows['table_name'];
		$category_id =$rows['id'];
		$newresult = $mysqli->query("SELECT `id`,`name`,`country_id`,`state_id`,`city_id` FROM `".$tablename."` WHERE status='1'") or die($mysqli->error);
		while($newrows = $newresult->fetch_assoc()){
			if(!empty($newrows)){
				$newrows['category_id'] =$category_id;
				$master_array[]=$newrows;
			}
			
		}
	}
}
if(!empty($master_array))
{
    $idss=0;
    foreach($master_array as $index=>$value)
    {
        //if($index<13)
        //{
            $category_id=$value['category_id'];
			$id=$value['id'];
           $name=$value['name'];
		   $country_id=$value['country_id'];
		   $state_id=$value['state_id'];
		   $city_id=$value['city_id'];
		   $url='curl -X POST "https://search-poriseba007--7zqiehj6l6mmfrl3tno3i3pp4m.ap-south-1.es.amazonaws.com/poriseba/bomsankar/" -d \'{"category_id" : '.$category_id.',"id" : "'.$id.'","name" : "'.$name.'","country_id" : "'.$country_id.'","state_id" : "'.$state_id.'","city_id" : "'.$city_id.'"}\'';
           //die();
           exec($url);
		   if(curl_error($url))
			{
				echo 'error:' . curl_error($url);
			}
        $idss++;
        
    }
                        
           
   
}
echo count($master_array);
echo "<pre>";
echo $idss;
//die('hello');



?>