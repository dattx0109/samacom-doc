<?php
namespace App\Service\FileManagerService;

use App\Repository\File\FileRepository;

class FileManagerService
{
    const SERVICE_SAMACOM = 1;
    const SERVICE_ADAPP = 2;

    private $service;
    private $file;
    private $userId;
    private $title;
    private $richFileService;
    private $fileRepository;

    public function __construct(RichFileService $richFileService, FileRepository $fileRepository)
    {
        $this->richFileService = $richFileService;
        $this->fileRepository  = $fileRepository;
    }

    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    public function setService($service)
    {
        $this->service = $service;
        return $this;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function getService()
    {
        return $this->service;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function handle()
    {
        $pathFileServer = $this->richFileService->handle($this->getService(), $this->getUserId(), $this->file, $this->generateFileName($this->file->getClientOriginalExtension()));
        $rawData = $this->getRawDataFile($pathFileServer);
        $this->fileRepository->insert($rawData);
        return $pathFileServer;
    }

    public function updateToDb()
    {

    }

    public function pushToRichFile()
    {

    }

    public function getRawDataFile($pathFileServer)
    {
        $file = $this->file;
        return [
            'user_id' => $this->userId,
            'name' => $this->generateFileName($file->getClientOriginalExtension()),
            'origin_name' => $file->getClientOriginalName(),
            'path' => $pathFileServer,
            'size' => $file->getSize(),
            'service' => $this->service,
            'title' => $this->title,
            'created_at' => date("Y/m/d H:i:s"),
            'updated_at' => date("Y/m/d H:i:s"),
            'type_file' => $this->getTypeFile($file->getClientOriginalExtension()),
        ];
    }

    public function getTypeFile($extension)
    {
        return in_array($extension, config('file.list_extension_image')) ? 1 : 0;
    }

    public function generateFileName($extension)
    {
        $imageName = str_replace('.', '', bcrypt(env('APP_KEY')));
        $imageName = str_replace('$', '', $imageName);
        $imageName = str_replace('/', '', $imageName);
        return $imageName.'.'.$extension;
    }

}
