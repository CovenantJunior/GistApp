
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<lable class="">Choose Image</lable>
		<input type="file" name="upload_image" required />
	</div>
	
	<input type="submit" name="form_submit" class="btn btn-primary" value="Submit" />
	<?php
function resizeImage($resourceType,$image_width,$image_height) {
    if ($image_width>2000) {
        $resizeWidth = $image_width/5;
        $resizeHeight = $image_height/5;
    }
    elseif ($image_height>=1500) {
        $resizeWidth = $image_width/4;
        $resizeHeight = $image_height/4;
    }
    elseif ($image_height>=1000) {
        $resizeWidth = $image_width/3;
        $resizeHeight = $image_height/3;
    }
    elseif ($image_height>=500) {
        $resizeWidth = $image_width/0.5;
        $resizeHeight = $image_height/0.5;
    }
    else{
        $resizeWidth = $image_width;
        $resizeHeight = $image_height;
    }
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}
 
if(isset($_POST["form_submit"])) {
	$imageProcess = 0;
    if(is_array($_FILES)) {
        $fileName = $_FILES['upload_image']['tmp_name']; 
        $sourceProperties = getimagesize($fileName);
        print_r($sourceProperties);
        $resizeFileName = time();
        $uploadPath = "./uploads/";
        $fileExt = pathinfo($_FILES['upload_image']['name'], PATHINFO_EXTENSION);
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
        $size = $_FILES['upload_image']['size']/1000;
        if ($size>250) {
            switch ($uploadImageType) {
                case IMAGETYPE_JPEG:
                    $resourceType = imagecreatefromjpeg($fileName); 
                    $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                    $file = imagejpeg($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
                    break;
     
                case IMAGETYPE_GIF:
                    $resourceType = imagecreatefromgif($fileName); 
                    $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                    $file = imagegif($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
                    break;
     
                case IMAGETYPE_PNG:
                    $resourceType = imagecreatefrompng($fileName); 
                    $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                    $file = imagepng($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
                    break;
     
                default:
                    $imageProcess = 0;
                    break;
            }
            move_uploaded_file($file, $uploadPath. $resizeFileName. ".". $fileExt);
        }
        else{
            move_uploaded_file($_FILES['upload_image']['tmp_name'], $uploadPath. $resizeFileName. ".". $fileExt);
        }
        $imageProcess = 1;
        
    }
 
	if($imageProcess == 1){
	?>
		<div class="alert icon-alert with-arrow alert-success form-alter" role="alert">
			<i class="fa fa-fw fa-check-circle"></i>
			<strong> Success ! </strong> <span class="success-message"> Image Resize Successfully </span>
		</div>
	<?php
	}else{
	?>
		<div class="alert icon-alert with-arrow alert-danger form-alter" role="alert">
			<i class="fa fa-fw fa-times-circle"></i>
			<strong> Note !</strong> <span class="warning-message">Invalid Image </span>
		</div>
	<?php
	}
	$imageProcess = 0;
}
?>
<div class="row">
	
	<div class="col-md-4">
		<img class="img-rounded img-responsive" src="<?php echo $uploadPath."thump_".$resizeFileName.'.'. $fileExt; ?>" width="<?php echo $new_width; ?>" height="<?php echo $new_height; ?>" >
 
		<h4><b>Thump Image</b></h4>
 
		<a href="<?php echo $uploadPath."thump_".$resizeFileName.'.'. $fileExt; ?>" download class="btn btn-danger"><i class="fa fa-download"></i> Download </a href="">
	</div>
	<div class="col-md-8">
		<img class="img-rounded img-responsive" src="<?php echo $uploadPath.$resizeFileName.'.'. $fileExt; ?>" >
 
		<h4><b>Original Image</b></h4>
	</div>
</div>
</form>
</body>
</html>