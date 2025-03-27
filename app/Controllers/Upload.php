<?php

namespace App\Controllers;

use DateTime;
use App\Models\UserModel;
use App\Models\DocumentModel;
use App\Models\GroupModel;
use App\Models\ReceivelogModel;
use App\Models\ReleaselogModel;
use CodeIgniter\Files\File;

class Upload extends BaseController
{

    public function compressImage($sourceImagePath, $maxSize = 1)
    {
        $maxFileSize = $maxSize * 1024 * 1024; // Convert MB to bytes

        // Get the image dimensions
        list($width, $height, $type) = getimagesize($sourceImagePath);

        // Calculate the initial quality based on the maximum file size
        $initialQuality = 90; // Initial quality
        $quality = $initialQuality;

        // Load the image based on its type
        switch ($type) {
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($sourceImagePath);
                break;
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($sourceImagePath);
                break;
            case IMAGETYPE_GIF:
                $image = imagecreatefromgif($sourceImagePath);
                break;
            default:
                // Unsupported image type
                return false;
        }

        // Compress the image until its size is less than or equal to the maximum file size
        do {
            // Create a temporary image with the specified quality
            ob_start();
            imagejpeg($image, null, $quality);
            $compressedImageData = ob_get_clean();

            // Calculate the size of the compressed image
            $compressedFileSize = strlen($compressedImageData);

            // If the compressed image size is greater than the maximum file size, reduce the quality
            if ($compressedFileSize > $maxFileSize && $quality > 0) {
                $quality -= 10; // Decrease the quality by 10 units
            } else {
                // Clear the memory
                imagedestroy($image);

                return $compressedImageData;
            }

            // Clear the memory
            imagedestroy($image);

            // Load the image again with the new quality
            $image = imagecreatefromstring($compressedImageData);
        } while ($quality >= 0);

        // Failed to compress the image within the maximum file size
        return false;
    }

    public function delete_profile_pic_file($profile_pic_file_name)
    {
        $file_path =  ROOTPATH . 'public/uploads/' . $profile_pic_file_name;
        if ($profile_pic_file_name !== NULL || $profile_pic_file_name !== '') {


            if (file_exists($file_path)) {
                log_message('error', 'file exists' . $file_path);

                if (unlink($file_path)) {
                    return true;
                } else {
                    return true;
                }
            } else {
                return true;
            }
        } else {
            log_message('error', 'not hits:' . $profile_pic_file_name);
            return true;
        }
    }

    public function upload_profile_pic() //use only to logged user
    {
        $json_output = [
            'status' => false,
            'error' => "",
            'affected_rows1' => "",
            'affected_rows2' => "",
            'old_filename' => "",
            'new_filename' => ""
        ];

        $validationRule = [
            'userfile' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[userfile]',
                    'is_image[userfile]',
                    'mime_in[userfile,image/jpg,image/jpeg,image/png,image/]',
                    'max_size[userfile,6048]',
                    'max_dims[userfile,9024,9028]',
                ],
            ],
        ];

        if (!$this->validateData([], $validationRule)) {
            $json_output = ['errors' => $this->validator->getErrors()];
            return json_encode($json_output);
        }

        $img = $this->request->getFile('userfile');


        // Define the destination folder within the public directory
        $destination =  ROOTPATH . 'public/uploads/';
        $old_profile_pic = ROOTPATH . 'public/uploads/' . session()->get('user_pic');

        // Generate a unique filename
        $newFilename = $img->getRandomName();

        // Move the uploaded file to the destination folder
        if ($img->isValid() && !$img->hasMoved()) {
            $img->move($destination, $newFilename);


            // attempt to compress the image to smaller size
            // Compress the uploaded image
            $sourceImagePath =  $destination . $newFilename;
            $compressedImageData = $this->compressImage($sourceImagePath, 2);
            if ($compressedImageData !== false) {
                // Save the compressed image data to a new file
                file_put_contents($sourceImagePath, $compressedImageData);
            } else {
                // Compression failed, handle error as needed
                $json_output['error'] = "Failed to compress the image.";
                $json_output['status'] = false;
                return json_encode($json_output);
            }

            //delete old user_pic in uploads folders $destination 
            $json_output['destination '] = $destination;
            $json_output['old_filename'] = $old_profile_pic;

            // check if user has old picture especially if it is first time
            if(session()->get('user_pic')!=''){
                $this->delete_profile_pic_file(session()->get('user_pic'));

            }

            // save filename to datbase
            $session = session();
            $user_id = $session->get('userData')['user_id'];
            $userModel = new UserModel();
            $result =  $userModel->update_picture_filename($user_id, $newFilename);



            // update sesssion value of user_pic
            $session->set('user_pic', $newFilename);

            $json_output['new_filename'] = $newFilename;
            $json_output['status'] = true;
            $json_output['result'] =  $result;
            $json_output['user_id'] =  $user_id;

            return json_encode($json_output);
        }

        $json_output = ['errors' => 'Failed to move the file.'];
        return json_encode($json_output);
    }

    public function upload_group_profile_pic() //use only to logged user
    {
        $json_output = [
            'status' => false,
            'error' => "",
            'affected_rows1' => "",
            'affected_rows2' => "",
            'old_filename' => "",
            'new_filename' => ""
        ];

        $validationRule = [
            'userfile' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[userfile]',
                    'is_image[userfile]',
                    'mime_in[userfile,image/jpg,image/jpeg,image/png,image/]',
                    'max_size[userfile,6048]',
                    'max_dims[userfile,9024,9028]',
                ],
            ],
        ];

        if (!$this->validateData([], $validationRule)) {
            $json_output = ['errors' => $this->validator->getErrors()];
            return json_encode($json_output);
        }

        $img = $this->request->getFile('userfile');
        $group_id = $this->request->getVar('group_id');
        $current_group_pic = $this->request->getVar('current_group_pic');




        // Define the destination folder within the public directory
        $destination =  ROOTPATH . 'public/uploads/';
        $old_profile_pic = ROOTPATH . 'public/uploads/' . $current_group_pic;

        // Generate a unique filename
        $newFilename = $img->getRandomName();

        // Move the uploaded file to the destination folder
        if ($img->isValid() && !$img->hasMoved()) {
            $img->move($destination, $newFilename);


            // attempt to compress the image to smaller size
            // Compress the uploaded image
            $sourceImagePath =  $destination . $newFilename;
            $compressedImageData = $this->compressImage($sourceImagePath, 2);
            if ($compressedImageData !== false) {
                // Save the compressed image data to a new file
                file_put_contents($sourceImagePath, $compressedImageData);
            } else {
                // Compression failed, handle error as needed
                $json_output['error'] = "Failed to compress the image.";
                $json_output['status'] = false;
                return json_encode($json_output);
            }

            //delete old goup_pic in uploads folders $destination 
            $json_output['destination '] = $destination;
            $json_output['old_filename'] = $old_profile_pic;

            // check if group has old picture especially if it is first time
            if($current_group_pic!=''){
                $this->delete_profile_pic_file($current_group_pic);

            }

            // save filename to datbase
            $dtgroupModel = new GroupModel();
            $result =  $dtgroupModel->update_picture_filename($group_id, $newFilename);



            $json_output['new_filename'] = $newFilename;
            $json_output['status'] = true;
            $json_output['result'] =  $result;
            $json_output['group_id'] =  $group_id;

            return json_encode($json_output);
        }

        $json_output = ['errors' => 'Failed to move the file.'];
        return json_encode($json_output);
    }
}
