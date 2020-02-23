<?php


namespace App\Http\Controllers\CustomerPsychology;


use App\Service\CustomerPsychology\CustomerPsychologyService;
use Excel;

class CustomerPsychologyController
{
    private $customerPsychologyService;
    public function __construct(CustomerPsychologyService $customerPsychologyService)
    {
        $this->customerPsychologyService = $customerPsychologyService;
    }

    public function index()
    {
        return view('tamly.tamly');
    }

    public function insert()
    {
        $rawData = request()->input();
        $this->customerPsychologyService->insert($rawData);
    }

    public function listTamLy()
    {
        $listTamLyKh = $this->customerPsychologyService->getListData();
        return view('tamlyCv4d.list-tam-ly-kh',[
            'listTamLyKh' => $listTamLyKh
        ]);
    }
    public function export(){
        $listTamLyKh = $this->customerPsychologyService->getData();
        return Excel::download(new ExportCustomerPsychologyController($listTamLyKh), 'DocTamLyKhachHang.xlsx');
    }
}
