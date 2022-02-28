<?php

    use Illuminate\Support\Facades\Route;

    use App\Http\Controllers\ProductController;
    use App\Models\Post;
    use Spatie\YamlFrontMatter\YamlFrontMatter;
    use Symfony\Component\Yaml\Yaml;
    use Illuminate\Support\Facades\File;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Input;


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

    // Route::get('/posts', function () {
    //     $posts = Post::all();

    //     return view('posts', [
    //         'posts' => $posts
    //     ]);
    // });

    // Route::get('/posts', function ()
    // {
    //     return view('posts', [
    //         'posts' => Post::all()
    //     ]);
    // });

    // Route::get('/posts', function(){
    //     $document = YamlFrontMatter::parseFile(
    //         resource_path('posts/my-fourth-post.html')
    //     );

    //         dd($document);
    // });

    Route::get('/posts', function(){
        $files = File::files(resource_path("posts"));

        $documents = [];

        foreach ($files as $file)
        {
            $documents[] = YamlFrontMatter::parseFile($file);
        }

        dd($documents);
    });

    Route::get('/post/{post}', function ($slug) {

        return view('post',[
            'post'=> Post::find($slug)
        ]);
    });

    // return $slug;
    // $post = file_get_contents(__DIR__ . "/../resources/posts/{$slug}.html");

    // if (! file_exists($path = __DIR__ . "/../resources/posts/{$slug}.html"))
    // {
    //     return redirect('/posts');
    // }

    // $post = cache()->remember("posts.{$slug}", 1200, fn () => file_get_contents($path));

    // $post = file_get_contents($path);

    // return view('post', ['post'=> $post]);


Route::get('/welcome', function ()
{
	echo "<a href='" .route('bye'). "'> Bye Link </a>";
})->name('welcome');

Route::get('/bye', function ()
{
	echo "<a href='" . route('welcome') . "'> Welcome Link </a>";
	$countries = ['12345' =>'Pakistan', '67890' =>'India', '24680' =>'Chine'];
	echo "<ul>";
		foreach ($countries as $population => $country)
		{
			echo "<li> <a href='". route('about.country', ['country' => $country, 'population' => $population]). "'> $country </a> </li>";
		}
	echo "</ul>";
})->name('bye');

Route::get('/about/{country?}', function ($country)
{
	return "Welcome to {$country}, Our Population is: " . request('population');
})->name('about.country');

Route::resource('products', ProductController::class);
