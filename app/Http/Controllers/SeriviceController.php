<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Task;


use App\Services\googleDrive;
use Google\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use ZipArchive;

class SeriviceController extends Controller
{
    //

    public const DRIVE_SCOPES = [
        'https://www.googleapis.com/auth/drive',
        'https://www.googleapis.com/auth/drive.file',
    ];

    public function connect(Request $request, Client $client)
    {


        define("App\Http\Controllers\DRIVE_SCOPES", [
            'https://www.googleapis.com/auth/drive',
            'https://www.googleapis.com/auth/drive.file',
        ]);
        if ($request->service == 'google-drive') {
            $client->setScopes([self::DRIVE_SCOPES]);

            $url = $client->createAuthUrl();
            return response(['url' => $url]);
        }


    }

    public function callback(Request $request, Client $client)
    {
        //$client = new \Google\Client();

        $code = $request->code;

        $access_token = $client->fetchAccessTokenWithAuthCode($code);


        $service = Service::create(['user_id' => auth()->id(), 'token' => json_encode(['access_token' => $access_token]), 'name' => 'google-drive']);

        return response($service, Response::HTTP_CREATED);
    }


    public function store(Request $request, Service $service, Client $client)
    {

//        DEFINE("TESTFILE", 'testfile.txt');
//        if (!file_exists(TESTFILE)) {
//            $fh = fopen(TESTFILE, 'w');
//            fseek($fh, 1024 * 1024);
//            fwrite($fh, "!", 1);
//            fclose($fh);
//        }
        $task = Task::where('created_at', '>=', now()->subDays(7))->get();
        $zipFileName = $this->createZipOf($task);
        $access_token = $service->token['access_token'];
        $drive = new googleDrive($client, $zipFileName, $access_token);
        $drive->uploadFile();

//        $client->setAccessToken($access_token);
//        $service = new Drive($client);
//        $file = new DriveFile();
//        $service->files->create(
//            $file,
//            array(
//                'data' => file_get_contents($zipFileName),
//                'mimeType' => 'application/octet-stream',
//                'uploadType' => 'media'
//            )
//        );
//        $file->setName("Hello World!");
//        Storage::deleteDirectory('public/temp');


        return response(' ', Response::HTTP_CREATED);

    }

    public function createZipOf($task)
    {
        $jsonFileName = 'driveFile.json';
        Storage::put("/public/temp/$jsonFileName", $task->toJson());
        $zip = new ZipArchive();
        $zipFileName = storage_path('app/public/temp/' . now()->timestamp . '-task.zip');
        if ($zip->open($zipFileName, ZipArchive::CREATE) == true) {
            $filePath = storage_path('app/public/temp/' . $jsonFileName);
            $zip->addFile($filePath);
        }
        // $zip->close();

        return $zipFileName;
    }

}
