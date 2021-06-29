<?php

use Illuminate\Session\TokenMismatchException;

/**
 * FRONT
 */
Route::get('trainer', [
    'as' => 'trainer',
    'uses' => 'Foostart\Trainer\Controllers\Front\CompanyFrontController@index'
]);
Route::get('trainer/search/', [
    'as' => 'trainer',
    'uses' => 'Foostart\Trainer\Controllers\Front\CompanyFrontController@search'
]);
Route::get('trainer/{slug}', [
    'as' => 'trainer',
    'uses' => 'Foostart\Trainer\Controllers\Front\CompanyFrontController@show'
]);

/**
 * ADMINISTRATOR
 */
Route::group(['middleware' => ['web']], function () {

    Route::group([
        'middleware' => ['admin_logged', 'can_see', 'in_context'],
        'namespace' => 'Foostart\Trainer\Controllers\Admin',
    ], function () {

        /*
          |-----------------------------------------------------------------------
          | Manage company
          |-----------------------------------------------------------------------
          | 1. List of companies
          | 2. Edit company
          | 3. Delete company
          | 4. Add new company
          | 5. Manage configurations
          | 6. Manage languages
          |
        */

        /**
         * list
         */
        Route::get('admin/trainer', [
            'as' => 'trainer.list',
            'uses' => 'TrainerAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/trainer/edit', [
            'as' => 'trainer.edit',
            'uses' => 'TrainerAdminController@edit'
        ]);

        /**
         * copy
         */
        Route::get('admin/trainer/copy', [
            'as' => 'trainer.copy',
            'uses' => 'TrainerAdminController@copy'
        ]);

        /**
         * company
         */
        Route::post('admin/trainer/edit', [
            'as' => 'trainer.company',
            'uses' => 'TrainerAdminController@trainer'
        ]);

        /**
         * delete
         */
        Route::get('admin/trainer/delete', [
            'as' => 'trainer.delete',
            'uses' => 'TrainerAdminController@delete'
        ]);

        /**
         * trash
         */
        Route::get('admin/trainer/trash', [
            'as' => 'trainer.trash',
            'uses' => 'TrainerAdminController@trash'
        ]);

        /**
         * configs
         */
        Route::get('admin/trainer/config', [
            'as' => 'trainer.config',
            'uses' => 'TrainerAdminController@config'
        ]);

        Route::post('admin/trainer/config', [
            'as' => 'trainer.config',
            'uses' => 'TrainerAdminController@config'
        ]);

        /**
         * language
         */
        Route::get('admin/trainer/lang', [
            'as' => 'trainer.lang',
            'uses' => 'TrainerAdminController@lang'
        ]);

        Route::post('admin/trainer/lang', [
            'as' => 'trainer.lang',
            'uses' => 'TrainerAdminController@lang'
        ]);
    });
});
