<?php
    function resizeImage($resourceType,$image_width,$image_height) {
        if ($image_width>2000) {
            $resizeWidth = $image_width/6;
            $resizeHeight = $image_height/6;
        }
        elseif ($image_height>=1500) {
            $resizeWidth = $image_width/5;
            $resizeHeight = $image_height/5;
        }
        elseif ($image_height>=1000) {
            $resizeWidth = $image_width/3;
            $resizeHeight = $image_height/3;
        }
        else{
            $resizeWidth = $image_width/2;
            $resizeHeight = $image_height/2;
        }
        $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
        imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
        return $imageLayer;
    }

        $sourceProperties = getimagesize($fileName);
        $resizeFileName = time();
        $uploadPath = "./uploads/";
        $fileExt = pathinfo($_FILES['upload_image']['name'], PATHINFO_EXTENSION);
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
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
?>