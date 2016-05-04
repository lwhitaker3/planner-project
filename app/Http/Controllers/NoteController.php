<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Note;
use App\Repositories\NoteRepository;

use App\Task;
use App\Repositories\TaskRepository;

use App\Category;
use App\Repositories\CategoryRepository;

use App\Reminder;
use App\Repositories\ReminderRepository;

use App\User;
use Carbon\Carbon;

use App\Daily_Note;
use App\Repositories\DailyRepository;

class NoteController extends Controller
{


  /**
   * The task repository instance.
   *
   * @var TaskRepository
   */
  protected $notes;
  protected $categories;
  protected $tasks;
  protected $reminders;

  /**
   * Create a new controller instance.
   *
   * @param  NoteRepository  $notes
   * @return void
   */
  public function __construct(NoteRepository $notes, CategoryRepository $categories, TaskRepository $tasks, ReminderRepository $reminders, DailyRepository $daily_notes){
    $this->middleware('auth');
    $this->notes = $notes;
    $this->categories = $categories;
    $this->tasks = $tasks;
    $this->reminders = $reminders;
    $this->daily_notes = $daily_notes;




  }


  /**
   * Display a list of all of the user's task.
   *
   * @param  Request  $request
   * @return Response
   */

 public function index(Request $request, Note $note, Category $category, Task $task, Reminder $reminder)
   {


      $notes = Note::where('user_id', $request->user()->id)->get();

    // $color = Category::where('user_id', $request->user()->id)->where('category_id', $note->category_id)->get();

       return view('frontend.notes', [
           'notes' => $this->notes->forUser($request->user())->sortBy('order'),
           'categories' => $this->categories->forUser($request->user()),
           'tasks' => $this->tasks->forUser($request->user())->sortBy('order'),
           'reminders' => $this->reminders->forUser($request->user()),
           'newsFeedDate' => Carbon::today(),
           'daily_notes' => $this->daily_notes->forUser($request->user()),


       ]);



   }



   /**
  * Create a new task.
  *
  * @param  Request  $request
  * @return Response
  */

  public function store(Request $request, Category $category)
  {
      // $this->validate($request, [
      //     'text' => 'required|max:255',
      // ]);

      // $request->user()->notes()->create([
      //     'text' => $request->text,
      // ]);

      $note = $request->user()->notes()->create([
        'created_at' => $request->created_at,
      ]);
      $obj = array();
      $obj['note_item'] = view('frontend.note_item', [
          'note' => $note,
          'categories' => $this->categories->forUser($request->user()),
      ])->render();
      $obj['jsonTask'] = json_encode($note);
      return $obj;
      // return redirect('/notes');
  }



  public function edit(Request $request, Note $note){

    // $this->validate($request, [
    //   'text' => 'required|max:255',
    // ]);
    $this->authorize('destroy', $note);

    $note->text = $request->text;
    $note->title = $request->title;
    $note->order = $request->order;
    $note->xpos = $request->xpos;
    $note->category_id = $request->category_id;


    $note->save();
    return response()->json($note);


  }



  /**
   * Destroy the given task.
   *
   * @param  Request  $request
   * @param  Task  $task
   * @return Response
   */
  public function destroy(Request $request, Note $note)
  {
      $this->authorize('destroy', $note);
      $obj = array();
      $note->delete();
      return $obj;
      // return redirect('/notes');
  }

}
