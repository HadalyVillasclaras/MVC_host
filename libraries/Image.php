<?php


class Image 
{  
    public $img;
    public $homeName;
    
    public function checkImage($img, $name){ 

        $fileName = $img['name'];
        $fileTmpName = $img['tmp_name'];
        $fileSize = $img['size'];
        $fileError = $img['error'];
        $fileType = $img['type'];

        //check extension
        $fileExt = explode('.', $fileName);
        $fileExtCheck = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'png');

            if(in_array($fileExtCheck, $allowed)){ 
                if($fileError === 0){
                    if($fileSize < 10000000){
                        $fileNameNew = uniqid('', true).'.'.$fileExtCheck;
                        $folderPath = $this->imgFolderPath($name) . '/'; 

                        $filePath = $folderPath  . $fileNameNew;
                        move_uploaded_file($fileTmpName, $filePath);

                        return $fileNameNew; 
                        
                        
                    }else{
                        echo "Please, upload an image with no more than 500MB.";
                        return false;
                    }
                }else{
                    echo "There was an error uploading your file.";
                    return false;
                }
            }else{
                echo "Please, upload an image of any of these formats: jpg, jpeg or png.";
                return false;
            }  
    }


    public function imgFolderPath($name){ 
        $homeName = $this->imgFolderName($name); 
        $folderPath = 'assets/img/' . $homeName;

        if(file_exists($folderPath) || is_dir($folderPath)){ 
            return $folderPath;
            
        }else{ 
            mkdir($folderPath, 0777, true); 
            return $folderPath;
        } 
    }

    public function imgFolderName($homeName){
        $homeName = preg_replace('/\s+/', '_', strtolower($homeName));
        return $homeName;
    }
}