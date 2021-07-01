<?php

use LaravelAcl\Authentication\Classes\Menu\SentryMenuFactory;
use Foostart\Category\Helpers\FooCategory;
use Foostart\Category\Helpers\SortTable;

/*
|-----------------------------------------------------------------------
| GLOBAL VARIABLES
|-----------------------------------------------------------------------
|   $sidebar_items
|   $sorting
|   $order_by
|   $plang_admin = 'company-admin'
|   $plang_front = 'company-front'
*/

View::composer([
    'package-trainer::admin.trainer-edit',
    'package-trainer::admin.trainer-form',
    'package-trainer::admin.trainer-items',
    'package-trainer::admin.trainer-item',
    'package-trainer::admin.trainer-search',
    'package-trainer::admin.trainer-config',
    'package-trainer::admin.trainer-lang',
], function ($view) {

    //Order by params
    $params = Request::all();

    /**
     * $plang-admin
     * $plang-front
     */

    $plang_admin = 'trainer-admin';
    $plang_front = 'trainer-front';

    $fooCategory = new FooCategory();
    $key = $fooCategory->getContextKeyByRef('admin/trainer');

    /**
     * $sidebar_items
     */
    $sidebar_items = [
        trans('trainer-admin.sidebar.add') => [
            'url' => URL::route('trainer.edit', []),
            'icon' => '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
        ],
        trans('trainer-admin.sidebar.list') => [
            "url" => URL::route('trainer.list', []),
            'icon' => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
        ],
    ];

    /**
     * $sorting
     * $order_by
     */
    $orders = [
        '' => trans($plang_admin . '.form.no-selected'),
        'id' => trans($plang_admin . '.fields.id'),
        'trainer_name' => trans($plang_admin . '.fields.name'),
        'trainer_status' => trans($plang_admin . '.fields.status'),
        'updated_at' => trans($plang_admin . '.fields.updated_at'),
    ];
    $sortTable = new SortTable();
    $sortTable->setOrders($orders);
    $sorting = $sortTable->linkOrders();



    //Order by
    $order_by = [
        'asc' => trans('category-admin.order.by-asc'),
        'desc' => trans('category-admin.order.by-des'),
    ];

    // assign to view
    $view->with('sidebar_items', $sidebar_items);
    $view->with('order_by', $order_by);
    $view->with('sorting', $sorting);
    $view->with('plang_admin', $plang_admin);
    $view->with('plang_front', $plang_front);
});
