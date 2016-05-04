@extends('layouts.app')

@section('content')
<script type="text/javascript" src="{{ url('/js/note_item.js') }}"></script>


<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">

      <div class="col-sm-2">
        <div class="fixed">
          @include('frontend.category')
        </div>
      </div>



      <div class="col-sm-8 note_area border_right border_left">

        <div class="row">

          <div class="col-sm-12">
          @include('common.errors')
          <!-- New Note Form -->
            <form action="/note" method="POST" class="create_note form-inline">
              {{ csrf_field() }}

                <!-- Note Text -->
              <!-- <div class="form-group">
                <label for="note-text" class="sr-only">Note</label>
                <input type="text" name="text" id="note-text" class="form-control" value="{{ old('note') }}" placeholder="Add New Note">
              </div> -->

                <!-- Add Note Button -->
              <button type="submit" class="btn btn-default">
                <img class="add_icons" src="{{ url('/images/icon-06.png') }}">
                <img class="add_icons" src="{{ url('/images/icon-02.png') }}">
              </button>

            </form>
          </div>
        </div>

        <div class="row">

          <div class="col-sm-12">
          <!-- Current Notes -->

            <div class="gutter-sizer"></div>
            <div class="grid-sizer"></div>
            <div id="note_list">


              @foreach ($notes as $note)

                @include('frontend.note_item')

              @endforeach
            </div>
          </div>
        </div>


      </div>

      <div class="col-sm-2">
        <div class="fixed">
          @include('frontend.news_feed')
        </div>
      </div>


    </div>
  </div>
  <script type="text/javascript" src="{{ url('/js/notes.js') }}"></script>
  <script>


  </script>
</div>

@endsection
