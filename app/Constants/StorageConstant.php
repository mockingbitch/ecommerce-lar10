<?php

namespace App\Constants;

class StorageConstant
{
    public const BREADCRUMB                 = 'product';
    public const ERR_MSG_NOT_FOUND          = 'Không tìm thấy sản phẩm';
    public const ERR_MSG_CATEGORY_NOT_FOUND = 'Chưa có danh mục';
    public const ERR_MSG_CANT_PROCESS_IMAGE = 'Không thể xử lý ảnh';
    public const IMAGE_FOLDER               = 'products';
    public const ERR_MSG_PRODUCT_MODEL_NOT_FOUND  = 'Không tìm thấy mẫu sản phẩm';

    public const COLUMN_ID          = 'id';
    public const COLUMN_NAME        = 'name';
    public const COLUMN_DESCRIPTION = 'description';
    public const COLUMN_DETAIL      = 'detail';
    public const COLUMN_QUANTITY    = 'quantity';
    public const COLUMN_IMAGE       = 'image';
    public const COLUMN_PRICE       = 'price';
    public const COLUMN_CATEGORY_ID = 'category_id';
    public const COLUMN_BRAND_ID    = 'brand_id';
    public const COLUMN_STATUS      = 'status';
    public const COLUMN_CREATED_AT  = 'created_at';
    public const COLUMN_UPDATED_AT  = 'updated_at';
    public const COLUMN_DELETED_AT  = 'deleted_at';

    public const COLUMN = [
        'id'            => self::COLUMN_ID,
        'name'          => self::COLUMN_NAME,
        'description'   => self::COLUMN_DESCRIPTION,
        'image'         => self::COLUMN_IMAGE,
        'price'         => self::COLUMN_PRICE,
        'category_id'   => self::COLUMN_CATEGORY_ID,
        'status'        => self::COLUMN_STATUS,
        'created_at'    => self::COLUMN_CREATED_AT,
        'updated_at'    => self::COLUMN_UPDATED_AT,
        'deleted_at'    => self::COLUMN_DELETED_AT,
    ];

    public const STATUS_OUT_OF_STOCK   = 0;
    public const STATUS_AVAILABLE      = 1;

    public const STATUS = [
        'available'     => self::STATUS_AVAILABLE,
        'out_of_stock'  => self::STATUS_OUT_OF_STOCK
    ];
}
