<?php


class Image 
{  
    public $img;
    public $homeName;
    public $extensionMsg;
    
    public function checkImage($img, $homeName){ 

        $fileName = $img['name'];
        $fileTmpName = $img['tmp_name'];
        $fileSize = $img['size'];
        $fileError = $img['error'];
        $fileType = $img['type'];

        //Extension

        if(
            $fileError === 0 && 
            $this->checkExtension($fileName) && 
            $this->checkFileSize($fileSize)
            ){
            
            $fileExtension = $this->checkExtension($fileName);
            $newFileName = uniqid('', true) .'.'. $fileExtension;
            $folderPath = $this->folderNamePath($homeName) . '/'; 
            $filePath = $folderPath  . $newFileName;

            move_uploaded_file($fileTmpName, $filePath);

            return $newFileName; 
                
        }else{
            echo "There was an error uploading your file.";
            return false;
        }

    }

    public function checkFileSize($fileSize) 
    {
        if($fileSize < 10000000) {
            return true;
        } else {
            echo "Please, upload an image with no more than 500MB.";
            return false;
        }
    }

    public function folderNamePath($homeName){ 
        $homeName = $this->createFolderName($homeName); 
        $folderPath = 'assets/img/homes/' . $homeName;

        if(file_exists($folderPath) || is_dir($folderPath)){ 
            return $folderPath;
            
        }else{ 
            mkdir($folderPath, 0777, true); 
            return $folderPath;
        } 
    }

    public function checkExtension($fileName){
        $allowedFormats = [
            'jpg',
            'jpge',
            'png'
        ];
        $extension = explode('.', $fileName);
        $formattedExtension = strtolower(end($extension));

        if (in_array($formattedExtension, $allowedFormats)) {
            return $formattedExtension;
        } else {
            $this->extensionMsg = "Please, upload an image of any of these formats: jpg, jpeg or png.";
            return false;
        }
    }

    public function createFolderName($newHomeName){
        $imgFolderName = preg_replace('/\s+/', '_', strtolower($newHomeName));
        return $imgFolderName;
    }
}