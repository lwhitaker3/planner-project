<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Task;
use App\Repositories\TaskRepository;

use App\Category;
use App\Repositories\CategoryRepository;

use App\Reminder;
use App\Repositories\ReminderRepository;

use App\Daily_Note;
use App\Repositories\DailyRepository;

use Carbon\Carbon;

class TaskController extends Controller
{


  /**
   * The task repository instance.
   *
   * @var TaskRepository
   */
  protected $tasks;
  protected $categories;
  protected $reminders;

  /**
   * Create a new controller instance.
   *
   * @param  TaskRepository  $tasks
   * @return void
   */
  public function __construct(TaskRepository $tasks, CategoryRepository $categories, ReminderRepository $reminders, DailyRepository $daily_notes){
    $this->middleware('auth');
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

 public function index(Request $request, Reminder $reminder)
   {
      $tasks = Task::where('user_id', $request->user()->id)->get();

      if($request->offset){
        $daysOffset = intval($request->offset);
      }else{
        $daysOffset = 0;
      };

      return view('frontend.planner', [
          'tasks' => $this->tasks->forUser($request->user()),
          'reminders' => $this->reminders->forUser($request->user()),
          'daily_notes' => $this->daily_notes->forUser($request->user()),
          'startDate' => Carbon::today()->addDay($daysOffset),
          'daysOffset' => $daysOffset,
          'numDays' => 8,
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
    $this->validate($request, [
        'title' => 'required|max:255',
    ]);

    $task = $request->user()->tasks()->create([
        'title' => $request->title,
        // $dueDate = Carbon::createFromDate(0000,00,00,00,00,00),
        'due_date' => null,
    ]);

    $obj = array();
    $obj['list_item'] = view('frontend.planner_task_item', [
        'task' => $task,
    ])->render();
    $obj['jsonTask'] = json_encode($task);
    return $obj;
  }

  public function edit(Request $request, Task $task)
  {

    $this->authorize('destroy', $task);

    if($request->do_date){
      $doDate = Carbon::parse($request->do_date);
    }else{
      $doDate = null;
    }

    // $dueDate = Carbon::createFromDate(2012, 12, 21, 'GMT');
    $task->do_date = $doDate;
    $task->completed = $request->completed;



    $task->save();
    return response()->json($task);
  }



  /**
   * Destroy the given task.
   *
   * @param  Request  $request
   * @param  Task  $task
   * @return Response
   */
  public function destroy(Request $request, Task $task)
  {
      $this->authorize('destroy', $task);

      $task->delete();

      return redirect('/planner');
  }

  /**
   * Display a list of all of the user's task.
   *
   * @param  Request  $request
   * @return Response
   */

 public function index2(Request $request, Category $category, Reminder $reminder)
   {
       $tasks = Task::where('user_id', $request->user()->id)->get();

       return view('frontend.list', [
           'tasks' => $this->tasks->forUser($request->user())->sortBy('order'),
           'categories' => $this->categories->forUser($request->user()),
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

  public function store2(Request $request, Category $category)
  {
      $this->validate($request, [
          'title' => 'required|max:255',
      ]);

      $task = $request->user()->tasks()->create([
          'title' => $request->title,
          // $dueDate = Carbon::createFromDate(0000,00,00,00,00,00),
          'due_date' => null,
      ]);

      $obj = array();
      $obj['list_item'] = view('frontend.task_item', [
          'task' => $task,
      ])->render();
      $obj['edit_section'] = view('frontend.task_item_edit', [
          'task' => $task,
          'categories' => $this->categories->forUser($request->user()),
          'reminders' => [],
      ])->render();
      $obj['jsonTask'] = json_encode($task);
      return $obj;

      // return redirect('/tasks');
  }

  public function editComplete(Request $request, Task $task)
  {

    $this->authorize('destroy', $task);

    // $task->title = $request->title;
    $task->completed = $request->completed;
    $task->order = $request->order;


    $task->save();
    return response()->json($task);
  }

  public function editTask(Request $request, Task $task)
  {

    $this->authorize('destroy', $task);

    $task->title = $request->title;
    if($request->due_date){
      $dueDate = Carbon::parse($request->due_date);
    }else{
      $dueDate = null;
    }

    // $dueDate = Carbon::createFromDate(2012, 12, 21, 'GMT');
    $task->due_date = $dueDate;
    $task->text = $request->text;
    $task->category_id = $request->category_id;



    $task->save();
    return response()->json($task);
  }



  /**
   * Destroy the given task.
   *
   * @param  Request  $request
   * @param  Task  $task
   * @return Response
   */
  public function destroy2(Request $request, Task $task)
  {
      $this->authorize('destroy', $task);
      $obj = array();
      $task->delete();
      return $obj;
      // return redirect('/tasks');
  }

}
