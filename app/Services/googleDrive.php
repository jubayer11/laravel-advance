<?php

namespace App\Services;


use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Illuminate\Support\Facades\Storage;

class googleDrive
{
    protected $client, $zipFileName, $access_token;

    public function __construct($client, $zipFIleName, $access_token)
    {
        $this->client = $client;
        $this->zipFileName = $zipFIleName;
        $this->access_token = $access_token;
    }

    public function uploadFile()
    {

        $this->client->setAccessToken($this->access_token);
        $service = new Drive($this->client);
        $file = new DriveFile();
        $service->files->create(
            $file,
            array(
                'data' => file_get_contents($this->zipFileName),
                'mimeType' => 'application/octet-stream',
                'uploadType' => 'media'
            )
        );
        $file->setName("Hello World!");
        Storage::deleteDirectory('public/temp');
    }
}

