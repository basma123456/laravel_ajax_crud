@extends('layouts.app')

@section('content')


<div class="container">
<table class="table table-inverse">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody id="todos-list" name="todos-list">
                @foreach ($users as $user)
                <tr id="todo{{$user->id}}">
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New User</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@csrf
<div class="form-group">
        <input type="hidden" name="remeber_token" id="csrf" value="{{Session::token()}}">
    <label for="name">Name:</label>
    <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
  </div>
  <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
  </div>

  <div class="form-group">
    <label for="password">Password:</label>
    <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password">
  </div>

  <button type="submit" class="btn btn-primary" id="butsave">Submit</button>
</div>
<script>
$(document).ready(function() {
   
    $('#butsave').on('click', function() {
      var name = $('#name').val();
      var email = $('#email').val();
      var password = $('#password').val();
      var _token = $('#csrf').val();

      if(name!="" && email!="" ){
        /*  $("#butsave").attr("disabled", "disabled"); */
          $.ajax({
              url: "/users",
              type: "POST",
              data: {
                  type: 1,
                  name: name,
                  email: email,
                  password : password,
                    _token : _token
              },
              cache: false,
              success: function(dataResult){
                  console.log(dataResult);
                  var dataResult = JSON.parse(dataResult);

                  $("table tbody").prepend('<tr> <td>' + dataResult.name + '</td> <td>' + dataResult.email + '</td> <td>' + dataResult.id + '</td> <td>' + response.password + '</td>  </tr>');

                  if(dataResult.statusCode==200){
                    window.location = "/users";				
                  }
                  else if(dataResult.statusCode==201){
                     alert("Error occured !");
                  }
                  
              }
          });
      }
      else{
          alert('Please fill all the field !');
      }
  });
});
</script>
@endsection

