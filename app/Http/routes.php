<?php

// API interface. Is used by the mobile apps

//user routes
Route::get('user/signup/{name}/{token}', 'UserController@signUp'); 
Route::get('user/signup/intranet/{idUFRJ}/{token}', 'UserController@signUpIntranet');
Route::post('user/login', 'UserController@login');
Route::put('user', 'UserController@update');
Route::put('user/saveGcmToken', 'UserController@saveGcmToken');
Route::put('user/saveFaceId', 'UserController@saveFaceId');
Route::put('user/saveProfilePicUrl', 'UserController@saveProfilePicUrl');
Route::get('user/{id}/mutualFriends', 'UserController@getMutualFriends');
Route::get('user/intranetPhoto/{hash}', 'UserController@loadIntranetPhoto');

//ride routes
Route::get('ride/all', 'RideController@listAll');
Route::post('ride', 'RideController@store');
Route::delete('ride/{rideId}', 'RideController@delete');
Route::post('ride/listFiltered', 'RideController@listFiltered');
Route::post('ride/requestJoin', 'RideController@requestJoin');
Route::get('ride/getRequesters/{rideId}', 'RideController@getRequesters');
Route::post('ride/answerJoinRequest', 'RideController@answerJoinRequest');
Route::get('ride/getMyActiveRides', 'RideController@getMyActiveRides');
Route::post('ride/leaveRide', 'RideController@leaveRide');
Route::post('ride/finishRide', 'RideController@finishRide');
Route::get('ride/getRidesHistory', 'RideController@getRidesHistory');
Route::get('ride/getRidesHistoryCount/{userId}', 'RideController@getRidesHistoryCount');
Route::post('ride/saveFeedback', 'RideController@saveFeedback');

//falae routes
Route::post('falae/sendMessage', 'FalaeController@sendMessage');

// Site interface. Used by system admins

Route::group(['middleware' => 'csrf'], function(){

    Route::get('/', [
        'as' => 'home',
        'middleware' => 'auth',
        'uses' => 'AdminController@getIndex'
    ]);

    Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

        Route::get('edit', 'AdminController@getEdit');
        Route::post('edit', 'AdminController@postEdit');

        Route::get('users', 'UserController@index');
        Route::get('users.json', 'UserController@indexJson');
        Route::get('users.excel', 'UserController@indexExcel');
        Route::post('user/{id}/banish', 'UserController@banish');
        Route::post('user/{id}/unban', 'UserController@unban');

        Route::get('ranking/better-feedback', 'RankingController@betterFeedback');
        Route::get('ranking/better-feedback.json', 'RankingController@betterFeedbackJson');
        Route::get('ranking/better-feedback.excel', 'RankingController@betterFeedbackExcel');

        Route::get('ranking/greater-riders', 'RankingController@greaterRiders');
        Route::get('ranking/greater-riders.json', 'RankingController@greaterRidersJson');
        Route::get('ranking/greater-riders.excel', 'RankingController@greaterRidersExcel');

        Route::get('ranking/greater-drivers-riders', 'RankingController@greaterDriversRiders');
        Route::get('ranking/greater-drivers-riders.json', 'RankingController@greaterDriversRidersJson');
        Route::get('ranking/greater-drivers-riders.excel', 'RankingController@greaterDriversRidersExcel');

        Route::get('ranking/greater-average-occupancy', 'RankingController@greaterAverageOccupancy');
        Route::get('ranking/greater-average-occupancy.json', 'RankingController@greaterAverageOccupancyJson');
        Route::get('ranking/greater-average-occupancy.excel', 'RankingController@greaterAverageOccupancyExcel');

        Route::get('logout', 'Auth\AuthController@getLogout');

    });

    Route::get('auth/login', 'Auth\AuthController@getLogin');
    Route::post('auth/login', 'Auth\AuthController@postLogin');

    Route::get('password/email', 'Auth\PasswordController@getEmail');
    Route::post('password/email', 'Auth\PasswordController@postEmail');

    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('password/reset', 'Auth\PasswordController@postReset');

});