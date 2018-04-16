<?php
/**
 * Created by PhpStorm.
 * User: julienbutty
 * Date: 08/04/2018
 * Time: 15:25
 */

namespace App\Tests\Service;



use App\Service\FileUploader;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploaderTest extends TestCase
{

    public function testUpload()
    {
        $targetDirectory = sys_get_temp_dir();
        $file = tempnam($targetDirectory,'test');
        imagepng(imagecreatetruecolor(10,10), $file);
        $image = new UploadedFile($file,'test.png',"image/png", null, null, true );
        $uploader = new FileUploader($targetDirectory);
        $result = $uploader->upload($image);

        dump($targetDirectory."/".$result);
        $this->assertTrue(file_exists($targetDirectory."/".$result));

    }

}