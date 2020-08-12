@extends('base')
@section('main')
<div class="row">
<div class="col-sm-12">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div>
  @endif
</div>
 <div class="col-sm-8 offset-sm-2">
     <br>
    <h3>Add additional number for {{ $contact->first_name }} {{ $contact->last_name }}</h3>
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
    Current listed numbers: {{ $contact->number }}
      <form method="post" action="/add-number/{{$contact->id}}">
         @csrf
          <div class="form-group">    
              <label for="number">Number:</label>
              <input type="text" class="form-control" name="number"/>
          </div>
                          
          <button type="submit" class="btn btn-primary">Add number</button>
          <a class="btn btn-danger" href="{{ url()->previous() }}">Cancel</a>
      </form>
  </div>
</div>
</div>
@endsection