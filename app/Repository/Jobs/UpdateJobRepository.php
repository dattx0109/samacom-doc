<?php


namespace App\Repository\Jobs;

use Illuminate\Support\Facades\DB;
use Psr\Log\NullLogger;

class UpdateJobRepository
{
    const TABLE_NAME = 'jobs';
    const TYPE_SELF = 1;
    const TYPE_CRAWLER = 2;

    public function update($dataUpdate)
    {
        $data = [
            "company_id" => $dataUpdate['company_id'],
            "title" => $dataUpdate['title'],
            "slug"  => $dataUpdate['slug'],
            "job_expire" =>date("Y-m-d", strtotime($dataUpdate['job_expire'])),
            "income_min" => $dataUpdate['income_min'],
            "income_max" => $dataUpdate['income_max'],
            "province_id" => $dataUpdate['province_id'],
            "district_id" => $dataUpdate['district_id'],
            "workplace_full_text" => $dataUpdate['workplace_full_text'],
            "gender" => $dataUpdate['gender'],
            "level_id" => $dataUpdate['level_id'],
            "job_type" => $dataUpdate['job_type'],
            "field_work_id" => $dataUpdate['field_work_id'],
            "job_description_id" => $dataUpdate['job_description_id'],
            "employee_description_id" => $dataUpdate['employee_description_id'],
            "type" => $dataUpdate['type'],
            'updated_at' => date("Y/m/d H:i:s")
        ];
        if ($dataUpdate['type']==2) {
            $data['employer_id'] = $dataUpdate['employer_id'];
        }
        if ($dataUpdate['type']==1) {
            $data['employer_id'] = null;
        }
        if ($dataUpdate['salary_base_type']!=1) {
            $data["base_salary_min"] = $dataUpdate['base_salary_min'];
            $data["base_salary_max"] = $dataUpdate['base_salary_max'];
        }
        if ($dataUpdate['salary_base_type']==1) {
            $data["base_salary_min"] = null;
            $data["base_salary_max"] = null;
        }
        if ($dataUpdate['income_type']!=1) {
            $data["income_min"] = $dataUpdate['income_min'];
            $data["income_max"] = $dataUpdate['income_max'];
        }
        if ($dataUpdate['income_type']==1) {
            $data["income_min"] = null;
            $data["income_max"] = null;
        }

        return DB::table(self::TABLE_NAME)->where('id', $dataUpdate['job_id'])->update($data);
    }
}
