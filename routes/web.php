<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SeriviceController;
use App\Jobs\sendEmailJob;
use App\Mail\sendEmailMailable;
use App\Models\User;
use App\Services\Postcard;
use App\Services\PostCardSendingService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Queue\Queue;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Str;

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


//service container example

//class Stadium
//{
//}
//
//;
//
//class Football
//{
//    /**
//     * @var Stadium
//     */
//    private $stadium;
//
//    public function __construct(Stadium $stadium)
//    {
//        $this->stadium = $stadium;
//    }
//}
//
//;
//
//class Game
//{
//
//
//    private $football;
//
//    public function __construct(Football $football)
//    {
//        $this->football = $football;
//    }
//
//}
//
////bonding
//
////app()->bind('Game', function () {
////    return new Game(new Football(new Stadium()));
////});
//
//
////instance
//
//app()->instance('Game', function () {
//    return 'instance';
//});
//dd(app());
////dd(app()->make('Game'));
//dd(resolve('Game'));
//
//Route::get('/', function () {
//    return view('welcome');
//});


//app()->bind('random', function ($hello) {
//    return $hello;
//});

//singleton is running the function one time and storing the value

//app()->singleton('random', function () {
//    return \Illuminate\Support\Str::random();
//});
//
//print_r(app()->makeWith('random', ['hello' => 6]));
//dd(app()->make('random'));

//end service container example


//start facades example bitfumes

//cache()->set('name','jubayer');
//
//dd(cache()->get('name'));

//cache::set('name','jubayer');
//dd(cache::get('name'));

//
//class Fish
//{
//    public function swim()
//    {
//        return 'swimming';
//    }
//
//    public function eat()
//    {
//        return 'eating';
//    }
//}
//
//class Bike
//{
//    public function start()
//    {
//        return 'starting';
//    }
//}
//
//app()->bind('fish', function () {
//    return new Fish();
//});
//
//app()->bind('bike', function () {
//    return new Bike();
//});
//
//class Facade
//{
//
//
//    public static function __callStatic($name, $arguments)
//    {
//        return app()->make(static::getFacadeAccessor())->$name();
//    }
//
//    protected static function getFacadeAccessor()
//    {
//
//    }
//}
//
//class FishFacade extends Facade
//{
//
//    protected static function getFacadeAccessor(): string
//    {
//        return 'fish';
//    }
//}
//
//class BikeFacade extends Facade
//{
//
//    protected static function getFacadeAccessor(): string
//    {
//        return 'bike';
//    }
//}
//
//dd(BikeFacade::start());

//end facades example bitfumes

//start faceds example coder xample


class container
{
    protected $bindings = [];

    public function bind($name, callable $resolver)
    {
        $this->bindings[$name] = $resolver;
    }

    public function make($name)
    {
        return $this->bindings[$name]();
    }


}

$container = new container();
$container->bind('Game', function () {
    return 'Football';
});

print_r($container->make('Game'));

Route::get('/postcards', function () {

    $postCardService = new PostCardSendingService('us', 4, 6);

    $postCardService->hello('hello everyone', 'ahmedjubayer54@gmail.com');
});


Route::get('/facades', function () {
    Postcard::hello('123', 'sbc@gmail.com');
});
//end facades exmple


//start macro example

//dd(Str::partNumber('dfasfdsafsadf'));
//dd(Str::prefix('jahsgdjha', 'jubayer'));

//dd(\Illuminate\Support\Facades\Response::errorJson('SOME ERROR'));


//end macro example

//pipeline start
Route::get('/posts', [\App\Http\Controllers\PostController::class, 'index']);
//pipeline end


//Repository start

Route::get('/repository/index', [\App\Http\Controllers\todoListController::class, 'repositoryIndex']);

Route::get('/repository/show/{id}', [\App\Http\Controllers\todoListController::class, 'repositoryShow']);

Route::get('/repository/show/{id}/update', [\App\Http\Controllers\todoListController::class, 'repositoryUpdate']);
Route::get('/repository/delete/{id}', [\App\Http\Controllers\todoListController::class, 'repositoryDelete']);


//repository end

//soft delete start

Route::get('softDelete/posts/index', [\App\Http\Controllers\PostController::class, 'softDeleteIndex']);

//soft delete end


//gate & and policy start

Route::get('/subs', function () {

    if (Gate::allows('mature-only', Auth::user())) {
        return view('subs');
    }
    return 'you are under age';
});

Route::get('customers', [\App\Http\Controllers\CustomerController::class, 'index'])->name('customers.index');
Route::get('customers/create', 'CustomerController@create')->name('customers.create');
Route::post('customers', 'CustomerController@store')->name('customers.store');
Route::get('customers/{customer}', 'CustomerController@show')->name('customer.show')->middleware('can:view,customer');
Route::get('customers/{customer}/edit', 'CustomerController@edit')->name('customers.edit');
Route::patch('customers/{customer}', 'CustomerController@update')->name('customers.update');
Route::delete('customers/{customer}', 'CustomerController@destroy')->name('customers.destroy');


//gate & and policy end


//localization start

Route::get('/localization/{lang?}', [PostController::class, 'localization']);


//localization end


//queue start

Route::get('sendEmail', function () {
//    \Illuminate\Support\Facades\Mail::to('ahmedjubayer54@gmail.com')->send( new SendEmailMailable());

    //dispatch(new sendEmailJob());

    sendEmailJob::dispatch()
        ->delay(now()->addSecond(5));
    return "email is send properly";
});


//queue end


//event start

Route::get('event', function () {

    event(new \App\Events\TaskEvent('hey everyone'));
});


//event end
//broadcast start
Route::get('/listen', function () {
    return view('listenBroadcast');
}
);

//broadcast end


Route::get('/about', function () {
    return 'About';
});

Route::resource('/beverage', '\App\Http\Controllers\beverageController');

Route::post('/beverage/buy', '\App\Http\Controllers\purchaseController@buy');

Route::get('/drive', function () {
    $client = new \Google\Client();
    $client->setClientId('703808494011-1olihj54jkheh53v5mh1a70jb94j55uv.apps.googleusercontent.com');
    $client->setClientSecret('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');
    $client->setRedirectUri('http://127.0.0.1:8000/google-drive/callback');
    $client->setScopes([
        'https://www.googleapis.com/auth/drive',
        'https://www.googleapis.com/auth/drive.file'
    ]);

    $url = $client->createAuthUrl();
    return redirect($url);

});

Route::get('/google-drive/callback', function () {
    $client = new \Google\Client();
    $code = request('code');
    $client->setClientId('703808494011-1olihj54jkheh53v5mh1a70jb94j55uv.apps.googleusercontent.com');
    $client->setClientSecret('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');
    $client->setRedirectUri('http://127.0.0.1:8000/google-drive/callback');

    $access_token = $client->fetchAccessTokenWithAuthCode($code);
    return $access_token;
});

Route::get('upload', function () {
    $access_token = 'ya29.A0ARrdaM-CCMYgDXoh2G58rZuLuefI5asRA2wue_tR0p40k99R5upnKx8TUWvYcG-Aqy1npbJ6dZxOQ3u49vh6y4YDUCxtcMQHHqPKwwaYBwClDheHCdh8FgBFZaRqihh4-o-ehsu2Ax9y4JFw5Z3BFU2uVar2';
    $client = new \Google\Client();
    $client->setAccessToken($access_token);
    $service = new Google\Service\Drive($client);
    $file = new Google\Service\Drive\DriveFile();
    $result = $service->files->create(
        $file,
        array(
            'data' => file_get_contents("test.txt"),
            'mimeType' => 'application/octet-stream',
            'uploadType' => 'media'
        )
    );
    $file->setName("Hello World!");
    $result2 = $service->files->create(
        $file,
        array(
            'data' => file_get_contents("test.txt"),
            'mimeType' => 'application/octet-stream',
            'uploadType' => 'multipart'
        )
    );

});

//service container
Route::get('/pay', [\App\Http\Controllers\PayOrderController::class, 'store']);
//end service container
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//eloquent orm

Route::get('/orm', function () {
    //using with
//    $user = User::with('todoLists')->first();
//    return $user->toArray();
    //The attributesToArray method may be used to convert a model's attributes to an array but not its relationships:
//    $user = User::first();
//    return $user->attributesToArray();
//You may also convert entire collections of models to arrays by calling the toArray method on the collection instance:

//    $users = User::all();
//
//    return $users->toArray();

    //
    //$user = User::find(1);

    //return $user->toJson();

    // return $user->toJson(JSON_PRETTY_PRINT);
    //return (string) User::find(1);

    //The diff method returns all of the models that are not present in the given collection:
    //The except method returns all of the models that do not have the given primary keys
    $users = User::all();
//    $users = $users->diff(User::whereIn('id', [1, 2, 3])->get());
    // $users = $users->except([1, 2, 3]);
    //The fresh method retrieves a fresh instance of each model in the collection from the database. In addition, any specified relationships will be eager loaded:\

    // $users = $users->fresh();
    //$users = $users->fresh('todoLists');


    //The intersect method returns all of the models that are also present in the given collection:
    // $users = $users->intersect(User::whereIn('id', [1, 2, 3])->get());
    //return $users->toArray();
    //The load method eager loads the given relationships for all models in the collection:
    //$users->load(['todoLists', 'Services']);

    //$users->load('todoLists.tasks');


    //The loadMissing method eager loads the given relationships for all models in the collection if the relationships are not already loaded
    //$users->loadMissing(['comments', 'posts']);

    //$users->loadMissing('comments.author');

    //The modelKeys method returns the primary keys for all models in the collection:
    $users->modelKeys();
    return $users;


});
