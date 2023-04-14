<?php

namespace App\Constants;

class RouteConstant
{
    public const HOMEPAGE   = 'home';
    public const LOGIN      = 'login';
    public const LOGOUT     = 'logout';
    public const ERROR      = 'error';

    public const CHANGE_LANG = 'change_language';

    public const DASHBOARD_HOME             = 'dashboard.home';
    public const DASHBOARD_CATEGORY_LIST    = 'dashboard.category.list';
    public const DASHBOARD_CATEGORY_CREATE  = 'dashboard.category.create';
    public const DASHBOARD_CATEGORY_UPDATE  = 'dashboard.category.update';
    public const DASHBOARD_CATEGORY_DELETE  = 'dashboard.category.delete';
    public const DASHBOARD_BRAND_LIST       = 'dashboard.brand.list';
    public const DASHBOARD_BRAND_CREATE     = 'dashboard.brand.create';
    public const DASHBOARD_BRAND_UPDATE     = 'dashboard.brand.update';
    public const DASHBOARD_BRAND_DELETE     = 'dashboard.brand.delete';
    public const DASHBOARD_PRODUCT_LIST     = 'dashboard.product.list';
    public const DASHBOARD_PRODUCT_CREATE   = 'dashboard.product.create';
    public const DASHBOARD_PRODUCT_UPDATE   = 'dashboard.product.update';
    public const DASHBOARD_PRODUCT_DELETE   = 'dashboard.product.delete';
    public const DASHBOARD_PRODUCT_MODEL_LIST     = 'dashboard.product.model.list';
    public const DASHBOARD_PRODUCT_MODEL_CREATE   = 'dashboard.product.model.create';
    public const DASHBOARD_PRODUCT_MODEL_UPDATE   = 'dashboard.product.model.update';
    public const DASHBOARD_PRODUCT_MODEL_DELETE   = 'dashboard.product.model.delete';
    public const DASHBOARD_STORAGE_LIST     = 'dashboard.storage.list';
    public const DASHBOARD_STORAGE_CREATE   = 'dashboard.storage.create';
    public const DASHBOARD_STORAGE_UPDATE   = 'dashboard.storage.update';
    public const DASHBOARD_STORAGE_DELETE   = 'dashboard.storage.delete';
    public const DASHBOARD_ORDER_LIST        = 'dashboard.order.list';
    public const DASHBOARD_ORDER_DETAIL      = 'dashboard.order.detail';
    public const DASHBOARD_ORDER_UPDATE      = 'dashboard.order.update';
    public const DASHBOARD_ORDER_DELETE      = 'dashboard.order.delete';
    public const DASHBOARD_USER_LIST        = 'dashboard.user.list';
    public const DASHBOARD_USER_UPDATE      = 'dashboard.user.update';
    public const DASHBOARD_CHART            = 'dashboard.chart';

    public const DASHBOARD = [
        'home'                      => self::DASHBOARD_HOME,
        'category_list'             => self::DASHBOARD_CATEGORY_LIST,
        'category_create'           => self::DASHBOARD_CATEGORY_CREATE,
        'category_update'           => self::DASHBOARD_CATEGORY_UPDATE,
        'category_delete'           => self::DASHBOARD_CATEGORY_DELETE,
        'brand_list'                => self::DASHBOARD_BRAND_LIST,
        'brand_create'              => self::DASHBOARD_BRAND_CREATE,
        'brand_update'              => self::DASHBOARD_BRAND_UPDATE,
        'brand_delete'              => self::DASHBOARD_BRAND_DELETE,
        'product_list'              => self::DASHBOARD_PRODUCT_LIST,
        'product_create'            => self::DASHBOARD_PRODUCT_CREATE,
        'product_update'            => self::DASHBOARD_PRODUCT_UPDATE,
        'product_delete'            => self::DASHBOARD_PRODUCT_DELETE,
        'product_model_list'        => self::DASHBOARD_PRODUCT_MODEL_LIST,
        'product_model_create'      => self::DASHBOARD_PRODUCT_MODEL_CREATE,
        'product_model_update'      => self::DASHBOARD_PRODUCT_MODEL_UPDATE,
        'product_model_delete'      => self::DASHBOARD_PRODUCT_MODEL_DELETE,
        'storage_list'              => self::DASHBOARD_STORAGE_LIST,
        'storage_create'            => self::DASHBOARD_STORAGE_CREATE,
        'storage_update'            => self::DASHBOARD_STORAGE_UPDATE,
        'storage_delete'            => self::DASHBOARD_STORAGE_DELETE,
        'order_list'                 => self::DASHBOARD_ORDER_LIST,
        'order_update'               => self::DASHBOARD_ORDER_UPDATE,
        'order_delete'               => self::DASHBOARD_ORDER_DELETE,
        'order_detail'               => self::DASHBOARD_ORDER_DETAIL,
        'user_list'                 => self::DASHBOARD_USER_LIST,
        'user_update'               => self::DASHBOARD_USER_UPDATE,
        'chart'                     => self::DASHBOARD_CHART,
    ];

    public const HOME_BRAND_LIST        = 'home.brand.list';
    public const HOME_BRAND_DETAIL      = 'home.brand.detail';
    public const HOME_ORDER_PRODUCTS    = 'home.order.products';
    public const HOME_ORDER_ADD         = 'home.order.add';
    public const HOME_ORDER_UPDATE      = 'home.order.update';
    public const HOME_ORDER_DELETE      = 'home.order.delete';
    public const HOME_ORDER_SUBMIT      = 'home.order.submit';
    public const HOME_ORDER_REMOVE      = 'home.order.remove';
    public const HOME_ORDER_CHECKOUT    = 'home.order.checkout';
    public const HOME_ORDER_LIST        = 'home.order.list';
    public const HOME_SEARCH            = 'home.search';

    public const HOME_LIST_PRODUCT      = 'home.list.product';
    public const HOME_LIST_CART         = 'home.list.cart';
    public const HOME_PRODUCT_DETAIL    = 'home.product.detail';
    public const HOME_ADD_CART          = 'home.add.cart';
    public const HOME_UPDATE_CART       = 'home.update.cart';
    public const HOME_REMOVE_CART       = 'home.remove.cart';
    public const HOME_CHECK_OUT         = 'home.checkout';
    public const HOME_CONFIRM_CHECKOUT  = 'home.confirm.checkout';
}
