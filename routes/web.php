<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/profile', function () {
    return view('creator.profile');
});
Route::get('/login', 'auth@index');
Route::post('/login', 'auth@verifylogin');
Route::get('/logout', 'auth@logout');
Route::get('/explore', 'creatorHome@index');
Route::get('/creator/signup', 'signupController@creator_index');
Route::get('/creation', 'creationController@index');
Route::post('/creator/signup', 'signupController@creator_signup');
Route::get('/collector/signup', 'signupController@collector_index');
Route::post('/collector/signup', 'signupController@collector_signup');
Route::get('/NFTs', 'adminController@viewNFT');
Route::post('/NFTs/searchNFT', 'adminController@searchNFT');
Route::get('/terms', 'termsController@commonView');
Route::get('/announcements', 'announcementController@commonView');
Route::post('/collector/signup', 'signupController@collector_signup');



Route::group(['middleware' => ['session']], function () {

    Route::group(['middleware' => ['admin']], function () {

        Route::get('/admin/home', 'adminHome@index');
        Route::post('/admin/searchActivity', 'adminHome@searchActivity');

        Route::get('/admin/addDataAnalyst', 'dataAnalystController@signup');
        Route::post('/admin/addDataAnalyst', 'signupController@dataAnalyst_signup');
        Route::get('/admin/viewDataAnalyst', 'dataAnalystController@view');


        Route::get('/admin/editProfile/{id}', 'adminController@edit');
        Route::post('/admin/editProfile/{id}', 'adminController@update');

        Route::get('/admin/adminPanel', 'adminController@view');
        Route::post('/admin/searchAdmin', 'adminController@searchAdmin');

        Route::get('/admin/terms', 'TermsController@view');
        Route::post('/admin/terms', 'TermsController@update');

        Route::get('/admin/artType', 'artTypeController@index');
        Route::post('/admin/artType', 'artTypeController@insert');
        Route::post('/admin/searchActivity', 'artTypeController@searchArtType');
        Route::get('/admin/artType/delete/{id}', 'artTypeController@delete');

        Route::get('/admin/announcement', 'announcementController@index');
        Route::post('/admin/announcement', 'announcementController@insert');
        Route::post('/admin/announcement/edit/{id}', 'announcementController@edit');
        Route::get('/admin/announcement/delete/{id}', 'announcementController@delete');

        Route::get('/admin/viewCreator', 'adminController@viewCreators');
        Route::post('/admin/searchCreator', 'adminController@searchCreator');
        Route::get('/admin/viewCreator/delete/{id}', 'adminController@deleteCreator');

        Route::get('/admin/viewCollector', 'adminController@viewCollectors');
        Route::post('/admin/searchCollector', 'adminController@searchCollector');
        Route::get('/admin/viewCollector/delete/{id}', 'adminController@deleteCollector');
    });
    Route::group(['middleware' => ['collector']], function () {
    });
    Route::group(['middleware' => ['creator']], function () {
        Route::get('/creator/home', 'creatorHome@index');
        Route::get('/home/{id}', 'nftController@index');
        Route::get('/creator/profile', 'creatorController@index');
        Route::get('/creator/profile/{userid}', 'creatorController@index');
        Route::get('/creator/profile/settings/{userid}', 'creatorController@edit');
        Route::post('/creator/profile/settings/{userid}', 'creatorController@update');
        Route::get('/creator/{id}/creation/send', 'creationController@sendindex');
        Route::post('/creator/{id}/creation/send', 'creationController@storeCreation');
        Route::post('/creator/{id}/creation/add', 'creationController@sellCreation');
        Route::get('/creator/{id}/creation/add', 'creationController@addindex');
        Route::get('/creator/account/{id}', 'accountController@index');
        Route::post('/creator/search', 'creatorHome@search');

        Route::get('/creator/sell/{id}', 'storeController@onsell');
        Route::get('/creator/sell/{id}/edit', 'storeController@editsell');
        Route::post('/creator/sell/{id}/edit', 'storeController@updatsell');
        Route::get('/creator/sell/{id}/delete', 'storeController@deletesell');

        Route::get('/creator/auction/{id}', 'auctionController@auction');
        Route::get('/creator/auction/{id}/edit', 'auctionController@editauction');
        Route::post('/creator/auction/{id}/edit', 'auctionController@updateauction');
        Route::get('/creator/auction/{id}/delete', 'auctionController@deleteauction');


        Route::get('/store', 'storeController@index');

        Route::post('/wallet/{id}', 'walletController@create');
        Route::get('/wallet/{id}', 'walletController@index');

        Route::get('/creation/{id}', 'creationController@index');

        Route::get('/auction', 'auctionController@index');

        Route::post('/nft/add/{id}/{cid}', 'nftController@add');
        Route::post('/nft/sell/{id}/{cid}', 'nftController@sell');
        Route::get('/nft/details/{id}', 'nftController@details');

        Route::get('/creations/{id}', 'nftController@creations');
        Route::get('/creations', 'nftController@creations');

        Route::get('/collections/{id}', 'nftController@collections');
        Route::get('/collections', 'nftController@collections');

        Route::get('/transactions/{id}', 'transactionController@index');
    });
    Route::group(['middleware' => ['data_analyst']], function () {
        //write manager routes here
    });
    Route::get('/collector/home', 'col_homeController@getItems');



    Route::get('/collector/home', 'col_homeController@getItems');
    Route::get('/collector/dashboard', 'col_dashboardController@index');
    Route::get('/myCollection', 'CollectionController@getCollection')->name('collector.collection');
    Route::get('/profile', 'col_profileController@index')->name('collectorProfile');

    Route::get('/collector/profileUpdate', 'Col_profileUpdateController@index');
    Route::post('/collector/profileUpdate', 'Col_profileUpdateController@update');

    Route::get('/wallet', 'walletController@collectorWallet');
    Route::get('/proof/{id}', 'authenticityController@authenticate');
    Route::get('/collectionProof/{id}', 'authenticityController@myCollectionProof');
    Route::get('/details/{id}', 'col_detailsController@getDetails');
    Route::post('/purchase/{id}', 'purchaseController@verifyPurchase');
});
