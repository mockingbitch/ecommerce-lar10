<?php

namespace App\Constants;

class RouteConstant
{
    public const HOMEPAGE   = 'home';
    public const LOGIN      = 'login';
    public const LOGOUT     = 'logout';
    public const ERROR      = 'error';

    public const DASHBOARD_HOME             = 'dashboard.home';
    public const DASHBOARD_CATEGORY_LIST    = 'dashboard.category.list';
    public const DASHBOARD_CATEGORY_CREATE  = 'dashboard.category.create';
    public const DASHBOARD_CATEGORY_UPDATE  = 'dashboard.category.update';
    public const DASHBOARD_CATEGORY_DELETE  = 'dashboard.category.delete';
    public const DASHBOARD_TABLE_LIST       = 'dashboard.table.list';
    public const DASHBOARD_TABLE_CREATE     = 'dashboard.table.create';
    public const DASHBOARD_TABLE_UPDATE     = 'dashboard.table.update';
    public const DASHBOARD_TABLE_DELETE     = 'dashboard.table.delete';
    public const DASHBOARD_PRODUCT_LIST     = 'dashboard.product.list';
    public const DASHBOARD_PRODUCT_CREATE   = 'dashboard.product.create';
    public const DASHBOARD_PRODUCT_UPDATE   = 'dashboard.product.update';
    public const DASHBOARD_PRODUCT_DELETE   = 'dashboard.product.delete';
    public const DASHBOARD_BILL_LIST        = 'dashboard.bill.list';
    public const DASHBOARD_BILL_DETAIL      = 'dashboard.bill.detail';
    public const DASHBOARD_BILL_UPDATE      = 'dashboard.bill.update';
    public const DASHBOARD_BILL_DELETE      = 'dashboard.bill.delete';
    public const DASHBOARD_USER_LIST        = 'dashboard.user.list';
    public const DASHBOARD_USER_UPDATE      = 'dashboard.user.update';
    public const DASHBOARD_CHART            = 'dashboard.chart';

    public const DASHBOARD = [
        'home'              => self::DASHBOARD_HOME,
        'category_list'     => self::DASHBOARD_CATEGORY_LIST,
        'category_create'   => self::DASHBOARD_CATEGORY_CREATE,
        'category_update'   => self::DASHBOARD_CATEGORY_UPDATE,
        'category_delete'   => self::DASHBOARD_CATEGORY_DELETE,
        'table_list'        => self::DASHBOARD_TABLE_LIST,
        'table_create'      => self::DASHBOARD_TABLE_CREATE,
        'table_update'      => self::DASHBOARD_TABLE_UPDATE,
        'table_delete'      => self::DASHBOARD_TABLE_DELETE,
        'product_list'      => self::DASHBOARD_PRODUCT_LIST,
        'product_create'    => self::DASHBOARD_PRODUCT_CREATE,
        'product_update'    => self::DASHBOARD_PRODUCT_UPDATE,
        'product_delete'    => self::DASHBOARD_PRODUCT_DELETE,
        'bill_list'         => self::DASHBOARD_BILL_LIST,
        'bill_update'       => self::DASHBOARD_BILL_UPDATE,
        'bill_delete'       => self::DASHBOARD_BILL_DELETE,
        'bill_detail'       => self::DASHBOARD_BILL_DETAIL,
        'user_list'         => self::DASHBOARD_USER_LIST,
        'user_update'       => self::DASHBOARD_USER_UPDATE,
        'chart'             => self::DASHBOARD_CHART,
    ];

    public const HOME_TABLE_LIST        = 'home.table.list';
    public const HOME_TABLE_DETAIL      = 'home.table.detail';
    public const HOME_ORDER_PRODUCTS    = 'home.order.products';
    public const HOME_ORDER_ADD         = 'home.order.add';
    public const HOME_ORDER_UPDATE      = 'home.order.update';
    public const HOME_ORDER_DELETE      = 'home.order.delete';
    public const HOME_ORDER_SUBMIT      = 'home.order.submit';
    public const HOME_ORDER_REMOVE      = 'home.order.remove';
    public const HOME_ORDER_CHECKOUT    = 'home.order.checkout';
    public const HOME_ORDER_LIST        = 'home.order.list';
    public const HOME_SEARCH            = 'home.search';

    public const HOME = [
        'search'            => self::HOME_SEARCH,
        'table_list'        => self::HOME_TABLE_LIST,
        'table_detail'      => self::HOME_TABLE_DETAIL,
        'order_products'    => self::HOME_ORDER_PRODUCTS,
        'order_add'         => self::HOME_ORDER_ADD,
        'order_update'      => self::HOME_ORDER_UPDATE,
        'order_delete'      => self::HOME_ORDER_DELETE,
        'order_submit'      => self::HOME_ORDER_SUBMIT,
        'order_remove'      => self::HOME_ORDER_REMOVE,
        'order_checkout'    => self::HOME_ORDER_CHECKOUT,
        'order_list'        => self::HOME_ORDER_LIST,
    ];
}
