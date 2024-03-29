<?php

class Image 
{  
    public $img;
    public $name;
    public $imgExtension;
    public $imgFolderName;
    public $newFileName;

    public function __construct($img, $name)
    {
        $this->img = $img;
        $this->name = $name;

        $this->validateImage();

        $fileName = $img['name'];
        $fileTmpName = $img['tmp_name'];
        $fileSize = $img['size'];
        $fileError = $img['error'];
        $fileType = $img['type'];
    }


    public function saveImageInFolder()
    { 
        if ($this->img['error'] === 0 ) {
            $newDirectory = $this->createDirectory() . '/'; 
            $filePath = $newDirectory  . $this->newFileName;

            move_uploaded_file($this->img['tmp_name'], $filePath);
        }else{
            echo ".";
            return false;
        }
    }
    
    public function validateImage()
    {
        if ( $this->checkExtension() && $this->checkFileSize()) {
            $imgExtension = $this->imgExtension;
            return true;
        } else {
            return false;
        }

    }

    public function checkExtension()
    {
        $allowedFormats = ['jpg', 'jpge', 'png'];
        $extension = explode('.', $this->img['name']);
        $formattedExtension = strtolower(end($extension));

        if (in_array($formattedExtension, $allowedFormats)) {
            $this->imgExtension = $formattedExtension;
            return true;
        } else {
            echo "Please, upload an image of any of these formats: jpg, jpeg or png.";
            return false;
        }
    }

    public function checkFileSize() 
    {
        if($this->img['size'] < 10000000) {
            return true;
        } else {
            echo "Please, upload an image with no more than 500MB.";
            return false;
        }
    }

    public function uniqueImageName() 
    {

            $name = $this->name;
            $newFileName = uniqid($name . '_') .'.'. $this->imgExtension;
            $this->newFileName = $newFileName; 

            return $this->newFileName;
        
    }

    public function createImgFolderName()
    {
        $imgFolderName = preg_replace('/\s+/', '_', strtolower($this->name));
        $this->imgFolderName = $imgFolderName;
        return $this->imgFolderName;
    }

    public function createDirectory()
    { 
        $folderPath = 'assets/img/homes/' . $this->imgFolderName;

        if(file_exists($folderPath) || is_dir($folderPath)){ 
            return $folderPath;
            
        }else{ 
            mkdir($folderPath, 0777, true); 
            return $folderPath;
        } 
    }
}