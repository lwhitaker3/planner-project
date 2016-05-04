<?php

namespace App\Http\Controllers;

use App\Reminder;
use App\Category;
use App\Note;
use App\Task;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ReminderRepository;

use Carbon\Carbon;

class ReminderController extends Controller
{
  public function __construct(ReminderRepository $reminders)
  {
      $this->middleware('auth');

      $this->reminders = $reminders;
  }

  public function index(Request $request)
  {
    $reminders = Reminder::where('user_id', $request->user()->id)->get();
    // $reminders = Reminder::where('user_id', $request->user()->id)->where('task_id', $taskId)->get();
      // return view('frontend.list', [
      //     'reminders' => $this->reminders->forUser($request->user()),
      // ]);
  }

  public function store(Request $request)
  {
      // $this->validate($request, [
      //     'name' => 'required|max:255',
      // ]);

      $reminder = $request->user()->reminders()->create([
        'task_id' => $request->task_id,
        'reminder_time' => Carbon::now(),
        // 'text' => $request->text,

      ]);

      $obj = array();
      $obj['html'] = view('frontend.reminder_item', [
          'reminder' => $reminder,
      ])->render();
      $obj['jsonCategory'] = json_encode($reminder);
      return $obj;

      // return redirect('/tasks');

  }

  public function edit(Request $request, Reminder $reminder){

    // $this->validate($request, [
    //   'text' => 'required|max:255',
    // ]);
    $this->authorize('destroy', $reminder);

    $reminder->text = $request->text;
    $reminderTime = Carbon::parse($request->reminder_time);
    $reminder->reminder_time = $reminderTime;


    $reminder->save();
    return response()->json($reminder);


  }

  /**
   * Destroy the given task.
   *
   * @param  Request  $request
   * @param  Task  $task
   * @return Response
   */

  public function destroy(Request $request, Reminder $reminder)
  {
      $this->authorize('destroy', $reminder);
      $obj = array();

      $reminder->delete();
      return $obj;
      // return redirect('/tasks');
  }
}
