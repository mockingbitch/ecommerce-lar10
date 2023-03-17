<?php

namespace App\Constants;

class Constant
{
    const MSG_SUCCESS = 'message_success';
    const MSG_ERROR = 'message_error';
    const MSG_INFO = 'message_info';

    public const ERR_CODE_FAIL      = 0;
    public const ERR_CODE_SUCCESS   = 1;

    public const DATE_FORMAT_DMY    = 'dd-MM-yyyy';
    public const DATE_FORMAT_YMD    = 'Y-m-d';
    public const DATE_FORMAT_M      = 'm';
    public const DATE_FORMAT_D      = 'd';
    public const DATE_MONTH         = 'month';
    public const DATE_DAY           = 'day';
    public const DATE_YEAR          = 'year';
    public const DATE_NOW           = 'now';
    public const CONDITION_TENDAYSFROMNOW = 'TENDAYSFROMNOW';
    public const CONDITION_TENDAYSLASTMONTH = 'TENDAYSLASTMONTH';
    public const CONDITION_TENMONTHSLASTYEAR = 'TENMONTHSLASTYEAR';

    public const ERR_CODE = [
        'fail'    => self::ERR_CODE_FAIL,
        'success' => self::ERR_CODE_SUCCESS
    ];

    public const ERR_MSG_CREATE_FAIL    = 'Thêm mới thất bại';
    public const ERR_MSG_CREATE_SUCCESS = 'Thêm mới thành công';
    public const ERR_MSG_UPDATE_FAIL    = 'Cập nhật thất bại';
    public const ERR_MSG_UPDATE_SUCCESS = 'Cập nhật thành công';
    public const ERR_MSG_DELETE_FAIL    = 'Xóa thất bại';
    public const ERR_MSG_DELETE_SUCCESS = 'Xóa thành công';

    public const ERR_MSG = [
        'create_fail'    => self::ERR_MSG_CREATE_FAIL,
        'create_success' => self::ERR_MSG_CREATE_SUCCESS,
        'update_fail'    => self::ERR_MSG_UPDATE_FAIL,
        'update_success' => self::ERR_MSG_UPDATE_SUCCESS,
        'delete_fail'    => self::ERR_MSG_DELETE_FAIL,
        'delete_success' => self::ERR_MSG_DELETE_SUCCESS
    ];

    public const STATUS_AVAILABLE   = 'AVAILABLE';
    public const STATUS_UNAVAILABLE = 'UNAVAILABLE';

    public const STATUS = [
        'available'     => self::STATUS_AVAILABLE,
        'unavailable'   => self::STATUS_UNAVAILABLE
    ];
}
