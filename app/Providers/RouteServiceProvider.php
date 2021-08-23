<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //Authentication
        $this->mapAuthenticationWebRoutes();

        //////// Super Admin Routes /////////

        //Super Admin Dashboard
        $this->mapSuperAdminDashboardWebRoutes();

        //Super Admin User
        $this->mapSuperAdminUserWebRoutes();

        //Super Admin Department
        $this->mapSuperAdminDepartmentWebRoutes();

        //Super Admin FAQ
        $this->mapSuperAdminFAQWebRoutes();

        //Super Admin Account
        $this->mapSuperAdminAccountWebRoutes();

        //Super Admin Profile
        $this->mapSuperAdminProfileWebRoutes();

        //Super Admin News
        $this->mapSuperAdminNewsWebRoutes();

        //Super Admin Contact
        $this->mapSuperAdminContactWebRoutes();

        //////// Admin Routes /////////

        //Admin Dashboard
        $this->mapAdminDashboardWebRoutes();

        //Admin Collection
        $this->mapAdminCollectionWebRoutes();

        //Admin Department
        $this->mapAdminDepartmentWebRoutes();

        //Admin Type
        $this->mapAdminTypeWebRoutes();

        //Admin Category
        $this->mapAdminCategoryWebRoutes();

        //Admin Product
        $this->mapAdminProductWebRoutes();

        //Admin Order
        $this->mapAdminOrderWebRoutes();

        //Admin Account
        $this->mapAdminAccountWebRoutes();

        //Admin Profile
        $this->mapAdminProfileWebRoutes();

        //Admin News
        $this->mapAdminNewsWebRoutes();

        //Admin Contact
        $this->mapAdminContactWebRoutes();

        //Admin FAQ
        $this->mapAdminFAQWebRoutes();

        //////// User Routes /////////

        //User Home
        $this->mapUserHomeWebRoutes();

        //User Shop
        $this->mapUserShopWebRoutes();

        //User Cart
        $this->mapUserCartWebRoutes();

        //User News
        $this->mapUserNewsWebRoutes();

        //User Contact
        $this->mapUserContactWebRoutes();

        //User Account
        $this->mapUserAccountWebRoutes();

        //User Profile
        $this->mapUserProfileWebRoutes();

        //User Order
        $this->mapUserOrderWebRoutes();

        //User FAQ
        $this->mapUserFAQWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * ---------------------------------------------------------------------------------------
     * Authentication web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapAuthenticationWebRoutes() {
        Route::prefix('/')
            ->middleware(['web'])
            ->namespace( 'App\Modules\Authentication\Controllers\Web')
            ->group(app_path('Modules/Authentication/Routes/Web/auth.php'));
    }

    /**
     * ---------------------------------------------------------- *
     * * * * * * * * * * * * Super Admin Routes * * * * * * * * * *
     * ---------------------------------------------------------- *
     */

    /**
     * ---------------------------------------------------------------------------------------
     * Super Admin Dashboard web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapSuperAdminDashboardWebRoutes() {
        Route::prefix('super-admin')
            ->middleware(['web', 'auth', 'verified', 'admin.super'])
            ->namespace( 'App\Modules\Dashboard\Controllers\Web\SuperAdmin')
            ->group(app_path('Modules/Dashboard/Routes/SuperAdmin/dashboard.php'));
    }

    /**
     * ---------------------------------------------------------------------------------------
     * Super Admin User web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapSuperAdminUserWebRoutes() {
        Route::prefix('super-admin')
            ->middleware(['web', 'auth', 'verified', 'admin.super'])
            ->namespace( 'App\Modules\User\Controllers\Web\SuperAdmin')
            ->group(app_path('Modules/User/Routes/SuperAdmin/user.php'));
    }

    /**
     * ---------------------------------------------------------------------------------------
     * Super Admin Department web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapSuperAdminDepartmentWebRoutes() {
        Route::prefix('super-admin')
            ->middleware(['web', 'auth', 'verified', 'admin.super'])
            ->namespace( 'App\Modules\Department\Controllers\Web\SuperAdmin')
            ->group(app_path('Modules/Department/Routes/SuperAdmin/department.php'));
    }

    /**
     * ---------------------------------------------------------------------------------------
     * Super Admin FAQ web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapSuperAdminFAQWebRoutes() {
        Route::prefix('super-admin')
            ->middleware(['web', 'auth', 'verified', 'admin.super'])
            ->namespace( 'App\Modules\FAQ\Controllers\Web\SuperAdmin')
            ->group(app_path('Modules/FAQ/Routes/SuperAdmin/faq.php'));
    }

    /**
     * ---------------------------------------------------------------------------------------
     * Super Admin Account web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapSuperAdminAccountWebRoutes() {
        Route::prefix('super-admin')
            ->middleware(['web', 'auth', 'verified', 'admin.super'])
            ->namespace( 'App\Modules\Account\Controllers\Web\SuperAdmin')
            ->group(app_path('Modules/Account/Routes/SuperAdmin/account.php'));
    }

    /**
     * ---------------------------------------------------------------------------------------
     * Super Admin Profile web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapSuperAdminProfileWebRoutes() {
        Route::prefix('super-admin')
            ->middleware(['web', 'auth', 'verified', 'admin.super'])
            ->namespace( 'App\Modules\Profile\Controllers\Web\SuperAdmin')
            ->group(app_path('Modules/Profile/Routes/SuperAdmin/profile.php'));
    }

    /**
     * ---------------------------------------------------------------------------------------
     * Super Admin News web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapSuperAdminNewsWebRoutes() {
        Route::prefix('super-admin')
            ->middleware(['web', 'auth', 'verified', 'admin.super'])
            ->namespace( 'App\Modules\News\Controllers\Web\SuperAdmin')
            ->group(app_path('Modules/News/Routes/SuperAdmin/news.php'));
    }

    /**
     * ---------------------------------------------------------------------------------------
     * Super Admin Contact web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapSuperAdminContactWebRoutes() {
        Route::prefix('super-admin')
            ->middleware(['web', 'auth', 'verified', 'admin.super'])
            ->namespace( 'App\Modules\Contact\Controllers\Web\SuperAdmin')
            ->group(app_path('Modules/Contact/Routes/SuperAdmin/contact.php'));
    }

    /**
     * ---------------------------------------------------------- *
     * * * * * * * * * * * * * Admin Routes * * * * * * * * * * * *
     * ---------------------------------------------------------- *
     */

    /**
     * ---------------------------------------------------------------------------------------
     * Admin Dashboard web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapAdminDashboardWebRoutes() {
        Route::prefix('admin')
            ->middleware(['web', 'auth', 'verified', 'admin'])
            ->namespace( 'App\Modules\Dashboard\Controllers\Web\Admin')
            ->group(app_path('Modules/Dashboard/Routes/Admin/dashboard.php'));
    }

    /**
     * ---------------------------------------------------------------------------------------
     * Admin Collection web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapAdminCollectionWebRoutes() {
        Route::prefix('admin')
            ->middleware(['web', 'auth', 'verified', 'admin'])
            ->namespace( 'App\Modules\Collection\Controllers\Web\Admin')
            ->group(app_path('Modules/Collection/Routes/Admin/collection.php'));
    }

    /**
     * ---------------------------------------------------------------------------------------
     * Admin Department web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapAdminDepartmentWebRoutes() {
        Route::prefix('admin')
            ->middleware(['web', 'auth', 'verified', 'admin'])
            ->namespace( 'App\Modules\Department\Controllers\Web\Admin')
            ->group(app_path('Modules/Department/Routes/Admin/department.php'));
    }

    /**
     * ---------------------------------------------------------------------------------------
     * Admin Type web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapAdminTypeWebRoutes() {
        Route::prefix('admin')
            ->middleware(['web', 'auth', 'verified', 'admin'])
            ->namespace( 'App\Modules\Type\Controllers\Web\Admin')
            ->group(app_path('Modules/Type/Routes/Admin/type.php'));
    }

    /**
     * ---------------------------------------------------------------------------------------
     * Admin Category web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapAdminCategoryWebRoutes() {
        Route::prefix('admin')
            ->middleware(['web', 'auth', 'verified', 'admin'])
            ->namespace( 'App\Modules\Category\Controllers\Web\Admin')
            ->group(app_path('Modules/Category/Routes/Admin/category.php'));
    }

    /**
     * ---------------------------------------------------------------------------------------
     * Admin Product web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapAdminProductWebRoutes() {
        Route::prefix('admin')
            ->middleware(['web', 'auth', 'verified', 'admin'])
            ->namespace( 'App\Modules\Product\Controllers\Web\Admin')
            ->group(app_path('Modules/Product/Routes/Admin/product.php'));
    }

    /**
     * ---------------------------------------------------------------------------------------
     * Admin Order web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapAdminOrderWebRoutes() {
        Route::prefix('admin')
            ->middleware(['web', 'auth', 'verified', 'admin'])
            ->namespace( 'App\Modules\Order\Controllers\Web\Admin')
            ->group(app_path('Modules/Order/Routes/Admin/order.php'));
    }

    /**
     * ---------------------------------------------------------------------------------------
     * Admin Account web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapAdminAccountWebRoutes() {
        Route::prefix('admin')
            ->middleware(['web', 'auth', 'verified', 'admin'])
            ->namespace( 'App\Modules\Account\Controllers\Web\Admin')
            ->group(app_path('Modules/Account/Routes/Admin/account.php'));
    }

    /**
     * ---------------------------------------------------------------------------------------
     * Admin Profile web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapAdminProfileWebRoutes() {
        Route::prefix('admin')
            ->middleware(['web', 'auth', 'verified', 'admin'])
            ->namespace( 'App\Modules\Profile\Controllers\Web\Admin')
            ->group(app_path('Modules/Profile/Routes/Admin/profile.php'));
    }

    /**
     * ---------------------------------------------------------------------------------------
     * Admin News web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapAdminNewsWebRoutes() {
        Route::prefix('admin')
            ->middleware(['web', 'auth', 'verified', 'admin'])
            ->namespace( 'App\Modules\News\Controllers\Web\Admin')
            ->group(app_path('Modules/News/Routes/Admin/news.php'));
    }

    /**
     * ---------------------------------------------------------------------------------------
     * Admin Contact web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapAdminContactWebRoutes() {
        Route::prefix('admin')
            ->middleware(['web', 'auth', 'verified', 'admin'])
            ->namespace( 'App\Modules\Contact\Controllers\Web\Admin')
            ->group(app_path('Modules/Contact/Routes/Admin/contact.php'));
    }

    /**
     * ---------------------------------------------------------------------------------------
     * Admin FAQ web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapAdminFAQWebRoutes() {
        Route::prefix('admin')
            ->middleware(['web', 'auth', 'verified', 'admin'])
            ->namespace( 'App\Modules\FAQ\Controllers\Web\Admin')
            ->group(app_path('Modules/FAQ/Routes/Admin/faq.php'));
    }

    /**
     * ---------------------------------------------------------- *
     * * * * * * * * * * * * * User  Routes * * * * * * * * * * * *
     * ---------------------------------------------------------- *
     */

    /**
     * ---------------------------------------------------------------------------------------
     * User Home web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapUserHomeWebRoutes() {
        Route::prefix('/')
            ->middleware(['web', 'auth', 'verified', 'user'])
            ->namespace( 'App\Modules\Home\Controllers\Web\User')
            ->group(app_path('Modules/Home/Routes/User/Web/home.php'));
    }

    /**
     * ---------------------------------------------------------------------------------------
     * User Shop web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapUserShopWebRoutes() {
        Route::prefix('/')
            ->middleware(['web', 'auth', 'verified', 'user'])
            ->namespace( 'App\Modules\Shop\Controllers\Web\User')
            ->group(app_path('Modules/Shop/Routes/User/Web/shop.php'));
    }

    /**
     * ---------------------------------------------------------------------------------------
     * User Cart web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapUserCartWebRoutes() {
        Route::prefix('/')
            ->middleware(['web', 'auth', 'verified', 'user'])
            ->namespace( 'App\Modules\Cart\Controllers\Web\User')
            ->group(app_path('Modules/Cart/Routes/User/Web/cart.php'));
    }

    /**
     * ---------------------------------------------------------------------------------------
     * User News web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapUserNewsWebRoutes() {
        Route::prefix('/')
            ->middleware(['web', 'auth', 'verified', 'user'])
            ->namespace( 'App\Modules\News\Controllers\Web\User')
            ->group(app_path('Modules/News/Routes/User/Web/news.php'));
    }

    /**
     * ---------------------------------------------------------------------------------------
     * User Contact web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapUserContactWebRoutes() {
        Route::prefix('/')
            ->middleware(['web', 'auth', 'verified', 'user'])
            ->namespace( 'App\Modules\Contact\Controllers\Web\User')
            ->group(app_path('Modules/Contact/Routes/User/Web/contact.php'));
    }

    /**
     * ---------------------------------------------------------------------------------------
     * User Account web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapUserAccountWebRoutes() {
        Route::prefix('/')
            ->middleware(['web', 'auth', 'verified', 'user'])
            ->namespace( 'App\Modules\Account\Controllers\Web\User')
            ->group(app_path('Modules/Account/Routes/User/Web/account.php'));
    }

    /**
     * ---------------------------------------------------------------------------------------
     * User Profile web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapUserProfileWebRoutes() {
        Route::prefix('/')
            ->middleware(['web', 'auth', 'verified', 'user'])
            ->namespace( 'App\Modules\Profile\Controllers\Web\User')
            ->group(app_path('Modules/Profile/Routes/User/Web/profile.php'));
    }

    /**
     * ---------------------------------------------------------------------------------------
     * User Order web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapUserOrderWebRoutes() {
        Route::prefix('/')
            ->middleware(['web', 'auth', 'verified', 'user'])
            ->namespace( 'App\Modules\Order\Controllers\Web\User')
            ->group(app_path('Modules/Order/Routes/User/Web/order.php'));
    }

    /**
     * ---------------------------------------------------------------------------------------
     * User FAQ web route for admin
     * ---------------------------------------------------------------------------------------
     */
    protected function mapUserFAQWebRoutes() {
        Route::prefix('/')
            ->middleware(['web', 'auth', 'verified', 'user'])
            ->namespace( 'App\Modules\FAQ\Controllers\Web\User')
            ->group(app_path('Modules/FAQ/Routes/User/Web/faq.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
