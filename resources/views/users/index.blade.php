@extends('layouts.app')

@section('content')


<div class="container">
  <div class="offset-1 col-10">
  <div  id="msg"></div>
<table class="table table-inverse">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Image</th>

                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="todos-list" name="todos-list">
                @foreach ($users as $user)
                <tr id="todo{{$user->id}}" data-myid='{{$user->id}}'>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td><img src="{{asset('photos/')}}/{{$user->image}}" width="100" height="100"/></td>

                    <td>
      <a data-id="{{$user->id}}" id="edit_user" class="btn btn-primary btnEdit">Edit</a>
      <a data-id="{{$user->id}}" onclick="deleteNow(this)"  id="deleteUser" class="btn btn-danger btnDelete">Delete</a>
                </td>
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
<form id='myForm'>
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


  <div class="form-group">
    <label for="image">Image:</label>
    <input type="file" class="form-control" id="image"  name="image" />
  </div>


  <button type="submit" class="btn btn-primary" id="btn-save">Submit</button>
</div>
</form>






<!---////////////////////////-->
<div class="modal" id="updateModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="updateUser" name="updateStudent"  method="PUT" >
      {{ method_field('PATCH') }}
         @csrf
      <input type="hidden" name="update_id" id="update_id"/>
 <div class="form-group">
 <label for="txtFirstName">Name:</label>
 <input type="text" class="form-control" id="update_name" placeholder="Enter First Name" name="name">
    <span class="form-text text-danger" id="name_error"></span> 
 </div>

 <div class="form-group">
 <label for="txtLastName">Email:</label>
 <input type="text" class="form-control" id="update_email" placeholder="Enter Last Name" name="email">
 <span class="form-text text-danger" id="email_error"></span> 
 </div>

 <div class="form-group">
 <label for="txtAddress">password:</label>
 <input type="password" class="form-control" id="update_password" name="password"  />
 <span class="form-text text-danger" id="password_error"></span> 
 </div>


 <div class="form-group">
 <label for="txtAddress">photo:</label>
 <input type="file" class="form-control" id="update_img" name="image"  />
 <span class="form-text text-danger" id="image_error"></span> 
 </div>


 <button type="submit"  id="update_button" class="btn btn-primary">Submit</button>
 </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--///////////////////////////////-->

<!-- Update Student Modal -->
<!--
<div id="updateModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
-->
    <!-- Student Modal content-->
    <!--
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Student</h4>
      </div>
   <div class="modal-body">
 <form id="updateStudent" name="updateStudent" action="{{route('users.update' , $user->id)}}" method="post">
 <input type="hidden" name="id" id="id"/>
 @csrf
 <div class="form-group">
 <label for="txtFirstName">Name:</label>
 <input type="text" class="form-control" id="name" placeholder="Enter First Name" name="name">
 </div>
 <div class="form-group">
 <label for="txtLastName">Email:</label>
 <input type="text" class="form-control" id="email" placeholder="Enter Last Name" name="email">
 </div>
 <div class="form-group">
 <label for="txtAddress">password:</label>
 <input type="password" class="form-control" id="password" name="password"  />
 </div>
 <button type="submit" class="btn btn-primary">Submit</button>
 </form>
   </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> -->
<!--/////////////////////-->

  <!----------------------start of delete modal---------->
    <!-- Button trigger modal -->

    <!-- Modal  //herenow-->
    <!-- <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="deleteForm" data-route="{{url('users_delete/')}}">
              <input type="hidden" value="{{$user->id}}" name='my_id' id='my_id' />
              <input type="submit" value='submit'>
            </form>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div> -->
  
    <!-- //endherenow -->
    </div>
  <!----------------the end of delete modal ------------------>


<script>
jQuery(document).ready(function(){

//----- Open model CREATE -----//
/*
jQuery('#btn-add').click(function () {
    jQuery('#btn-save').val("add");
    jQuery('#myForm').trigger("reset");
    jQuery('#formModal').modal('show');
});
*/
// CREATE
  $("#myForm").submit(function (e) {

  
   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();


   /* var formData = new FormData();
      var edit_form_image = $('#image').val();
      var edit_form_name = $('#name').val();
      var edit_form_profession = $('#email').val();
      var edit_form_password = $('#password').val();


      formData.append("image",$("#image")[0].files[0]);
      formData.append( 'name', edit_form_name );
      formData.append( 'email', edit_form_profession );
      formData.append( 'password', edit_form_password );
*/
var formData = new FormData($(this)[0]);

    var state = jQuery('#btn-save').val();
    var type = "POST";
    var ajaxurl = "{{route('users.store')}}";
    $.ajax({
        type: type,
        enctype:"multipart/form-data",
        url: ajaxurl,
        data: formData,
        processData: false, 
        contentType: false,
        dataType: 'json',
        success: function (data) {
            var todo = '<tr id="todo' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.email + '</td>' + '<td><img src="/photos/' + data.image +'" width="100" height="100" name="image" /> <td><a data-id="' + data.id + '" id="edit_user" class="btn btn-primary btnEdit">Edit</a><td><a data-id="' + data.id + '" id="deleteUser" class="btn btn-danger btnDelete"  data-toggle="modal" data-target="#deleteModal">Delete</a></tr>';
/****************************************** */
// <td><img src="{{asset('photos/')}}/{{$user->image}}" width="100" height="100"/></td>

// <td>
// <a data-id="{{ $user->id }}" id="edit_user" class="btn btn-primary btnEdit">Edit</a>
// <a data-id="{{ $user->id }}" id="deleteUser" class="btn btn-danger btnDelete" data-toggle="modal" data-target="#deleteModal">Delete</button>
// </td>
// </tr>

/**************************************** */
            if (data) {

                jQuery('table tbody').prepend(todo);
            } else {
               // jQuery("#todo" + todo_id).replaceWith(todo);
               alert('nooooooooo');
            }
            jQuery('#myForm').trigger("reset");
            //jQuery('#formModal').modal('hide')
        },
        error: function (data) {
            alert('noooooo');
        }
    });
});
});

/**************************************************** */
/*
 
    //When click edit student
    $('body').on('click', '.btnEdit', function (e) {
      e.preventDefault();
      var user_id = $(this).attr('data-id');
      $.get('users/' + user_id +'/edit', function (data) {
          $('#updateModal').modal('show');
          $('#updateStudent #id').val(data.id); 
          $('#updateStudent #name').val(data.name);
          $('#updateStudent #email').val(data.email);
          $('#updateStudent #password').val(data.password);
          $arr = [ data.id ,  data.name  ,  data.email , data.status];
          console.log($arr);
          if(data.status == 200){
            $('#msg').show();
          }
      })
   });
    // Update the student
 $("#updateStudent").validate({
 rules: {
 name: "required",
 email: "required",
 password: "required"
 
 },
 messages: {
 },
 
 submitHandler: function(form) {
   var form_action = $("#updateStudent").attr("action");
   $.ajax({
   data: $('#updateStudent').serialize(),
   url: form_action,
   type: "PATCH",
   dataType: 'json',
   success: function (data) {

       /*
   var student = '<td>' + data.id + '</td>';
   student += '<td>' + data.first_name + '</td>';
   student += '<td>' + data.last_name + '</td>';
   student += '<td>' + data.address + '</td>';
   student += '<td><a data-id="' + data.id + '" class="btn btn-primary btnEdit">Edit</a>&nbsp;&nbsp;<a data-id="' + data.id + '" class="btn btn-danger btnDelete">Delete</a></td>';
   
   */
   /*
   if(data){
    var todo = '<tr id="todo' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.email + '</td> <td> ' + '<a data-id="' + data.id + '" class="btn btn-primary btnEdit">Edit</a>&nbsp;&nbsp;<a data-id="' + data.id + '" class="btn btn-danger btnDelete">Delete</a></td>' + '</tr>';

  jQuery('table tbody').append(todo);

   $('table tbody #'+ data.id).html(student);
   $('#updateStudent')[0].reset();
   $('#updateModal').modal('hide');
   }
   },
   error: function (data) {
   }
   });
 }
 }); 
*/
/********************************the end********************** */
$(document).on('click' , '#edit_user' , function(e){

e.preventDefault();
var user_id = $(this).attr('data-id');
var url = 'users/'+user_id+'/edit';
//console.log(user_id);
$('#updateModal').modal('show');
$.ajax({
  type:"GET",
  url:url,


  success : function(response){

        if(response.status === 200){

          console.log(response);
          $('#msg').html("");
          $('#msg').addClass('alert alert-success');
          $('#msg').text(response.msg);

          $('#update_id').val(user_id);
          $('#update_name').val(response.user.name);
          $('#update_email').val(response.user.email);
          $('#update_password').val(response.user.password);


        }else{
                    $('#msg').html("");
          $('#msg').addClass('alert alert-danger');
          $('#msg').text(response.msg);

        }

  }//success :

});

});
/*****************************end of edit section****************************** */

 /****************************start of update section********** */   

  $('#updateUser').submit( function(e){



    e.preventDefault();

    var user_id = $('#update_id').val();
    var url = "users/"+user_id;
    var data = {
      'id' : user_id,
      'name' : $('#update_name').val(),
      'email' : $('#update_email').val(),
      'password' : $('#update_password').val(),
      'image' : $('#update_img').val(),
      '_method':'PATCH',
      '_token':'{{ csrf_token() }}',
      
      
    }

    $.ajax({

      type: 'PUT',
			cache: false,
        url: url,
        data : data ,
        dataType : 'json',

        success : function(response){

          if(response.status === 200){
                $('#msg').html("");

                  
                $('#msg').addClass('alert alert-success');
                $('#msg').text(response.msg);
                $('#updateModal').modal('hide');
              var myButtons = '<a data-id="' +  response.user.id  + '" id="edit_user" class="btn btn-primary btnEdit">Edit</a> <a data-id="'+ response.user.id +'" class="btn btn-danger btnDelete">Delete</button>';

              if(response.user.image != null){
              var img = '<img src="/photos/'+ response.user.image +'" name="image" width="100" height="100" />';
              }else{
                var img = '<img src="/photos/no_photo.png" name="image" width="100" height="100" />';

              }
              var todo2 = '<tr id="todo' + response.user.id + '"><td>' + response.user.id + '</td><td>' + response.user.name + '</td><td>' + response.user.email + '</td> ' + '<td>' + img + '</td>' + ' <td>'+ myButtons +'</td>';

              if(response){

                    jQuery('table tbody #todo'+ response.user.id).replaceWith(todo2);
                  // jQuery('table tbody #todo2').append(todo2);

              }
          }else{//if(response.status===200)
              $('#msg').html("");                  
              $('#msg').addClass('alert alert-danger');
              $('#msg').text(response.msg);
              $('#updateModal').modal('hide');

            
//here
          }
      
      },
        error: function (reject) { //herehere

          var response = $.parseJSON(reject.responseText);

          $.each(response.errors , function(key , val){
            $('#'+key+'_error').text(val[0]);
          });
        }
    });

  });
 /***************************end of update section************ */  




 /**************************strat of delete section********************* */                                                                            
// $(document).ready(function(){


//   $('#deleteForm').submit(function(e){
//     e.preventDefault();

//     var data = {
//         '_method': 'delete',
//         '_token':'{{ csrf_token() }}',
        

//         // 'id':$('#myId').val
        
//           };

//     $.ajax({

//       type:'get',
//       // url: $(this).data('route'),
//       url: $(this).attr('data-route'),

//       data:data,
//       dataType:json,
//       success: function (response, textStatus, xhr) {

//                     alert(response)
//                     // window.location='/users'
//                   }//here


//     });




//   });

// });


// $(document).on('click' , '.delete' , function(){
//   var route = $(this).attr("data-route");
//   $.ajax({
//     type:"get",
//     url:route,
//     success:function($data)
//     {
//         alert(data.success);
//         $("#"+data.id).remove();
//     }
//   });
// });
  /*******************************end of delete secion*********** */



  function deleteNow(a){

        $myid = a.getAttribute('data-id');
      // alert($myid);
        $.ajax({

          type:'get',
          // url: $(this).data('route'),
          url: 'users_delete/' + $myid,

          success: function (data) {
                        // window.location='/users'
                        $('#todo'+data.id).remove();
                      }//here


        });




  }

</script>
@endsection




