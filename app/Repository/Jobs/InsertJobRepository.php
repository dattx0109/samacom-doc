<?php


namespace App\Repository\Jobs;

use Illuminate\Support\Facades\DB;

class InsertJobRepository
{
    const TABLE_NAME = 'jobs';
    const TYPE_SELF = 1;
    const TYPE_CRAWLER = 2;

    public function insert($dataInsert)
    {
        $data = [
        "company_id" => $dataInsert['company_id'],
        "title" => $dataInsert['title'],
        "slug"  => $dataInsert['slug'],
        "job_expire" =>date("Y-m-d", strtotime($dataInsert['job_expire'])),
        "job_publish" =>date("Y/m/d"),
        "province_id" => $dataInsert['province_id'],
        "district_id" => $dataInsert['district_id'],
        "workplace_full_text" => $dataInsert['workplace_full_text'],
        "gender" => $dataInsert['gender'],
        "level_id" => $dataInsert['level_id'],
        "job_type" => $dataInsert['job_type'],
        "field_work_id" => $dataInsert['field_work_id'],
        "job_description_id" => $dataInsert['job_description_id'],
        "employee_description_id" => $dataInsert['employee_description_id'],
        "type" => $dataInsert['type'],
        'created_at' => date("Y/m/d H:i:s"),
        'updated_at' => date("Y/m/d H:i:s")];

        if ($dataInsert['type']==2) {
            $data['employer_id'] = $dataInsert['employer_id'];
        }
        if ($dataInsert['salary_base_type']!=1) {
            $data["base_salary_min"] = $dataInsert['base_salary_min'];
            $data["base_salary_max"] = $dataInsert['base_salary_max'];
        }
        if ($dataInsert['income_type']!=1) {
            $data["income_min"] = $dataInsert['income_min'];
            $data["income_max"] = $dataInsert['income_max'];
        }
        return DB::table(self::TABLE_NAME)->insertGetId($data);
    }

    public function checkTitleExist($title, $id = false)
    {
        $query = DB::table(self::TABLE_NAME);
        $query->where('title', $title);
        if ($id) {
            $query->where('id', '!=', $id);
        }

        return $query->count();
    }
}
