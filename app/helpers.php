<?php
if (!function_exists('getGroupSales')) {
    function getGroupSales()
    {
        return [
            1 => 'Sales Admin',
            5 => 'Sales tại quầy',
            6 => 'Sales online',
            3 => 'Sales tư vấn',
            4 => 'Sales thị trường',
            2 => 'Telesale',
        ];
    }
}
if (!function_exists('getParseSales')) {
    function getParseSales($tagId)
    {
        if($tagId ==1){
            return 'Sales Admin';
        }
        if($tagId ==2){
            return 'Telesale';
        }
        if($tagId ==3){
            return 'Sales tư vấn';
        }
        if($tagId ==4){
            return 'Sales thị trường';
        }
        if($tagId ==5){
            return 'Sales tại quầy';
        }
        if($tagId ==6){
            return 'Sales online';
        }

    }
}
if (!function_exists('getDegree')) {
    function getDegree()
    {
        return [
            1 => 'Trung cấp',
            2 => 'Cao đẳng',
            3 => 'Đại Học',
            4 => 'Trên đại học',
            5 => 'Trung học phổ thông',
            6 => 'Không yêu cầu bằng cấp ',
        ];
    }
}
if (!function_exists('getParseDegree')) {
    function getParseDegree($degreeId)
    {
        if($degreeId ==1){
            return 'Trung cấp';
        }
        if($degreeId ==2){
            return 'Cao đẳng';
        }
        if($degreeId ==3){
            return 'Đại Học';
        }
        if($degreeId ==4){
            return 'Trên đại học';
        }
        if($degreeId ==5){
            return 'Trung học phổ thông';
        }
        if($degreeId ==6){
            return 'Không yêu cầu bằng cấp';
        }

    }
}
if (!function_exists('getExperienceAdd')) {
    function getExperienceAdd($degreeId)
    {
        if($degreeId ==1){
            return 'Chưa có kinh nghiệm';
        }
        if($degreeId ==2){
            return '6 tháng';
        }
        if($degreeId ==3){
            return '1 năm';
        }
        if($degreeId ==4){
            return '2 năm';
        }
        if($degreeId ==5){
            return '3 năm';
        }
        if($degreeId ==6){
            return 'Nhiều hơn 3 năm ';
        }
    }
}
if (!function_exists('getExperience')) {
    function getExperience()
    {
        return [
            1 => 'Chưa có kinh nghiệm ',
            2 => '6 tháng',
            3 => '1 năm',
            4 => '2 năm ',
            5 => '3 năm ',
            6 => 'Nhiều hơn 3 năm ',
        ];
    }
}
if (!function_exists('getRank')) {
    function getRank()
    {
        return [
            4 => 'Trưởng phòng ',
            2 => 'Trưởng nhóm',
            3 => 'Phó phòng',
            1 => 'Nhân viên ',
            5 => 'Thực tập sinh ',
        ];
    }
}

if (!function_exists('getCache')) {
    function getCache($key)
    {
        return \Illuminate\Support\Facades\Cache::get($key);
    }
}

if (!function_exists('setCache')) {
    function setCache($key, $data, $expire = null)
    {
        if ($expire) {
            return \Illuminate\Support\Facades\Cache::put($key, $data, $expire);
        } else {
            return \Illuminate\Support\Facades\Cache::put($key, $data);
        }
    }
}

if (!function_exists('deleteCache')) {
    function deleteCache($key)
    {
        return \Illuminate\Support\Facades\Cache::forget($key);
    }
}

if(!function_exists('generateRandomString')) {
    function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}

