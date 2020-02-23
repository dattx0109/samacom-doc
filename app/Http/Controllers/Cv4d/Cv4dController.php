<?php


namespace App\Http\Controllers\Cv4d;

use Excel;

use App\Service\cv4d\Cv4dService;
//use Maatwebsite\Excel\Excel;
use App\Http\Controllers\Cv4d\ExportCv4dController;

class Cv4dController
{
    private $cv4dService;
    public function __construct(Cv4dService $cv4dService)
    {
        $this->cv4dService = $cv4dService;
    }

    public function insertCv4()
    {
        $rawData = request()->input();
        $this->cv4dService->insertCv4($rawData);
        return response()->json(200);
    }

    public function listCv4d()
    {
        $listCv4d = $this->cv4dService->getListData();
        return view('tamlyCv4d.list-cv4d',[
            'listCv4d' => $listCv4d
        ]);
    }

    public function export(){
//        dd(234);
        $listCv4d = $this->cv4dService->getData();
        return Excel::download(new ExportCv4dController($listCv4d), 'CV-4D.xlsx');
    }
}
