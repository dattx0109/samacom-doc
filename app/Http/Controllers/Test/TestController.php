<?php
namespace App\Http\Controllers\Test;

use App\Service\FileManagerService\FileManagerService;

class TestController
{

    private $fileManagerService;

    public function __construct(FileManagerService $fileManagerService)
    {
        $this->fileManagerService = $fileManagerService;
    }

    public function pushFile()
    {
        $file = request()->file('file');

        $pathFileService = $this->fileManagerService
            ->setFile($file)
            ->setService(FileManagerService::SERVICE_ADAPP)
            ->setUserId(3)
            ->handle()
        ;
        return $pathFileService;
    }
}
