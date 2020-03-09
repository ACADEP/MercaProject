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

Route::get('/getBrands', 'ApiController@getBrands');

Route::get('/update/products', 'ApiController@updateProduct');


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

    Route::get('/about', 'PagesController@about');

    Route::get('/help', 'PagesController@help');

    /** Display Products by category Route **/
    Route::get('/Category/{category}','PagesController@displayProducts')->name('productsByCategory');

    Route::get('/Category/{category}/order','PagesController@orderCategories')->name('orderCategory');

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

    /** Display all Selled Products Route **/
    Route::get('/selled', [
        'uses' => '\App\Http\Controllers\PagesController@displayAllSelledProducts',
        'as'   => 'all.selled',
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
    Route::get('product/{product_id}', [
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
    Route::get('/category/{id}/filter', [
        'uses' => '\App\Http\Controllers\CategoriesController@filtros',
        'as'   => 'category.filter',
    ]);

    Route::get('/queries/filter', [
        'uses' => '\App\Http\Controllers\QueryController@filtros',
        'as'   => 'queries.filter',
    ]);

    /** Route to filter products for destacados */
    Route::get('/offers/filter', [
        'uses' => '\App\Http\Controllers\PagesController@filtrosOffer',
        'as'   => 'offer.filter',
    ]);

    /** Route to filter products for selled */
    Route::get('/selled/filter', [
        'uses' => '\App\Http\Controllers\PagesController@filtrosSelled',
        'as'   => 'selled.filter',
    ]);

    /** Route to order products for selled */
    Route::get('/selled/order', [
        'uses' => '\App\Http\Controllers\OrderByController@OrderSelledproducts',
        'as'   => 'selled.order',
    ]);    
        
    /** Route to filter products for news */
    Route::get('/new-products/filter', [
        'uses' => '\App\Http\Controllers\PagesController@filtrosNuevos',
        'as'   => 'new.filter',
    ]);

    /** Route to filter products for brans */
    Route::get('/bran/{id}/filter', [
        'uses' => '\App\Http\Controllers\BrandsController@filtros',
        'as'   => 'bran.filter',
    ]);

    /** Route to filter products for shops */
    Route::get('/shop/{id}/filter', [
        'uses' => '\App\Http\Controllers\ShopController@filtros',
        'as'   => 'shop.filter',
    ]);

    /** Route to filter products for Special Search */
    Route::get('/special/filter', [
        'uses' => '\App\Http\Controllers\SpecialSearchController@specialFilters',
        'as'   => 'special.filter',
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


    /************************************** Order By Routes for Products By Offer Products ***********************************/

    /** Route to sort products by price lowest */
    Route::get('/offers/price/lowest', [
        'uses' => '\App\Http\Controllers\OrderByController@PriceLowestOffers',
        'as'   => 'offers.lowest',
    ]);

    /**Route to sort products by price highest */
    Route::get('/offers/price/highest', [
        'uses' => '\App\Http\Controllers\OrderByController@PriceHighestOffers',
        'as'   => 'offers.highest',
    ]);


    /** Route to sort products by alphabetical A-Z */
    Route::get('/offers/alpha/highest', [
        'uses' => '\App\Http\Controllers\OrderByController@AlphaHighestOffers',
        'as'   => 'offers.alpha.highest',
    ]);

    /**Route to sort products by alphabetical  Z-A */
    Route::get('/offers/alpha/lowest', [
        'uses' => '\App\Http\Controllers\OrderByController@AlphaLowestOffers',
        'as'   => 'offers.alpha.lowest',
    ]);

    /**Route to sort products by alphabetical  Z-A */
    Route::get('/offers/newest', [
        'uses' => '\App\Http\Controllers\OrderByController@NewestOffers',
        'as'   => 'offers.newest',
    ]);

    
    /************************************** Order By Routes for Products By New Products ***********************************/

    /** Route to sort products by price lowest */
    Route::get('/new-products/price/lowest', [
        'uses' => '\App\Http\Controllers\OrderByController@PriceLowestNew',
        'as'   => 'new.lowest',
    ]);

    /**Route to sort products by price highest */
    Route::get('/new-products/price/highest', [
        'uses' => '\App\Http\Controllers\OrderByController@PriceHighestNew',
        'as'   => 'new.highest',
    ]);


    /** Route to sort products by alphabetical A-Z */
    Route::get('/new-products/alpha/highest', [
        'uses' => '\App\Http\Controllers\OrderByController@AlphaHighestNew',
        'as'   => 'new.alpha.highest',
    ]);

    /**Route to sort products by alphabetical  Z-A */
    Route::get('/new-products/alpha/lowest', [
        'uses' => '\App\Http\Controllers\OrderByController@AlphaLowestNew',
        'as'   => 'new.alpha.lowest',
    ]);

    /**Route to sort products by alphabetical  Z-A */
    Route::get('/new-products/newest', [
        'uses' => '\App\Http\Controllers\OrderByController@NewestNew',
        'as'   => 'new.newest',
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
    // Desargar rar o zip de la factura
    Route::post('/customer/invoice', 'CustomerController@Invoice');
    /* Mostrar progreso */
    Route::get('/progressConfirmation','CartController@progressConfirmation');
    /************************CRUD productos favoritos****************************/
    Route::get("/customer/favorites","CustomerController@favorites")->name("my-favorites");
    Route::post('/customer/addfavorite','CustomerController@addFavorite');
    Route::post('/customer/deletefavorite','CustomerController@deleteFavorite')->name("delete-favorite");

    /*********************** CRUD Personal Dates Profile ***********************/
    Route::get('/customer/personal/data', [
        'uses' => '\App\Http\Controllers\CustomerController@personal',
        'as'   => 'customer.personal',
    ]);

    Route::post('/customer/personal/data/add', [
        'uses' => '\App\Http\Controllers\CustomerController@addpersonal',
        'as'   => 'customer.personal.add',
    ]);

    Route::get('/customer/personal/data/update/{id}', [
        'uses' => '\App\Http\Controllers\CustomerController@showUpdate',
        'as'   => 'customer.personal.showUpdate',
    ]);

    Route::post('/customer/personal/data/update', [
        'uses' => '\App\Http\Controllers\CustomerController@personalUpdate',
        'as'   => 'customer.personal.update',
    ]);

    /*********************** CRUD Dates Profile ***********************/
    Route::get('/customer/personal/acount', [
        'uses' => '\App\Http\Controllers\CustomerController@profile',
        'as'   => 'customer.acount',
    ]);

    Route::post('/customer/personal/acount/update', [
        'uses' => '\App\Http\Controllers\CustomerController@profileUpdate',
        'as'   => 'customer.acount.update',
    ]);

    Route::post('/customer/personal/acount/', [
        'uses' => '\App\Http\Controllers\CustomerController@profileUpdatePassword',
        'as'   => 'customer.acount.update.password',
    ]);

    /*********************** CRUD Address Profile ***********************/
    Route::get('/customer/personal/address/', [
        'uses' => '\App\Http\Controllers\AddressController@address',
        'as'   => 'customer.address',
    ]);

    Route::post('/customer/personal/address', [
        'uses' => '\App\Http\Controllers\AddressController@activeAddress',
        'as'   => 'customer.address.activo',
    ]);

    Route::post('/customer/personal/address/add', [
        'uses' => '\App\Http\Controllers\AddressController@addAddress',
        'as'   => 'customer.address.add',
    ]);

    Route::get('/customer/personal/address/update/{id}', [
        'uses' => '\App\Http\Controllers\AddressController@Update',
        'as'   => 'customer.address.showUpdate',
    ]);

    Route::post('/updateAddressActive',"AddressController@updateAddressActive");

    // Route::get('/customer/address/showUpdate', [
    //     'uses' => '\App\Http\Controllers\AddressController@showUpdate',
    //     'as'   => 'customer.address.showUpdate',
    // ]);

    Route::post('/customer/personal/address/update', [
        'uses' => '\App\Http\Controllers\AddressController@updateAddress',
        'as'   => 'customer.address.update',
    ]);

    Route::post('/customer/personal/address/delete', [
        'uses' => '\App\Http\Controllers\AddressController@deleteAddress',
        'as'   => 'customer.address.delete',
    ]);


    /*********************** CRUD Payments Profile ***********************/
    Route::get('/customer/personal/payments', [
        'uses' => '\App\Http\Controllers\PaymentInformationController@payments',
        'as'   => 'customer.payments',
    ]);

    /** Payments add cards **/
    Route::post('/customer/personal/payments/add', [
        'uses' => '\App\Http\Controllers\PaymentInformationController@addCard',
        'as'   => 'customer.payments.add',
    ]);

    /** Payments deletecards **/
    Route::post('/customer/personal/payments/delete', [
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

    Route::get('/cart/payment/pruevaOxxo', [
        'uses' => '\App\Http\Controllers\CartController@pruevasRecibos',
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

    Route::get('/show-pdf-pay','CartController@showPDFOxxo');  

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

    

    //Order by histories
    Route::get('seller/sales/{order}','SellerController@orderSales')->name('order');

    Route::post('seller/sales/orderDate','SellerController@orderDate')->name('orderDate');

    Route::get('print_pdf_seller','SellerController@printPdf');

    Route::get('print_excel_seller','SellerController@printExcel');

   



    
    

    

    

   
 });
/************************************************************************************************** */


 /*******************************************Admin Profile Routes below ************************************************/

Route::group(["middleware" => 'admin'], function(){
    //Dashboard del administrador
    Route::get("admin/index", "AdminController@index");
    //Edicion de categorías
    Route::get("admin/products/categories/edit/{category}", "AdminController@showEdit")->name("show-edit-category");
    //Regalias
    Route::get("admin/sales", "AdminController@showSales")->name("show-sales");
    //Descargar PDF
    Route::get('print_pdf_seller','AdminController@printPdf');
    //Descargar Excel
    Route::get('print_excel_seller','AdminController@printExcel');
    //Ordenar por
    Route::get('admin/sales/{order}','AdminController@orderSales')->name('order-admin');
    //Ordenar por todos
    Route::get('admin/allSales/{order}','AdminController@orderAllSales')->name('order-all-admin');
     //Mostar ventas Propias/Todas
     Route::get('admin/showsales','AdminController@showSalesAll')->name('show-sales-all');
    //Ordenar por fecha
    Route::get('/admin/orderDate','AdminController@orderDate')->name('orderDate-admin');
    //Recibo de pago
   //Imprimir PDF
   Route::get('/print-pay-pdf/{id}', 'AdminController@salesPayPDF')->name('salesPdf');

    //reclamos
    Route::get('/admin/reclames','AdminController@showReclames')->name('my-reclames');
    //responder
    Route::post('/admin/respond-reclame','AdminController@respondReclame')->name('respond-reclame');

    //Ordenes por Oxxo
    //Mostrar disponibles
    Route::get("/admin/OrderOxxo/index", "AdminController@showOrderOxxo")->name("show-orderOxxo");
    //Acreditar pago
    Route::post("/admin/OrderOxxo/accreditedPay", "AdminController@accreditedPay")->name("accreditedPay");
    //Eliminar orden
    Route::post("/admin/OrderOxxo/deleteOrder", "AdminController@deleteOrder")->name("deleteOrder");
     //Eliminar orden
     Route::post("/admin/OrderOxxo/storeReceipt", "AdminController@storeReceipt")->name("storeReceipt");

    //Facturas
    //Subir factura
    Route::post("/admin/sales/addInvoice", "AdminController@storeInvoice")->name("add-invoice");
    //Quitar factura
    Route::post("/admin/sales/deleteInvoice", "AdminController@deleteInvoice")->name("delete-invoice");  

    //Buscar ordenes
    Route::get("admin/OrderOxxo/search", "AdminController@searchOrderOxxo")->name("search-orderOxxo");
   
    //CRUD Marcas
    //Mostrar disponibles
    Route::get("admin/brands/index", "BrandsController@showBrands")->name("show-brands");
    //Agregar marca
    Route::post("admin/brands/add-brand", "BrandsController@addBrand")->name("add-brands");
    //Eliminar marca
    Route::post("admin/brands/delete-brand", "BrandsController@deleteBrand")->name("delete-brands");
     //Mostrar la edicion de marca
     Route::get("admin/brands/showEdit/{brand}", "BrandsController@showEdit")->name("showEdit-brands");
     //Editar una marca
     Route::post("admin/brands/edit", "BrandsController@edit")->name("edit-brands");

    //CRUD Categorias
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

    //CRUD productos
    Route::get("/admin/products/products/showProducts", "ProductsController@showProducts")->name("show-products");
    //Agregar productos
    Route::post('/admin/products/products/add','ProductsController@addProduct')->name('add-Product');
    //Mostrar edición
    Route::get('/admin/products/products/edit/{product}','ProductsController@showEdit')->name('show-edit');
    //Agregar fotos
    Route::post('/admin/products/products/addphoto','ProductPhotosController@store')->name('add-Photo');
    //eliminar foto
    Route::delete('/deletephoto/{id}','ProductPhotosController@delete')->name('delete-Photo');
    //Eliminar producto
    Route::post('/admin/products/products/delete','ProductsController@deleteProduct')->name('delete-Product');
    //Actualizar producto
    Route::post('/admin/products/products/update','ProductsController@updateProduct')->name('update-Product');
    
    //Cotizaciones
    Route::get("/admin/market_rates", "MarketRatesController@market_rates")->name("show-marketRates");
    //Levantar un pedido por cotización
    Route::post("/admin/market_rates/addOrder", "MarketRatesController@addOrder")->name("addOrder");
    //Buscar cotizaciones
    Route::get("/admin/market_rates/searchMarketRates", "MarketRatesController@searchMarketRates")->name("searchMarketRates");
    //Editar y crear Cotizaciones
    Route::get("/admin/market_rates/create", "MarketRatesController@showCreate")->name("create-marketRates");

    Route::get("/admin/market_rates/edit/{marketrate}", "MarketRatesController@showEdit")->name("edit-marketRates");

    Route::post("/admin/market_rates/createMarketRate", "MarketRatesController@createMarket_rates")->name("create-marketRate");
    //Actualizar cotizacion
    Route::post("/admin/market_rates/updateMarketRate", "MarketRatesController@updateMarket_rates")->name("update-marketRate");
    //Eliminar producto de cotizacion en editar
    Route::post("/admin/market_rates/deleteProductEdit", "MarketRatesController@deleteProductMarket_ratesEdit")->name("delete-ProductMarketRatesEdit");
    //Eliminar producto de cortizacion en crear
    Route::post("/admin/market_rates/deleteMarket_rates", "MarketRatesController@deleteMarket_rates")->name("delete-MarketRates");
    //Enviar cotizacion
    Route::get("/admin/market_rates/send/{marketrate}", "MarketRatesController@sendMarketRate")->name("Send-MarketRate");
    //Enviar cotizacion en crear
    Route::post("/admin/market_rates/sendEmail", "MarketRatesController@sendEmailMarketRate")->name("sendEmail-MarketRate");
     //Enviar cotizacion
     Route::get("/admin/market_rates/showPDF", "MarketRatesController@showPDFPay")->name("pdf-pay");

    //Buscar productos en crear
    Route::get("/admin/market_rates/search", "MarketRatesController@searchMarket_rates")->name("search-marketRates");
     //Buscar productos en editar
     Route::get("/admin/market_rates/searchEdit", "MarketRatesController@searchMarket_ratesedit")->name("searchedit-marketRates");
    //Agregar productos 
    Route::post("/admin/market_rates/addProduct", "MarketRatesController@addMarket_rates")->name("add-marketRates");
    //Agregar productos 
    Route::post("/admin/market_rates/addNewProduct", "MarketRatesController@addNewMarket_rates")->name("add-newmarketRates");
    //Agregar productos en editar
    Route::post("/admin/market_rates/addProductEdit", "MarketRatesController@addMarket_ratesEdit")->name("add-marketRatesEdit");
    //Eliminar producto de cortizacion
    Route::post("/admin/market_rates/deleteProduct", "MarketRatesController@deleteProductMarket_rates")->name("delete-ProductMarketRates");
    //Imprimir PDF
    Route::get('/print-market_rate/{marketrate}', 'MarketRatesController@PDF')->name('marketRatesPdf');

    //CRUD Usuarios
    //Mostrar todas las categorias
    Route::get("/admin/users/users", "AdminController@showUsers")->name("show-users");
    //Eliminar usuario
    Route::post("/admin/users/deleteUser","AdminController@deleteUser")->name("delete-User");
    //Agregar usuario
    Route::post("/admin/users/addUser","AdminController@addUser")->name("add-User");
    //Mostar edicion
    Route::get("/admin/users/updateUser/{user}","AdminController@showUpdateUser")->name("show-update");
    //Editar usuario
    Route::post("/admin/users/updateUser","AdminController@updateUser")->name("update-User");
    //Mostrar todas los roles
    Route::get("/admin/users/RolesPermissions", "AdminController@showRolesAPermissions")->name("show-rolespermissions");
    //Mostrar todas los permisos
    Route::get("/admin/users/RolesPermissions/showPermissions", "AdminController@showPermissions")->name("show-permissions");
    //Editar permisos
    Route::get("/admin/users/RolesPermissions/editPermission/{permission}", "AdminController@showEditPermissions")->name("show-editpermission");
    Route::post("/admin/users/RolesPermissions/updatePermission", "AdminController@updatePermission")->name("update-permission");
     //Editar roles
     Route::get("/admin/users/RolesPermissions/editRole/{role}", "AdminController@showEditRoles")->name("show-editRole");
     Route::post("/admin/users/RolesPermissions/update", "AdminController@updateRole")->name("update-role");
     //Eliminar role
     Route::post("/admin/users/RolesPermissions/delete", "AdminController@deleteRole")->name("delete-role");
     //Agregar role
     Route::post("/admin/users/RolesPermissions/addRole", "AdminController@addRole")->name("add-role");
    //Editar roles a usuarios
    Route::middleware('role:Admin')
        ->post("/admin/users/updateUser/{user}/updateRole","AdminController@updateRoleUser")->name("update-RoleUser");
    //Editar permisos a usuarios
     Route::middleware('role:Admin')
        ->post("/admin/users/updateUser/{user}/updatePermission","AdminController@updatePermissionUser")->name("update-Permission");

    //Configuraciones
    //Mostrar panel
    Route::get("/admin/config/index", "ConfigController@index")->name("show-config");
    //Guradas cambios
    Route::post("/admin/config/update", "ConfigController@update")->name("update-config");


});
