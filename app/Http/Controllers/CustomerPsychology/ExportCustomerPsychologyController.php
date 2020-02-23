<?php


namespace App\Http\Controllers\CustomerPsychology;

use App\Http\Controllers\Controller;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportCustomerPsychologyController extends Controller implements FromCollection, WithHeadings
{

    use Exportable;

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        $listTamLyKh = $this->data;
        foreach ($listTamLyKh as $row) {
            $listTamLyKhForExcel[] = array(
                '0' => $row->id,
                '1' => isset($row->ten_KH)?$row->ten_KH:'Không có dữ liệu',
                '2' => isset($row->giong_noi_KH)?$row->giong_noi_KH==1?'Mỏng':'Dày':'Không có dữ liệu',
                '3' => isset($row->khuon_mat_KH)?$row->khuon_mat_KH==1?'Mềm mỏng':'Góc cạnh':'Không có dữ liệu',
                '4' => isset($row->khi_chat_KH)?$row->khi_chat_KH==1?'Dễ gần':'Khó gần':'Không có dữ liệu',
                '5' => isset($row->nam_sinh_KH)?$row->nam_sinh_KH:'Không có dữ liệu',
                '6' => isset($row->linh_vuc_hoat_dong_KH)?$row->linh_vuc_hoat_dong_KH:'Không có dữ liệu',
                '7' => isset($row->gioi_tinh_KH)?$row->gioi_tinh_KH==1?'Nam':'Nữ':'Không có dữ liệu',
                '8' => isset($row->ten_lien_lac)?$row->ten_lien_lac:'Không có dữ liệu',
                '9' => isset($row->gioi_tinh)?$row->gioi_tinh==1?'Nam':'Nữ':'Không có dữ liệu',
                '10' => isset($row->nam_sinh)?$row->nam_sinh:'Không có dữ liệu',
                '11' => isset($row->sdt)?$row->sdt:'Không có dữ liệu',
                '12' => isset($row->email)?$row->email:'Không có dữ liệu',
                '13' => isset($row->nganh_dang_lam)?$row->nganh_dang_lam:'Không có dữ liệu',
                '14' => isset($row->vi_tri_sale)?$row->vi_tri_sale:'Không có dữ liệu',
                '15' => ($row->type==1)?'Thần thái':($row->type==2?'Nhân khẩu học':'Nhân tướng học'),
            );
        }

        return (collect($listTamLyKhForExcel));
    }
    public function headings(): array
    {
        return [
            'id',
            'Tên khách hàng cần khảo sát tâm lý',
            'Giọng nói của KH cần khảo sát',
            'Khuôn mặt của KH cần khảo sát',
            'Khí chất của KH cần khảo sát',
            'Năm sinh của KH cần khảo sát',
            'Lĩnh vực hoạt động của KH cần khảo sát',
            'Giới tính của KH cần khảo sát',
            'Tên KH để gửi thông tin',
            'Giới tính KH',
            'Năm sinh KH',
            'SDT của KH',
            'Email KH',
            'Ngành KH đang làm',
            'Vị trí sale KH của KH',
            'Loại khảo sát',
        ];
    }
}
