<?php
    function is_admin_login()
    {
        if(!isset($_SESSION['admin']))
        {
            header('location:login.php');
        }
        
    }
    function is_soc_login()
    {
        if(!isset($_SESSION['soc_id']))
        {
            header('location:login.php');
        }
        
    }
	function dbRowInsert($table_name, $form_data)
    {   
    // retrieve the keys of the array (column titles)
    $fields = array_keys($form_data);

    // build the query
     $sql = "INSERT INTO ".$table_name."
    (`".implode('`,`', $fields)."`)
    VALUES('".implode("','", $form_data)."')";
    	//print_r($sql); exit();
    // run and return the query result resource
    
    $status = mysqli_query($GLOBALS['con'],$sql);
    if($status)
     {  //echo "yes"; exit();
      $_SESSION['suc_msg'] = "data inserted sucessfully.";
     }
     else
     { //echo "no";  exit();
     	 $_SESSION['error_msg'] = "data not inserted sucessfully.";
     }
     return;
}

	function listing($table_name)
	{   $arr = "";
		$sql = "SELECT * 
				FROM ".$table_name." 
				WHERE society_id = '".$_SESSION['soc_id']."' 
				";
		if($rs = mysqli_query($GLOBALS['con'],$sql)) {

			$arr[] = mysqli_fetch_array($rs);
		
		}
		
		return $arr;
	}
    function fetchsinglerow($table_name,$userid,$columnname)
    {   $arr = array();
        $sql = "SELECT * 
                FROM ".$table_name." 
                WHERE society_id = '".$_SESSION['soc_id']."' AND 
                ".$columnname." = '".$userid."'
                ";
        if($rs = mysqli_query($GLOBALS['con'],$sql)) {

            $arr = mysqli_fetch_array($rs);
        
        }
        //print_r($arr); exit;
        return $arr;
    }
    function upload_file($image_name,$path) {
           $filename=str_replace(" ","_",$_FILES[$image_name]['name']); 
           $tmpname=$_FILES[$image_name]['tmp_name'];
            $exp=explode('.', $filename);
            $ext=end($exp);         
            $newname=  $exp[0].'_'.time().".".$ext;
            move_uploaded_file($tmpname,$image_path);
            
            return $newname;        
    }
     function update($table,$column,$id,$fields) {
    $set = '';
    $x = 1;

    foreach($fields as $name => $value) {
        $set .= "{$name} = \"{$value}\"";
        if($x < count($fields)) {
            $set .= ',';
        }
        $x++;
    }

    $sql = "UPDATE {$table} SET {$set} WHERE {$column} = {$id}";
    //echo $sql; exit();
    $status = mysqli_query($GLOBALS['con'],$sql);
    if($status)
     {  //echo "yes"; exit();
      $_SESSION['suc_updatemsg'] = "data update sucessfully.";
     }
     else
     { //echo "no";  exit();
       $_SESSION['error_msg'] = "data not inserted sucessfully.";
     }
    // if(!$this->query($sql, $fields)->error()) {
    //     return true;
    // }

    // return false;
}
?>