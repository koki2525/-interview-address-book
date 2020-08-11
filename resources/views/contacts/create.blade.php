@extends('base')
@section('main')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Add a contact</h1>
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
      <form method="post" action="{{ route('contacts.store') }}">
          @csrf
          <div class="form-group">    
              <label for="first_name">First Name:</label>
              <input type="text" class="form-control" name="first_name"/>
          </div>
          <div class="form-group">
              <label for="last_name">Last Name:</label>
              <input type="text" class="form-control" name="last_name"/>
          </div>
          <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" name="email"/>
          </div>
          <div class="form-group">
              <label for="city">Number:</label>
              <input type="text" class="form-control" name="number"/>
          </div>
                          
          <button type="submit" class="btn btn-primary">Add contact</button>
          <a class="btn btn-danger" href="{{ url()->previous() }}">Cancel</a>
      </form>
  </div>
</div>
</div>
@endsection