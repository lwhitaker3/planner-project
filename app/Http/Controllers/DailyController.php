<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Daily_Note;
use App\Http\Requests;
use App\Repositories\DailyRepository;


class DailyController extends Controller
{

  public function __construct(DailyRepository $daily_notes)
  {
      $this->middleware('auth');

      $this->daily_notes = $daily_notes;
  }
  public function store(Request $request)
  {

      $daily_note = $request->user()->daily_notes()->updateOrCreate([
          'day' => $request->day,
      ],[
          'text' => $request->text,
          'day' => $request->day,
      ]);
      return response()->json($daily_note);

  }


  public function index(Request $request, Daily_Note $daily_note)
  {
    $daily_notes = Daily_Note::where('user_id', $request->user()->id)->get();
  }
}
