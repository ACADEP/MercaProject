<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

//precio bajo
Route::post('/priceLow', 'testController@order');
Route::post('/webhook', 'CartController@notify');
/** Route to get typehead results **/
Route::get('/getData', [
    'uses' => 'QueryController@data',
    'as'   => 'data.json',
]);

Route::post('/notificaciones/openpay/create', [
    'uses' => '\App\Http\Controllers\CartController@OpnepayWebhookCreate',
    'as'   => 'openpay.notificacions.create',
]); 


Route::post('/notificaciones/openpay', 'CartController@OpnepayWebhookCatch');

Route::group(['middleware' => ['web']], function () {

    /** Get the Home Page **/
    Route::get('/', 'PagesController@index');

    /** Display Products by category Route **/
    Route::get('category/{id}','PagesController@displayProducts');

    /** Display all category Route **/
    Route::get('allcategory','PagesController@displayAllCategories')->name('categories.all');

    /** Display Products by Brand Route **/
    // Route::get('/brand/{id}','PagesController@displayProductsByBrand');
    Route::get('/brand/{id}', [
        'uses' => '\App\Http\Controllers\PagesController@displayProductsByBrand',
        'as'   => 'brand',
    ]);

    /** Display all products by shop Route **/
    // Route::get('shop/{id}','ShopController@showproducts');
    Route::get('/shop/{id}', [
        'uses' => '\App\Http\Controllers\ShopController@showproducts',
        'as'   => 'shop',
    ]);

    /** Display all Brands Route **/
    Route::get('/brands', [
        'uses' => '\App\Http\Controllers\PagesController@displayAllBrands',
        'as'   => 'all.brands',
    ]);

    /** Display all Shops Route **/
    Route::get('/shops', [
        'uses' => '\App\Http\Controllers\PagesController@displayAllShops',
        'as'   => 'all.shops',
    ]);

    /** Display all New Products Route **/
    Route::get('/new-products', [
        'uses' => '\App\Http\Controllers\PagesController@displayAllNewProducts',
        'as'   => 'all.new-products',
    ]);

    /** Display all Offer Products Route **/
    Route::get('/offers', [
        'uses' => '\App\Http\Controllers\PagesController@displayAllOffersProducts',
        'as'   => 'all.offers',
    ]);

    /** Route to post search results **/
    Route::get('/queries', [
        'uses' => 'QueryController@search',
        'as'   => 'queries.search',
    ]);

    /** Breadcrum Products Route **/
    // Route::get('/bread', [
    //     'uses' => '\App\Http\Controllers\PagesController@displayAllOffersProducts',
    //     'as'   => 'all.offers',
    // ]);
    
    

    /** Route to Products show page **/
    Route::get('product/{product_name}', [
        'uses' => '\App\Http\Controllers\ProductsController@show',
        'as'   => 'show.product',
    ]);

    Route::get('qr-code','ProductsController@qr_code')->name('QRCode');


    /************************************** Order By Routes for Products By Shop ***********************************/

    /** Route to sort products by price lowest */
    Route::get('shop/{id}/price/lowest', [
        'uses' => '\App\Http\Controllers\testController@orderlow',
        'as'   => 'shop.lowest',
    ]);

    /** Route to sort products by price highest */
    Route::get('shop/{id}/price/highest', [
        'uses' => '\App\Http\Controllers\testController@orderhigh',
        'as'   => 'shop.highest',
    ]);

    /** Route to sort products by price newest */
    Route::get('shop/{id}/newest', [
        'uses' => '\App\Http\Controllers\testController@ordernewst',
        'as'   => 'shop.newest',
    ]);

    /** Route to sort products by alpha highest */
    Route::get('shop/{id}/alpha/highest', [
        'uses' => '\App\Http\Controllers\testController@orderza',
        'as'   => 'shop.alpha.highest',
    ]);

    /** Route to sort products by alpha highest */
    Route::get('/shop/{id}/alpha/lowest', [
        'uses' => '\App\Http\Controllers\testController@orderaz',
        'as'   => 'shop.alpha.lowest',
    ]);




    /************************************** Order By Routes for Products By Brand, Category and Range Price *****************************/
    
    /** Route to filter products for categories */
    Route::post('category/filter', [
        'uses' => '\App\Http\Controllers\QueryController@filter',
        'as'   => 'filter',
    ]);

    /** Route to filter products for destacados */
    Route::post('offers/filter', [
        'uses' => '\App\Http\Controllers\QueryController@filter',
        'as'   => 'filter',
    ]);

    /** Route to filter products for news */
    Route::post('new-products/filter', [
        'uses' => '\App\Http\Controllers\QueryController@filter',
        'as'   => 'filter',
    ]);

    /** Route to filter products for brans */
    Route::get('bran/{id}/filter', [
        'uses' => '\App\Http\Controllers\QueryController@filter',
        'as'   => 'bran.filter',
    ]);

        /** Route to filter products for shops */
    Route::get('/shop/{id}/filter', [
        'uses' => '\App\Http\Controllers\ShopController@filter',
        'as'   => 'shop.filter',
    ]);





    /************************************** Order By Routes for Products By Category ***********************************/

    /** Route to sort products by price lowest */
    Route::get('category/{id}/price/lowest', [
        'uses' => '\App\Http\Controllers\OrderByController@productsPriceLowest',
        'as'   => 'category.lowest',
    ]);

    /**Route to sort products by price highest */
    Route::get('category/{id}/price/highest', [
        'uses' => '\App\Http\Controllers\OrderByController@productsPriceHighest',
        'as'   => 'category.highest',
    ]);


    /** Route to sort products by alphabetical A-Z */
    Route::get('category/{id}/alpha/highest', [
        'uses' => '\App\Http\Controllers\OrderByController@productsAlphaHighest',
        'as'   => 'category.alpha.highest',
    ]);

    /**Route to sort products by alphabetical  Z-A */
    Route::get('category/{id}/alpha/lowest', [
        'uses' => '\App\Http\Controllers\OrderByController@productsAlphaLowest',
        'as'   => 'category.alpha.lowest',
    ]);

    /**Route to sort products by alphabetical  Z-A */
    Route::get('category/{id}/newest', [
        'uses' => '\App\Http\Controllers\OrderByController@productsNewest',
        'as'   => 'category.newest',
    ]);


    /************************************** Order By Routes for Products By Brand ***********************************/

    /** Route to sort products by price lowest */
    Route::get('brand/{id}/price/lowest', [
        'uses' => '\App\Http\Controllers\OrderByController@productsPriceLowestBrand',
        'as'   => 'brand.lowest',
    ]);

    /**Route to sort products by price highest */
    Route::get('brand/{id}/price/highest', [
        'uses' => '\App\Http\Controllers\OrderByController@productsPriceHighestBrand',
        'as'   => 'brand.highest',
    ]);


    /** Route to sort products by alphabetical A-Z */
    Route::get('brand/{id}/alpha/highest', [
        'uses' => '\App\Http\Controllers\OrderByController@productsAlphaHighestBrand',
        'as'   => 'brand.alpha.highest',
    ]);

    /**Route to sort products by alphabetical  Z-A */
    Route::get('brand/{id}/alpha/lowest', [
        'uses' => '\App\Http\Controllers\OrderByController@productsAlphaLowestBrand',
        'as'   => 'brand.alpha.lowest',
    ]);

    /**Route to sort products by alphabetical  Z-A */
    Route::get('brand/{id}/newest', [
        'uses' => '\App\Http\Controllers\OrderByController@productsNewestBrand',
        'as'   => 'brand.newest',
    ]);


    /**************************************** Login & Registration Routes *********************************************/

    /** Return view for registration confirm token page ***/
    Route::get('register/confirm/{token}', 'AuthController@confirmEmail');

    Route::get('/register', [
        'uses' => '\App\Http\Controllers\AuthController@getRegister',
        'as'   => 'auth.register',
        'middleware' => ['guest']
    ]);

    Route::post('/register', [
        'uses' => '\App\Http\Controllers\AuthController@postRegister',
        'as'   => 'auth.register',
    ]);

    Route::get('/login', [
        'uses' => '\App\Http\Controllers\AuthController@getLogin',
        'as'   => 'auth.login',
        'middleware' => ['guest']
    ]);

    Route::post('/login', [
        'uses' => '\App\Http\Controllers\AuthController@postLogin',
        'as'   => 'auth.login',
        'middleware' => ['guest'],
    ]);

    Route::get('/logout', [
        'uses' => '\App\Http\Controllers\AuthController@logout',
        'as'   => 'auth.logout'
    ]);

    /**************************
     * Password Reset Routes
     *************************/
    Route::get('/password/email', '\App\Http\Controllers\PasswordController@getEmail');
    Route::post('/password/email', '\App\Http\Controllers\PasswordController@postEmail');
    Route::get('/password/reset/{token}', '\App\Http\Controllers\PasswordController@getReset');
    Route::post('/password/reset', '\App\Http\Controllers\PasswordController@postReset');

    
    /**************************************** Cart Routes *********************************************/
    
    
    /** Get the view for Cart Page **/
    Route::get('/cart', array(
        'before' => 'auth.basic',
        'as'     => 'cart',
        'uses'   => 'CartController@showCart'
    ));

    Route::get('/recibe','CartController@showRecibe');
    
    Route::post('/sendReceiptPayment','CartController@sendReceipt')->name("ReceiptPayment");
    /* Vista de pagar carrito */
    Route::get('/cart-pay','CartController@payCart')->name("pay-cart");
    /** Agregar productos al carrito **/
    Route::post('/cart/add', 'CartController@addCart')->name('addCart');

    /** Update items in the cart **/
    Route::post('/cart/update', [
        'uses' => 'CartController@update'
    ]);

    Route::post('/cart/qty','CartController@changeqty');

    Route::get('print', 'CartController@vista');

    Route::get('print-cart', 'CartController@PDF')->name('cart.pdf');

    /** Eliminar productos del carrito **/
    Route::post('/cart/delete','CartController@delete')->name('deleteCart');


    /**************************************** Order Routes *********************************************/


    /** Get thew checkout view **/
    Route::get('/checkout', [
        'uses' => '\App\Http\Controllers\OrderController@index',
        'as'   => 'checkout',
        'middleware' => ['auth'],
    ]);


    /** Post an Order **/
    Route::post('/order',
        array(
            'before' => 'auth.basic',
            'as'     => 'order',
            'uses'   => 'OrderController@postOrder'
        ));


    /******************************************* User Profile Routes below ************************************************/


    /** Resource route for Profile **/
    //Route::resource('profile', 'ProfileController');
    
});


/******************************************* Customer Profile Routes below ************************************************/

Route::group(["middleware" => 'customer'], function(){
    /** Resource route for Profile **/
    Route::get('/customer/profile', 'CustomerController@index');
    /* Funciones de la paquetería */
    Route::post('/customer/tracking', 'CustomerController@tracking');
    Route::get('/customer/tracking', 'CustomerController@tracking');
    Route::post('/customer/status','CustomerController@getStatus');
    /* Recibo pdf */
    Route::post('/customer/pdf', 'CustomerController@PDF');
    /* Mostrar progreso */
    Route::get('/progressConfirmation','CartController@progressConfirmation');
    /************************CRUD productos favoritos****************************/
    Route::get("/customer/favorites","CustomerController@favorites")->name("my-favorites");
    Route::post('/customer/addfavorite','CustomerController@addFavorite');
    Route::post('/customer/deletefavorite','CustomerController@deleteFavorite')->name("delete-favorite");

    /*********************** CRUD Personal Dates Profile ***********************/
    Route::get('/customer/personal', [
        'uses' => '\App\Http\Controllers\CustomerController@personal',
        'as'   => 'customer.personal',
    ]);

    Route::post('/customer/personal/add', [
        'uses' => '\App\Http\Controllers\CustomerController@addpersonal',
        'as'   => 'customer.personal.add',
    ]);

    Route::get('/customer/personal/update/{id}', [
        'uses' => '\App\Http\Controllers\CustomerController@showUpdate',
        'as'   => 'customer.personal.showUpdate',
    ]);

    Route::post('/customer/personal/update', [
        'uses' => '\App\Http\Controllers\CustomerController@personalUpdate',
        'as'   => 'customer.personal.update',
    ]);

    /*********************** CRUD Dates Profile ***********************/
    Route::get('/customer/profiledates', [
        'uses' => '\App\Http\Controllers\CustomerController@profile',
        'as'   => 'customer.profiledates',
    ]);

    /*********************** CRUD Address Profile ***********************/
    Route::get('/customer/address', [
        'uses' => '\App\Http\Controllers\AddressController@address',
        'as'   => 'customer.address',
    ]);

    Route::post('/customer/address', [
        'uses' => '\App\Http\Controllers\AddressController@activeAddress',
        'as'   => 'customer.address.activo',
    ]);

    Route::post('/customer/address/add', [
        'uses' => '\App\Http\Controllers\AddressController@addAddress',
        'as'   => 'customer.address.add',
    ]);

    Route::get('/customer/address/update/{id}', [
        'uses' => '\App\Http\Controllers\AddressController@Update',
        'as'   => 'customer.address.showUpdate',
    ]);

    Route::post('/updateAddressActive',"AddressController@updateAddressActive");

    // Route::get('/customer/address/showUpdate', [
    //     'uses' => '\App\Http\Controllers\AddressController@showUpdate',
    //     'as'   => 'customer.address.showUpdate',
    // ]);

    Route::post('/customer/address/update', [
        'uses' => '\App\Http\Controllers\AddressController@updateAddress',
        'as'   => 'customer.address.update',
    ]);

    Route::post('/customer/address/delete', [
        'uses' => '\App\Http\Controllers\AddressController@deleteAddress',
        'as'   => 'customer.address.delete',
    ]);


    /*********************** CRUD Payments Profile ***********************/
    Route::get('/customer/payments', [
        'uses' => '\App\Http\Controllers\PaymentInformationController@payments',
        'as'   => 'customer.payments',
    ]);

    /** Payments add cards **/
    Route::post('/customer/payments/add', [
        'uses' => '\App\Http\Controllers\PaymentInformationController@addCard',
        'as'   => 'customer.payments.add',
    ]);

    /** Payments deletecards **/
    Route::post('/customer/payments/delete', [
        'uses' => '\App\Http\Controllers\PaymentInformationController@deleteCard',
        'as'   => 'customer.payments.delete',
    ]);

    /** Add client with Openpay **/
    Route::post('/save_customer_card', [
        'uses' => '\App\Http\Controllers\PaymentInformationController@AddCardOpenpay',
        'as'   => 'add.card.openpay',
    ]);

    // Route::post('/deletecards','PaymentInformationController@deleteCard')->name('delete-Cards');
    
    




    /*************************************************** payment items in the cart ***************************************************/
    Route::get('/cart/payment', [
        'uses' => '\App\Http\Controllers\CartController@showPaymentCardCredit',
        'as'   => 'cart.payment',
    ]);

    Route::post('/cart/payment', [
        'uses' => '\App\Http\Controllers\CartController@showPaymentCardCredit',
        'as'   => 'cart.payment',
    ]);

    /** payment items confirmation in the cart with Stripe **/
    Route::post('/cart/confirmation', [
        'uses' => '\App\Http\Controllers\CartController@confirmation',
        'as'   => 'cart.confirmation',
    ]);

    Route::get('/cart/confirmation', [
        'uses' => '\App\Http\Controllers\CartController@confirmation',
        'as'   => 'cart.confirmation',
    ]);

    // Route::post('/cart/confirmation', [
    //     'uses' => '\App\Http\Controllers\CartController@paypal',
    //     'as'   => 'cart.confirmation.paypal',
    // ]);

    /** payment items confirmation in the cart with Openpay Banco **/
    Route::post('/cart/confirmation-banco', [
        'uses' => '\App\Http\Controllers\CartController@PagosBanco',
        'as'   => 'openpay.banco',
    ]);

    /** payment items confirmation in the cart with Openpay Tiendas **/
    Route::post('/cart/confirmation-store', [
        'uses' => '\App\Http\Controllers\CartController@PagosStore',
        'as'   => 'openpay.store',
    ]);    

    /** payment items confirmation in the cart with Oxxo o Bancomer **/
    Route::post('/cart/confirmation-oxxo', [
        'uses' => '\App\Http\Controllers\CartController@PagosOxxo',
        'as'   => 'openpay.oxxo',
    ]);    

    Route::post('/notificacions/paypal', [
        'uses' => '\App\Http\Controllers\CartController@PaypalWebhook',
        'as'   => 'paypal.notificacions',
    ]);    

    Route::post('/cart/payment/openpay', [
        'uses' => '\App\Http\Controllers\CartController@CardOpenpay',
        'as'   => 'cart.payment.openpay',
    ]);

        
    Route::get('customer/profile/myshopping','CustomerHistoryController@show')->name('my-shopping');

    Route::post('customer/profile/reclame','CustomerHistoryController@reclame')->name('make-reclame');

    Route::post('/addphotoreclame','CustomerHistoryController@store')->name('add-Photo-reclame');

});






/*********************************************Shipmeents GoShoppo**********************************/
    Route::get('/testShipment',"ShipmentController@test");

 /*******************************************Seller Profile Routes below ************************************************/
 Route::group(["middleware" => 'seller'], function(){
    Route::get('seller/admin','SellerController@show')->name('dash-seller');

    Route::get('seller/products','SellerController@showProducts')->name('my-products');

    Route::get('seller/update/{product}','SellerController@showUpdate')->name('my-update');

    Route::get('seller/sales','SellerController@showSales')->name('my-sales');

    Route::get('seller/reclames','SellerController@showReclames')->name('my-reclames');

    //Order by histories
    Route::get('seller/sales/{order}','SellerController@orderSales')->name('order');

    Route::post('seller/sales/orderDate','SellerController@orderDate')->name('orderDate');

    Route::get('print_pdf_seller','SellerController@printPdf');

    Route::post('seller/respond-reclame','SellerController@respondReclame')->name('respond-reclame');



    //CRUD PRODUCTOS
    Route::post('seller/products/add','SellerController@addProduct')->name('add-Product');

    Route::post('seller/products/update','SellerController@updateProduct')->name('update-Product');

    Route::delete('/delete','SellerController@deleteProduct')->name('delete-Product');

    Route::post('/addphoto','ProductPhotosController@store')->name('add-Photo');

    Route::delete('/deletephoto/{id}','ProductPhotosController@delete')->name('delete-Photo');

   
 });
/************************************************************************************************** */


 /*******************************************Admin Profile Routes below ************************************************/

Route::group(["middleware" => 'admin'], function(){
    //Dashboard del administrador
    Route::get("/admin/index", "AdminController@index");
    //Edicion de categorías
    Route::get("/admin/products/categories/edit/{category}", "AdminController@showEdit")->name("show-edit");
   
    //CRUDS Categorias
    //Mostrar todas las categorias
    Route::get("/admin/products/categories", "AdminController@showCategories");
    //Agregar subcategorias
    Route::post("/admin/products/categories/add-subC", "AdminController@addSubcategories")->name("add-subcategories");
    //Eliminar subcategorias
    Route::post("/admin/products/categories/delete-subC", "AdminController@deleteSubcategories")->name("delete-subcategories");
    //Agregar categorias con sus subcategorias
    Route::post("/admin/products/addCategory","AdminController@addCategory")->name("add-category");
    //Editar las categorías
    Route::post("/admin/products/editCategory","AdminController@editCategory")->name("edit-category");
     //Eliminar categoría
     Route::post("/admin/products/deleteCategory","AdminController@deleteCategory")->name("delete-category");
    
   

});
