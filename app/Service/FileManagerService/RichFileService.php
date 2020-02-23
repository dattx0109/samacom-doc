<?php


namespace App\Service\FileManagerService;

use GuzzleHttp\Client;
use Illuminate\Http\Response;

class RichFileService
{
    const READ_FOLDER = 'readfolder';
    const ADD_FOLDER = 'addfolder';

    private $guzzleClient;

    public function __construct(Client $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
    }

    public function handle($service, $userId, $file, $fileName)
    {
        $this->createFolderRichFile('/', $service);
        $this->createFolderRichFile($service, $userId);
        $pathFile = $this->pushFileToRichFile($file, $service, $userId, $fileName);

        return $pathFile;
    }

    public function readFolderRichFile($path)
    {
        $query = [
            'mode' => self::READ_FOLDER,
            'path' => $path
        ];
        $response = $this->guzzleClient->get(env('RICH_FILE_URL'), [
            'query' => $query,
            'http_errors' => false,
            'verify' => false,
            'headers' => [
                'Authorization' => 'Bearer ' . request()->bearerToken(),
                'Accept'        => 'application/json',
            ]
        ]);
        return $response->getStatusCode() == Response::HTTP_OK;
    }


    public function createFolderRichFile($path, $pathNew)
    {
        $query = [
            'mode' => self::ADD_FOLDER,
            'path' => $path,
            'name' => $pathNew
        ];

        $response = $this->guzzleClient->get(env('RICH_FILE_URL'), [
            'query' => $query,
            'http_errors' => false,
            'verify' => false,
            'headers' => [
                'Authorization' => 'Bearer ' . request()->bearerToken(),
                'Accept'        => 'application/json',
            ]
        ]);
        return $response->getStatusCode() == Response::HTTP_OK;
    }

    public function pushFileToRichFile($file, $service, $userId, $fileName)
    {
        $response = $this->guzzleClient->post(env('RICH_FILE_URL'), [
            'multipart' => [
                [
                    'name'     => 'mode',
                    'contents' => 'upload'
                ],
                [
                    'name'     => 'path',
                    'contents' => $service.'/'.$userId.'/',
                ],
                [
                    'name'     => 'upload',
                    'contents' => file_get_contents($file->path()),
                    'filename' => $fileName
                ]
            ],
            'verify' => false,
            'http_errors' => false,
            'headers' => [
                'Authorization' => 'Bearer ' . request()->bearerToken(),
                'Accept'        => 'application/json',
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);
        if(isset($data['data'][0]['id'])){
            return $data['data'][0]['id'];
        }

        return false;
    }
}
