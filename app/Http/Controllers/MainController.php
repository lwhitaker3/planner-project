<?php

namespace App\Http\Controllers;

use App\Category;
use App\Note;
use App\Task;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;

class MainController extends Controller
{
  /**
   * The task repository instance.
   *
   * @var TaskRepository
   */
  protected $categories;

  /**
   * Create a new controller instance.
   *
   * @param  CategoryRepository  $categories
   * @return void
   */
  public function __construct(CategoryRepository $categories){
    $this->middleware('auth');

    $this->categories = $categories;

  }


  /**
   * Display a list of all of the user's task.
   *
   * @param  Request  $request
   * @return Response
   */

  public function index(Request $request)
   {
       $categories = Category::where('user_id', $request->user()->id)->get();

       return view('frontend.category', [
           'categories' => $this->categories->forUser($request->user()),
       ]);
   }



   /**
  * Create a new task.
  *
  * @param  Request  $request
  * @return Response
  */

  public function store(Request $request)
  {
      // $this->validate($request, [
      //     'text' => 'required|max:255',
      // ]);

      // $request->user()->categories()->create([
      //     'text' => $request->text,
      // ]);
/*
      $category = new Category;
      $category->name = $request->name;
      $category->color = $request->color;
      $category->user_id = $request->user()->id;
      $category->save();
*/

      $category = $request->user()->categories()->create([
        'name' => $request->name,
        'color'=> $request->color,
      ]);

      $obj = array();
      $obj['html'] = view('frontend.category_item', [
          'category' => $category,
      ])->render();
      $obj['jsonCategory'] = json_encode($category);
      return $obj;
  }



  public function edit(Request $request, Category $category){

    // $this->validate($request, [
    //   'text' => 'required|max:255',
    // ]);
    $this->authorize('destroy', $category);

    $category->name = $request->name;
    $category->color = $request->color;


    $category->save();
    return response()->json($category);


  }



  /**
   * Destroy the given task.
   *
   * @param  Request  $request
   * @param  Task  $task
   * @return Response
   */
  public function destroy(Request $request, Category $category) {
      $this->authorize('destroy', $category);
      $notes = Note::where('user_id', $request->user()->id)->where('category_id', $category->id)->get();
      $tasks = Task::where('user_id', $request->user()->id)->where('category_id', $category->id)->get();
      $obj = array();
      if (count($notes) == 0 && count($tasks) == 0){
        $category->delete();
        $obj['success']=true;
      } else{
        $obj['success']=false;
      }

      return $obj;
  }
}
