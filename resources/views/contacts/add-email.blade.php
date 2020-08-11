@extends('base')
@section('main')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
     <br>
    <h3>Add a email address for {{ $contact->first_name }} {{ $contact->last_name }}</h3>
  <div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
    Current listed emails: {{ $contact->email }}
      <form method="post" action="/add-email/{{$contact->id}}">
         @csrf
          <div class="form-group">    
              <label for="email">Email Address:</label>
              <input type="email" class="form-control" name="email"/>
          </div>
                          
          <button type="submit" class="btn btn-primary">Add email</button>
          <a class="btn btn-danger" href="{{ url()->previous() }}">Cancel</a>
      </form>
  </div>
</div>
</div>
@endsection