<?php


namespace App\Service\AuthorizationService;


class PermissionConstant
{
    const USER_SYS_LIST_VIEW = 'user_sys_list_view';
    const USER_SYS_DETAIL_VIEW = 'user_sys_detail_view';
    const USER_SYS_DETAIL_ADD = 'user_sys_detail_add';
    const USER_SYS_DETAIL_DELETE = 'user_sys_detail_delete';
    const USER_RESET_PASS = 'user_reset_pass';
//    const USER_CHANGE_PASS = 'user_change_pass';
    const USER_SYS_DETAIL_UPDATE = 'user_sys_detail_update';

    // ROLE
    const ROLE_SYS_LIST_VIEW = 'role_sys_list_view';
    const ROLE_SYS_ADD = 'role_sys_add';
    const ROLE_SYS_NAME_EDIT = 'role_sys_name_edit';
    const ROLE_SYS_PERMISSION_CONTROL = 'role_sys_permission_control';
    const ROLE_SYS_DELETE = 'role_sys_delete';
    //JOB
    const JOB_SYS_LIST_VIEW     = 'job_sys_list_view';
    const JOB_SYS_DETAIL_VIEW   = 'job_sys_detail_view';
    const JOB_SYS_DETAIL_ADD    = 'job_sys_detail_add';
    const JOB_SYS_DETAIL_EDIT   = 'job_sys_detail_edit';
    const JOB_SYS_DETAIL_DELETE = 'job_sys_detail_delete';
    const JOB_SYS_DETAIL_HIDDEN = 'job_sys_detail_hidden';
    const JOB_SYS_WARNING       = 'job_sys_warning';

    //COMPANY
    const ROLE_COMPANY_SYS_LIST_VIEW = 'company_sys_list_view';
    const ROLE_COMPANY_SYS_ADD = 'company_sys_add';
    const ROLE_COMPANY_SYS_DELETE = 'company_sys_delete';
    const ROLE_COMPANY_SYS_DETAIL_EDIT = 'company_sys_detail_edit';
    const ROLE_COMPANY_SYS_DETAIL_VIEW = 'company_sys_detail_view';
    const ROLE_COMPANY_SYS_USER_CONTROL = 'company_sys_user_control';

    //EMPLOYER
    const ROLE_ADMIN_EMPLOYER_ADD_PACKAGE = 'employer_sys_add_package_product';
    const ROLE_ADMIN_LIST_EMPLOYER_USE_PACKAGE = 'employer_sys_list_use_package_product';
}
