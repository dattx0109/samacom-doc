<?php

namespace App\Repository\Job;

use App\Repository\Company\CompanyRepository;
use Illuminate\Support\Facades\DB;
use App\Repository\Tag\TagRepository;

class JobRepository
{
    const TABLE_NAME = 'jobs';
    const ITEM_OF_PAGE = 20;
    const IS_PUBLIC = 1;
    const JOB_TYPE_EMPLOYER = 2;

    public function getAllJob($rawData)
    {
        $query = DB::table(self::TABLE_NAME)
            ->join(
                CompanyRepository::TABLE_NAME,
                self::TABLE_NAME . '.company_id',
                '=',
                CompanyRepository::TABLE_NAME . '.id'
            )
            ->join(
                TagRepository::TABLE_NAME,
                self::TABLE_NAME . '.id',
                '=',
                TagRepository::TABLE_NAME . '.job_id'
            );

        if (isset($rawData['title'])) {
            $query->where(self::TABLE_NAME . '.title', 'like', '%' . $rawData['title'] . '%');
        }

        if (isset($rawData['salary'])) {
            if ($rawData['salary'] == 1) {
                $query->whereBetween(self::TABLE_NAME . '.income_min', [0, 6000000]);
            }
            if ($rawData['salary'] == 2) {
                $query->whereBetween(self::TABLE_NAME . '.income_min',  [6000000, 8000000]);
            }
            if ($rawData['salary'] == 3) {
                $query->whereBetween(self::TABLE_NAME . '.income_min',  [8000000, 10000000]);
            }
            if ($rawData['salary'] == 4) {
                $query->whereBetween(self::TABLE_NAME . '.income_min',  [10000000, 15000000]);
            }
            if ($rawData['salary'] == 5) {
                $query->whereBetween(self::TABLE_NAME . '.income_min',  [15000000, 20000000]);
            }
            if ($rawData['salary'] == 6) {
                $query->whereBetween(self::TABLE_NAME . '.income_min',  [20000000, 30000000]);
            }
            if ($rawData['salary'] == 7) {
                $query->whereBetween(self::TABLE_NAME . '.income_min',  [30000000, 50000000]);
            }
            if ($rawData['salary'] == 8) {
                $query->whereBetween(self::TABLE_NAME . '.income_min',  [50000000, 100000000]);
            }
            if ($rawData['salary'] == 9) {
                $query->where(self::TABLE_NAME . '.income_min','>=', 100000000);
            }
        }
        if (isset($rawData['time_sort'])) {
            $desc = 1;
            if ($rawData['time_sort'] === $desc) {
                $query->orderBy(self::TABLE_NAME . '.id', 'DESC');
            }
        }
        if (!empty($rawData['sale'])) {
            $query->where(
                TagRepository::TABLE_NAME . '.tag_id',
                $rawData['sale']
            );
        }
        if (isset($rawData['orderByJob'])) {
            if ($rawData['orderByJob'] == 1) {
                $query->orderBy(self::TABLE_NAME . '.created_at', 'desc');
            } else {
                $query->orderBy(self::TABLE_NAME . '.created_at', 'asc');
            }
        }
        if (isset($rawData['orderBySale'])) {
            if ($rawData['orderBySale'] == 1) {
                $query->orderBy(self::TABLE_NAME . '.income_max', 'desc')
                    ->orderBy(self::TABLE_NAME . '.income_min', 'desc');
            } else {
                $query->orderBy(self::TABLE_NAME . '.income_min', 'asc')
                    ->orderBy(self::TABLE_NAME . '.income_max', 'desc');
            }
        }
        if (isset($rawData['orderByPost'])) {
            if ($rawData['orderByPost'] == 1) {
                $query->orderBy(self::TABLE_NAME . '.count_apply', 'desc');
            } else {
                $query->orderBy(self::TABLE_NAME . '.count_apply', 'asc');
            }
        }
        $query->select(
            self::TABLE_NAME . '.id',
            self::TABLE_NAME . '.title',
            CompanyRepository::TABLE_NAME . '.name',
            CompanyRepository::TABLE_NAME . '.address',
            self::TABLE_NAME . '.base_salary_min',
            self::TABLE_NAME . '.base_salary_max',
            self::TABLE_NAME . '.created_at',
            self::TABLE_NAME . '.income_min',
            self::TABLE_NAME . '.income_max',
            self::TABLE_NAME . '.type',
//            self::TABLE_NAME . '.count_apply',
            self::TABLE_NAME . '.job_publish',
            self::TABLE_NAME . '.job_expire',
            self::TABLE_NAME . '.is_show',
            self::TABLE_NAME . '.is_public',
            self::TABLE_NAME.'.updated_at',
            CompanyRepository::TABLE_NAME .'.short_name',
            TagRepository::TABLE_NAME . '.tag_id'
        );

        return $query
            ->orderBy('created_at', 'desc')
            ->paginate(self::ITEM_OF_PAGE);
    }

    public function getTags($tagId)
    {
        return DB::Table(TagRepository::TABLE_NAME)->where('tag_id', $tagId)->get()->toArray();
    }

    /**
     * @param $id
     * @param $dataChange
     */
    public function changeHiddenShow($id, $dataChange)
    {
        DB::table(self::TABLE_NAME)->where('id', $id)->update(['is_show'=>$dataChange['is_show']]);
    }

    /**
     * @param $id
     */
    public function publicJob($id)
    {
        DB::table(self::TABLE_NAME)->where('id', $id)->update(['is_public'=>self::IS_PUBLIC]);
    }
}
