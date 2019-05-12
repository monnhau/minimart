<?php
Route::pattern('id', '([0-9]*)');
Route::pattern('sid', '([0-9]*)');
Route::pattern('presentStatus', '([0-9]*)');
Route::pattern('slug', '(.*)');
Route::pattern('code', '(.*)');
Route::pattern('username', '(.*)');

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

Route::get('/welcome', function(){
    return view('welcome');
});

Route::namespace('Minimart')->prefix('')->group(function(){
    Route::get('', [
        'uses'=>'IndexController@index',
        'as'=>'minimart.index.index'
    ]);

    Route::prefix('contact')->group(function(){
        Route::get('/', [
            'uses'=>'ContactController@getIndex',
            'as'=>'minimart.contact.index'
        ]);

        Route::post('/', [
            'uses'=>'ContactController@postIndex',
            'as'=>'minimart.contact.index'
        ]);
    });
});

Route::namespace('Auth')->prefix('auth')->group(function(){
    Route::get('/login', [
        'uses'=>'AuthController@getLogin',
        'as'=>'auth.auth.login'
    ]);

    Route::post('/login', [
        'uses'=>'AuthController@postLogin',
        'as'=>'auth.auth.login'
    ]);

    Route::get('/logout', [
        'uses'=>'AuthController@logout',
        'as'=>'auth.auth.logout'
    ]);

    Route::get('/register', [
        'uses'=>'AuthController@getRegister',
        'as'=>'auth.auth.register'
    ]);

    Route::post('/register', [
        'uses'=>'AuthController@postRegister',
        'as'=>'auth.auth.register'
    ]);

    Route::get('/activate-email/{id}/{username}', [
        'uses'=>'AuthController@activateEmail',
        'as'=>'auth.auth.activateEmail'
    ]);

    Route::get('/activate-email-again/{username}', [
        'uses'=>'AuthController@activateEmailAgain',
        'as'=>'auth.auth.activateEmailAgain'
    ]);

    Route::get('/forgot-password', [
        'uses'=>'AuthController@getForgotPassword',
        'as'=>'auth.auth.forgotPassword'
    ]);

    Route::post('/forgot-password', [
        'uses'=>'AuthController@postForgotPassword',
        'as'=>'auth.auth.forgotPassword'
    ]);

    Route::get('/reset-password/{username}/{code}', [
        'uses'=>'AuthController@getResetPassword',
        'as'=>'auth.auth.resetPassword'
    ]);

    Route::post('/reset-password/{username}/{code}', [
        'uses'=>'AuthController@postResetPassword',
        'as'=>'auth.auth.resetPassword'
    ]);

    //---BEGIN TEST Function , Không sử dụng đến
    Route::get('/register-kc', [
        'uses'=>'AuthController@getRegisterKC',
        'as'=>'auth.auth.registerKC'
    ]);

    Route::post('/register-kc', [
        'uses'=>'AuthController@postRegisterKC',
        'as'=>'auth.auth.registerKC'
    ]);

    Route::get('/set-cookie', [
        'uses'=>'AuthController@setCookie',
        'as'=>'auth.auth.setCookie'
    ]);

    Route::get('/get-cookie', [
        'uses'=>'AuthController@getCookie',
        'as'=>'auth.auth.getCookie'
    ]);

    //---END TEST Function , Không sử dụng đến

});

Route::namespace('Admin')->prefix('admin')->middleware('auth')->middleware('PhanSuAdmin')->group(function(){
    Route::get('/', [
        'uses'=>'IndexController@index',
        'as'=>'admin.index.index'
    ]);

    Route::get('/index-demo', [
        'uses'=>'IndexController@indexDemo',
        'as'=>'admin.index.indexDemo'
    ]);

    Route::get('/index-demo-content', [
        'uses'=>'IndexController@indexDemoContent',
        'as'=>'admin.index.indexDemoContent'
    ]);

    Route::get('/index-demo-logo', [
        'uses'=>'IndexController@indexDemoLogo',
        'as'=>'admin.index.indexDemoLogo'
    ]);

    //BEGIN Quan li nhat ki
    Route::prefix('log')->group(function(){
        Route::get('/', [
            'uses'=>'LogController@index',
            'as'=>'admin.log.index'
        ]);

        Route::get('/del/{id}', [
            'uses'=>'LogController@del',
            'as'=>'admin.log.del'
        ]);

        Route::get('/search', [
            'uses'=>'LogController@search',
            'as'=>'admin.log.search'
        ]);

    });

    //BEGIN Quan li slide
    Route::prefix('slide')->group(function(){
        Route::get('/', [
            'uses'=>'SlideController@index',
            'as'=>'admin.slide.index'
        ]);

        Route::get('/add', [
            'uses'=>'SlideController@getAdd',
            'as'=>'admin.slide.add'
        ]);

        Route::post('/add', [
            'uses'=>'SlideController@postAdd',
            'as'=>'admin.slide.add'
        ]);

        Route::post('/toggo-active-status', [
            'uses'=>'SlideController@ajaxToggoActiveStatus',
            'as'=>'admin.slide.ajaxToggoActiveStatus'
        ]);

        Route::get('/edit/{id}', [
            'uses'=>'SlideController@getEdit',
            'as'=>'admin.slide.edit'
        ]);

        Route::post('/edit/{id}', [
            'uses'=>'SlideController@postEdit',
            'as'=>'admin.slide.edit'
        ]);

        Route::get('/del/{id}', [
            'uses'=>'SlideController@del',
            'as'=>'admin.slide.del'
        ]);

        Route::get('/edit-picture/{id}', [
            'uses'=>'SlideController@getEditPicture',
            'as'=>'admin.slide.editPicture'
        ]);

        Route::post('/edit-picture/{id}', [
            'uses'=>'SlideController@postEditPicture',
            'as'=>'admin.slide.editPicture'
        ]);

        Route::get('/select-picture-available/{id}', [
            'uses'=>'SlideController@selectPictureAvailable',
            'as'=>'admin.slide.selectPictureAvailable'
        ]);

        Route::get('/edit-picture-available/{id}/{slug}', [
            'uses'=>'SlideController@editPictureAvailable',
            'as'=>'admin.slide.editPictureAvailable'
        ]);

        Route::get('/show-storage-slide', [
            'uses'=>'SlideController@showStorageSlide',
            'as'=>'admin.slide.showStorageSlide'
        ]);

        Route::get('/del_picture/{slug}', [
            'uses'=>'SlideController@delPicture',
            'as'=>'admin.slide.delPicture'
        ]);
    });

    //BEGIN Quan li lien he
    Route::prefix('contact')->group(function(){
        Route::get('/', [
            'uses'=>'ContactController@index',
            'as'=>'admin.contact.index'
        ]);

        Route::get('/del/{id}', [
            'uses'=>'ContactController@del',
            'as'=>'admin.contact.del'
        ]);

        Route::get('/search', [
            'uses'=>'ContactController@search',
            'as'=>'admin.contact.search'
        ]);

    });


    //BEGIN Quan li Chuc vu
    Route::prefix('role')->middleware('PhanSuUser')->group(function(){
        Route::get('/', [
            'uses'=>'RoleController@index',
            'as'=>'admin.role.index'
        ]);

        Route::get('/add', [
            'uses'=>'RoleController@getAdd',
            'as'=>'admin.role.add'
        ]);

        Route::post('/add', [
            'uses'=>'RoleController@postAdd',
            'as'=>'admin.role.add'
        ]);

        Route::get('/del/{id}', [
            'uses'=>'RoleController@del',
            'as'=>'admin.role.del'
        ]);

        Route::post('/toggo-active-status-ps', [
            'uses'=>'RoleController@ajaxToggoActiveStatusPS',
            'as'=>'admin.role.ajaxToggoActiveStatusPS'
        ]);

    });

    //BEGIN Quan li nguoi dung
    Route::prefix('users')->middleware('PhanSuUser')->group(function(){
        Route::get('/', [
            'uses'=>'UserController@index',
            'as'=>'admin.users.index'
        ]);

        Route::get('/add', [
            'uses'=>'UserController@getAdd',
            'as'=>'admin.users.add'
        ]);

        Route::post('/add', [
            'uses'=>'UserController@postAdd',
            'as'=>'admin.users.add'
        ]);

        Route::get('/del/{id}', [
            'uses'=>'UserController@del',
            'as'=>'admin.users.del'
        ]);

        Route::get('/edit/{id}', [
            'uses'=>'UserController@getEdit',
            'as'=>'admin.users.edit'
        ]);

        Route::post('/edit/{id}', [
            'uses'=>'UserController@postEdit',
            'as'=>'admin.users.edit'
        ]);

        Route::get('/search', [
            'uses'=>'UserController@search',
            'as'=>'admin.users.search'
        ]);
    });

    //BEGIN Quan li Danh muc
    Route::prefix('cat')->middleware('PhanSuDanhMuc')->group(function(){
        Route::get('/', [
            'uses'=>'CatController@index',
            'as'=>'admin.cat.index'
        ]);

        Route::get('/add', [
            'uses'=>'CatController@getAdd',
            'as'=>'admin.cat.add'
        ]);

        Route::post('/add', [
            'uses'=>'CatController@postAdd',
            'as'=>'admin.cat.add'
        ]);

        Route::get('/del/{id}', [
            'uses'=>'CatController@del',
            'as'=>'admin.cat.del'
        ]);

        Route::get('/edit/{id}', [
            'uses'=>'CatController@getEdit',
            'as'=>'admin.cat.edit'
        ]);

        Route::post('/edit/{id}', [
            'uses'=>'CatController@postEdit',
            'as'=>'admin.cat.edit'
        ]);

        Route::post('/toggo-active-status', [
            'uses'=>'CatController@ajaxToggoActiveStatus',
            'as'=>'admin.cat.ajaxToggoActiveStatus'
        ]);
    });

    //BEGIN Quan li san pham
    Route::prefix('product')->middleware('PhanSuProduct')->group(function(){
        Route::get('/', [
            'uses'=>'ProductController@index',
            'as'=>'admin.product.index'
        ]);

        Route::get('/add', [
            'uses'=>'ProductController@getAdd',
            'as'=>'admin.product.add'
        ]);

        Route::post('/add', [
            'uses'=>'ProductController@postAdd',
            'as'=>'admin.product.add'
        ]);

        Route::get('/del/{id}', [
            'uses'=>'ProductController@del',
            'as'=>'admin.product.del'
        ]);

        Route::get('/edit/{id}', [
            'uses'=>'ProductController@getEdit',
            'as'=>'admin.product.edit'
        ]);

        Route::post('/edit/{id}', [
            'uses'=>'ProductController@postEdit',
            'as'=>'admin.product.edit'
        ]);

        Route::get('/edit-picture/{id}', [
            'uses'=>'ProductController@getEditPicture',
            'as'=>'admin.product.editPicture'
        ]);

        Route::post('/edit-picture/{id}', [
            'uses'=>'ProductController@postEditPicture',
            'as'=>'admin.product.editPicture'
        ]);

        Route::get('/select-picture-available/{id}', [
            'uses'=>'ProductController@selectPictureAvailable',
            'as'=>'admin.product.selectPictureAvailable'
        ]);

        Route::get('/edit-picture-available/{id}/{slug}', [
            'uses'=>'ProductController@editPictureAvailable',
            'as'=>'admin.product.editPictureAvailable'
        ]);

        Route::post('/toggo-active-status', [
            'uses'=>'ProductController@ajaxToggoActiveStatus',
            'as'=>'admin.product.ajaxToggoActiveStatus'
        ]);

        Route::get('/toggo-active-km-status/{presentStatus}/{id}', [
            'uses'=>'ProductController@toggoActiveKmStatus',
            'as'=>'admin.product.toggoActiveKmStatus'
        ]);

        Route::post('/show-km-text', [
            'uses'=>'ProductController@ajaxShowKmText',
            'as'=>'admin.product.ajaxShowKmText'
        ]);

        Route::get('/toggo-active-price-status/{presentStatus}/{id}', [
            'uses'=>'ProductController@toggoActivePriceStatus',
            'as'=>'admin.product.toggoActivePriceStatus'
        ]);

        Route::post('/show-price-text', [
            'uses'=>'ProductController@ajaxShowPriceText',
            'as'=>'admin.product.ajaxShowPriceText'
        ]);

        Route::get('/search', [
            'uses'=>'ProductController@search',
            'as'=>'admin.product.search'
        ]);


        //for Batch
        Route::get('/index-batch/{id}', [
            'uses'=>'ProductController@indexBatch',
            'as'=>'admin.product.indexBatch'
        ]);

        Route::get('/add-batch/{id}', [
            'uses'=>'ProductController@getAddBatch',
            'as'=>'admin.product.addBatch'
        ]);

        Route::post('/add-batch/{id}', [
            'uses'=>'ProductController@postAddBatch',
            'as'=>'admin.product.addBatch'
        ]);

        Route::get('/del-batch/{id}/{sid}', [
            'uses'=>'ProductController@delBatch',
            'as'=>'admin.product.delBatch'
        ]);

        Route::get('/edit-batch/{id}/{sid}', [
            'uses'=>'ProductController@getEditBatch',
            'as'=>'admin.product.editBatch'
        ]);

        Route::post('/edit-batch/{id}/{sid}', [
            'uses'=>'ProductController@postEditBatch',
            'as'=>'admin.product.editBatch'
        ]);

        Route::get('/toggle-active-status-batch/{presentStatus}/{id}/{sid}', [
            'uses'=>'ProductController@toggoActiveStatusBatch',
            'as'=>'admin.product.toggoActiveStatusBatch'
        ]);

    });

    //BEGIN Quan li xuat kho
    Route::prefix('export')->group(function(){
        Route::get('/', [
            'uses'=>'ExportController@index',
            'as'=>'admin.export.index'
        ]);

        Route::get('/export', [
            'uses'=>'ExportController@getExport',
            'as'=>'admin.export.export'
        ]);

        Route::post('/export', [
            'uses'=>'ExportController@postExport',
            'as'=>'admin.export.export'
        ]);

        Route::post('/ajax-them-dong', [
            'uses'=>'ExportController@ajaxThemDong',
            'as'=>'admin.export.ajaxThemDong'
        ]);

        Route::post('/ajax-xoa-dong', [
            'uses'=>'ExportController@ajaxXoaDong',
            'as'=>'admin.export.ajaxXoaDong'
        ]);

        Route::post('/ajax-search_product_by_id_batch', [
            'uses'=>'ExportController@ajaxSearchProductByIdBatch',
            'as'=>'admin.export.ajaxSearchProductByIdBatch'
        ]);

        Route::post('/ajax-check-qty-by-id-batch', [
            'uses'=>'ExportController@ajaxCheckQtyByIdBatch',
            'as'=>'admin.export.ajaxCheckQtyByIdBatch'
        ]);

    });

    //BEGIN Quan li vi tri hang hoa
    Route::prefix('position')->group(function(){
        Route::get('/', [
            'uses'=>'PositionController@index',
            'as'=>'admin.position.index'
        ]);
    });

    //BEGIN Quan li tuy chinh
    Route::prefix('valueoption')->middleware('PhanSuGiaoDien')->group(function(){
        //BEGIN Quan_ly_logo
        Route::get('/index-logo', [
            'uses'=>'ValueOptionController@indexLogo',
            'as'=>'admin.valueOption.indexLogo'
        ]);

        Route::get('/show-storage-logo', [
            'uses'=>'ValueOptionController@showStorageLogo',
            'as'=>'admin.valueOption.showStorageLogo'
        ]);

        Route::get('/del-logo/{slug}', [
            'uses'=>'ValueOptionController@delLogo',
            'as'=>'admin.valueOption.delLogo'
        ]);

            //BEGIN Update_Logo
            Route::get('/update-logo', [
                'uses'=>'ValueOptionController@getUpdateLogo',
                'as'=>'admin.valueOption.updateLogo'
            ]);
    
            Route::post('/update-logo', [
                'uses'=>'ValueOptionController@postUpdateLogo',
                'as'=>'admin.valueOption.updateLogo'
            ]);
    
            Route::get('/update-logo-cancel', [
                'uses'=>'ValueOptionController@updateLogoCancel',
                'as'=>'admin.valueOption.updateLogoCancel'
            ]);
    
            Route::get('/update-logo-real', [
                'uses'=>'ValueOptionController@updateLogoReal',
                'as'=>'admin.valueOption.updateLogoReal'
            ]);
    
            Route::get('/select-logo-available', [
                'uses'=>'ValueOptionController@selectLogoAvailable',
                'as'=>'admin.valueOption.selectLogoAvailable'
            ]);
    
            Route::get('/update-logo-available/{slug}', [
                'uses'=>'ValueOptionController@updateLogoAvailable',
                'as'=>'admin.valueOption.updateLogoAvailable'
            ]);
        //BEGIN Quan_ly_logo

        //BEGIN Doi_mau_nen
        Route::get('/update-maunen-demo', [
            'uses'=>'ValueOptionController@getUpdateMauDemo',
            'as'=>'admin.valueOption.updateMauNen'
        ]);

        Route::post('/update-maunen-demo', [
            'uses'=>'ValueOptionController@postUpdateMauDemo',
            'as'=>'admin.valueOption.updateMauNen'
        ]);

        Route::get('/update-maunen-real', [
            'uses'=>'ValueOptionController@updateMauNenReal',
            'as'=>'admin.valueOption.updateMauNenReal'
        ]);
        //END Doi_mau_nen

        //BEGIN mau_nen_content
        Route::get('/update-maunen-content-demo', [
            'uses'=>'ValueOptionController@getUpdateMauContentDemo',
            'as'=>'admin.valueOption.updateMauNenContent'
        ]);

        Route::post('/update-maunen-content-demo', [
            'uses'=>'ValueOptionController@postUpdateMauContentDemo',
            'as'=>'admin.valueOption.updateMauNenContent'
        ]);

        Route::get('/update-maunen-content-real', [
            'uses'=>'ValueOptionController@updateMauNenContentReal',
            'as'=>'admin.valueOption.updateMauNenContentReal'
        ]);
        //END mau_nen_content

        //BEGIN Update_Crop_size
        Route::get('/update-crop-size', [
            'uses'=>'ValueOptionController@updateCropSize',
            'as'=>'admin.valueOption.updateCropSize'
        ]);
        
        Route::get('/update-crop-size-slide', [
            'uses'=>'ValueOptionController@getUpdateCropSizeSlide',
            'as'=>'admin.valueOption.updateCropSizeSlide'
        ]);

        Route::post('/update-crop-size-slide', [
            'uses'=>'ValueOptionController@postUpdateCropSizeSlide',
            'as'=>'admin.valueOption.updateCropSizeSlide'
        ]);

        Route::get('/update-crop-size-product', [
            'uses'=>'ValueOptionController@getUpdateCropSizeProduct',
            'as'=>'admin.valueOption.updateCropSizeProduct'
        ]);

        Route::post('/update-crop-size-product', [
            'uses'=>'ValueOptionController@postUpdateCropSizeProduct',
            'as'=>'admin.valueOption.updateCropSizeProduct'
        ]);

        Route::get('/update-crop-size-logo', [
            'uses'=>'ValueOptionController@getUpdateCropSizeLogo',
            'as'=>'admin.valueOption.updateCropSizeLogo'
        ]);

        Route::post('/update-crop-size-logo', [
            'uses'=>'ValueOptionController@postUpdateCropSizeLogo',
            'as'=>'admin.valueOption.updateCropSizeLogo'
        ]);
        
        //END Update_Crop_size
    });
});
