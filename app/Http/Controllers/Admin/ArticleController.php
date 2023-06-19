<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\Articles\StoreArticleRequest;
use App\Http\Requests\Articles\UpdateArticleRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function perPage( $num=10 )
    {
        // Get Parent Rows Count
        $categoriesCount = Category::count();

        // Dynamic pagination
        $articles = Article::orderBy('id','desc')->paginate( $num );
        return view("admin.article.index",compact("articles","categoriesCount"));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get Parent Rows Count
        $categoriesCount = Category::count();

        $articles = Article::orderBy('id','desc')->paginate( 10 );
        return view("admin.article.index",compact("articles","categoriesCount"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id','title')->get();
        return view("admin.article.create",compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {

        // save all request in one variable
        $requestData = $request->all();


        //  Upload image & Create name img
        $file_extention = $request->img -> getClientOriginalExtension();
        $file_name = time() . "." . $file_extention;   // name => 3628.png
        $path = "images/articles" ;
        $request -> img -> move( $path , $file_name );
        // edit var img at $requestData Array
        $requestData['img'] = $file_name;


        // add slug in $requestData Array
        $requestData += [ 'slug' => Str::slug( $request->title , '-') ];


        // return $requestData;
        // Store in DB
        try {
            $article = Article::create( $requestData );
                return redirect() -> route("admin.article.index")-> with( [ "success" => " Article store successfully"] ) ;
            if(!$article)
                return  redirect() -> route("admin.article.index")-> with( [ "failed" => "Error at store opration"] ) ;
        } catch (\Exception $e) {
            return  redirect() -> route("admin.article.index")-> with( [ "failed" => "Error at store opration"] ) ;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // find id in Db With Error 404
        $article = Article::findOrFail($id);
        return view("admin.article.show" , compact("article") ) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find id in Db With Error 404
        $article = Article::findOrFail($id);
        $categories = Category::select('id','title')->get();
        return view("admin.article.edit" , compact("article","categories") ) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, $id)
    {
        // find id in Db With Error 404
        $article = Article::findOrFail($id);

        // save all request in one variable
        $requestData = $request->all();

        // Check If There img Uploaded
        if( $request-> hasFile("img") ){
            //  Upload image & Create name img
            $file_extention = $request->img -> getClientOriginalExtension();
            $file_name = time() . "." . $file_extention;   // name => 3628.png
            $path = "images/articles" ;
            $request->img -> move( $path , $file_name );
        }else{
            $file_name = $article->img;
        }

        // Add img name to $requestData
        $requestData['img'] = $file_name;

        // add slug in $requestData Array
        $requestData += [ 'slug' => Str::slug( $request->title , '-') ];

        // return $requestData;

        // Update Record in DB
        try {
            $update = $article-> update( $requestData );
                return redirect() -> route("admin.article.index")-> with( [ "success" => " Article updated successfully"] ) ;
            if(!$update)
                return redirect() -> route("admin.article.index")-> with( [ "failed" => "Error at update opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> route("admin.article.index")-> with( [ "failed" => "Error at update opration"] ) ;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find id in Db With Error 404
        $article = Article::findOrFail($id);

        // Delete Record from DB
        try {
            $delete = $article->delete();
                return redirect() -> route("admin.article.index")-> with( [ "success" => " Article deleted successfully"] ) ;
            if(!$delete)
                return redirect() -> route("admin.article.index")-> with( [ "failed" => "Error at delete opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> route("admin.article.index")-> with( [ "failed" => "Error at delete opration"] ) ;
        }
    }



    /**
     * search in record.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // validate search and redirect back
        $this->validate($request, [
            'search'     =>  ['required', 'string', 'max:55'],
        ]);

        $articles = Article::where('title', 'like', "%{$request->search}%")->paginate( 10 );
        return view("admin.article.index",compact("articles"));

    }



    public function multiAction(Request $request)
    {

        // Validator at action
        $validator = Validator::make($request->all(),[
            "action" => 'required | string',
        ]);

        // Check If request->id exist
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        // Check If request->id exist & add validation Msg
        if( !$request->has('id') ){
            $validator->getMessageBag()->add('action', 'Please select rows..');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // If Action is Delete
        if( $request->action == "delete" ){
            try {
                $delete = Article::destroy( $request->id );
                    return redirect() -> route("admin.article.index")-> with( [ "success" => " Articles deleted successfully"] ) ;
                if(!$delete)
                    return redirect() -> route("admin.article.index")-> with( [ "failed" => "Error at delete opration"] ) ;
            } catch (\Exception $e) {
                return redirect() -> route("admin.article.index")-> with( [ "failed" => "Error at delete opration"] ) ;
            }
        }

    }


}
