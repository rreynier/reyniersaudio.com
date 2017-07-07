<?php
//define a maxim size for the uploaded images in Kb
 define ("MAX_SIZE","10000");  
 define ("WIDTH","150"); 
 define ("HEIGHT","100"); 

//This function reads the extension of the file. It is used to determine if the file  is an image by checking the extension.
 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }

 function uploadImage($_FILES,$path,$width,$height,$tn_width,$tn_height) {
	//This variable is used as a flag. The value is initialized with 0 (meaning no error  found)  
	//and it will be changed to 1 if an errro occures.  
	//If the error occures the file will not be uploaded.
	$errors=0;
	//reads the name of the file the user submitted for uploading
	//only checks for img and img2
	if ($_FILES['img']['name'] != null) {
		$uploadedImage = $_FILES['img'];
		$image = $uploadedImage['name'];		
	}
	else { 
		$uploadedImage = $_FILES['img2'];
		$image = $uploadedImage['name'];		
	}
	//if it is not empty
	if ($image) {
		//get the original name of the file from the clients machine
		$filename = stripslashes($uploadedImage['name']);
		//get the extension of the file in a lower case format
		$extension = getExtension($filename);
		$extension = strtolower($extension);
		//if it is not a known extension, we will suppose it is an error and will not  upload the file,  
		//otherwise we will do more tests
		if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
			//print error message
			echo '<h1>Unknown extension!</h1>';
			$errors=1;
		}
		else {
			//get the size of the image in bytes
			//$_FILES['image']['tmp_name'] is the temporary filename of the file
			//in which the uploaded file was stored on the server
			$size=filesize($uploadedImage['tmp_name']);

			//compare the size with the maxim size we defined and print error if bigger
			if ($size > MAX_SIZE*1024) {
				echo '<h1>You have exceeded the size limit!</h1>';
				$errors=1;
			}
			//we will give an unique name, for example the time in unix time format
			$image_name=time().'.'.$extension;
			//the new name will be containing the full path where will be stored (images folder)
			$fullname=$path.'full/'.$image_name;
			$resizedname=$path.'resized/'.$image_name;
			$thumbname=$path.'tn/'.$image_name;
			//we verify if the image has been uploaded, and print error instead
			$resize = 0;
			$tn = 0;	
			
			if ($width > 1 || $height > 1) { $resize = 1; }
			if ($tn_width > 1 || $tn_height > 1) { $tn = 1; }
			
			$copied = copy($uploadedImage['tmp_name'], $fullname);
			
			if (!$copied) {
				echo '<h1>Copy unsuccessfull!</h1>';
				$errors=1;
			}
			else {					
				if ($resize==1) {			
					resize($fullname,$resizedname,$width,$height);
				}
				if ($tn==1) {				
					resize($fullname,$thumbname,$tn_width,$tn_height);
				}
			}
		}
	}
	else {
		$errors = 1;
	}
	
	if ($errors == 0) {		
		return $image_name;
	}
}

// this is the function that will create the thumbnail image from the uploaded image
// the resize will be done considering the width and height defined, but without deforming the image
 function resize($img_name,$filename,$new_w,$new_h)
 {	
	//get image extension.
 	$ext=getExtension($img_name);
	echo $img_name;
 	//creates the new image using the appropriate function from gd library
 	if(!strcmp("jpg",$ext) || !strcmp("jpeg",$ext))
 		$src_img=imagecreatefromjpeg($img_name);
		
  	if(!strcmp("png",$ext))
 		$src_img=imagecreatefrompng($img_name);

 	 	//gets the dimmensions of the image
 	$old_x=imageSX($src_img);
 	$old_y=imageSY($src_img);

 	if ( $new_w > 1 ) {
		$ratio = $old_x/$new_w;
		$thumb_w=$new_w;
 		$thumb_h=$old_y/$ratio;
		if ($thumb_h > $new_h) {
			$ratio = $old_y/$new_h;
			$thumb_h = $new_h;
			$thumb_w = $old_x/$ratio;
		}
		
	}
	else {
		if ( $new_h > 1) {
			$ratio = $old_y/$new_h;
			$thumb_h=$new_h;
			$thumb_w=$old_x/$ratio;
		}
	}
	echo '<br />old y:  ' . $old_y;
	echo '<br />new h: ' . $new_h;
	echo '<br />old x:  ' . $old_x;
	echo '<br />new w: ' . $new_w;
	echo '<br />';
	
  	// we create a new image with the new dimmensions
 	$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);

 	// resize the big image to the new created one
 	imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 

 	// output the created image to the file. Now we will have the thumbnail into the file named by $filename
 	
	echo $filename;
	if(!strcmp("png",$ext))
 		imagepng($dst_img,$filename); 
 	else
 		imagejpeg($dst_img,$filename,95); 

  	//destroys source and destination images. 
 	imagedestroy($dst_img); 
 	imagedestroy($src_img); 
	
 }
?>
