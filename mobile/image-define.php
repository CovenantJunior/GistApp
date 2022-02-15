<?php
    function getExtension($str) {
        $i = strrpos($str, ".");
        if (!$i) { return ""; }
        $l = strlen($str) - $i;
        $ext = substr($str,$i+1,$l);
        return $ext;
    }
    if (isset($_FILES)) {
        define("MAX_SIZE", "10000");
        $errors = 0;
        $image = $_FILES["fileField"]["name"];
        $uploadedfile = $_FILES['fileField']['tmp_name'];
        if($image){
            $filename = stripslashes($_FILES['fileField']['name']);
            $extension = strtolower(getExtension($filename));
            if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")){
                echo ' Unknown Image extension ';
                $errors = 1;
            } else {
                $newname = "$product_cn.$extension";
                $size = filesize($_FILES['fileField']['tmp_name']);
                if ($size > MAX_SIZE*1024){
                    echo "You have exceeded the size limit";
                    $errors = 1;
                }
                if($extension == "jpg" || $extension == "jpeg" ){
                    $uploadedfile = $_FILES['file']['tmp_name'];
                    $src = imagecreatefromjpeg($uploadedfile);
                } else if($extension == "png"){
                    $uploadedfile = $_FILES['file']['tmp_name'];
                    $src = imagecreatefrompng($uploadedfile);
                } else {
                    $src = imagecreatefromgif($uploadedfile);
                }
                list($width, $height) = getimagesize($uploadedfile);
                $newwidth = 60;
                $newheight = ($height/$width)*$newwidth;
                $tmp = imagecreatetruecolor($newwidth, $newheight);
                $newwidth1 = 25;
                $newheight1 = ($height/$width)*$newwidth1;
                $tmp1 = imagecreatetruecolor($newwidth1, $newheight1);
                imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                imagecopyresampled($tmp1, $src, 0, 0, 0, 0, $newwidth1, $newheight1, $width, $height);
                $filename = "../products_images/$newname";
                $filename1 = "../products_images/thumbs/$newname";
                imagejpeg($tmp, $filename, 100); // file name also indicates the folder where to save it to
                imagejpeg($tmp1, $filename1, 100);
                imagedestroy($src);
                imagedestroy($tmp);
                imagedestroy($tmp1);
            }
        }
    }

?>
