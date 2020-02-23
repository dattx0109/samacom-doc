<?php


namespace App\Http\Controllers\Cv4d;

use App\Http\Controllers\Controller;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportCv4dController extends Controller implements FromCollection, WithHeadings
{
    use Exportable;

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        $listCv4d = $this->data;
        foreach ($listCv4d as $row) {
            $listCv4dForExcel[] = array(
                '0' => $row->id,
                '1' => isset($row->ten)?$row->ten:'Không có dữ liệu',
                '2' => isset($row->gioi_tinh)?$row->gioi_tinh==1?'Nam':'Nữ':'Không có dữ liệu',
                '3' => isset($row->giong_noi)?$row->giong_noi==1?'Mỏng':'Dày':'Không có dữ liệu',
                '4' => isset($row->khuon_mat)?$row->khuon_mat==1?'Mềm mỏng':'Góc cạnh':'Không có dữ liệu',
                '5' => isset($row->khi_chat)?$row->khi_chat==1?'Dễ gần':'Khó gần':'Không có dữ liệu',
                '6' => ($row->type==1)?'Thần thái':($row->type==2?'Nhân khẩu học':'Nhân tướng học'),
                '7' => isset($row->so_dien_thoai)?$row->so_dien_thoai:'Không có dữ liệu',
                '8' => isset($row->email)?$row->email:'Không có dữ liệu',
                '9' => isset($row->nam_sinh)?$row->nam_sinh:'Không có dữ liệu',
            );
        }

        return (collect($listCv4dForExcel));
    }
    public function headings(): array
    {
        return [
            'id',
            'Tên KH',
            'Giới tính',
            'Giọng nói',
            'Khuôn mặt',
            'Khí chất',
            'Loại khảo sát',
            'Số điện thoại',
            'Email',
            'Năm sinh',
        ];
    }

}
