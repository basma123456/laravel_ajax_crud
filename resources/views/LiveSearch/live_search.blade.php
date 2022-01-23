@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">

        <div class="col-md-3">

        </div>

        
        <div class="col-md-6">
        <h2 class="text-center">Auto Complete Serach Box</h2><hr>
            <div class="form-group mt-5">
            <h4>Type by id, title or description :</h4>

                <div class="text-center d-block w-100"> 
                    <input type="text" name="search" id="search" class="form-control" value="" placeholder="search here" /><span class='hide btn btn-secondary float-right' id='x_dismiss'>x</span>
                </div>
                <div id="search_list">

                </div>



            </div>

        </div>

        <div class="col-md-3">

        </div>



    </div>
</div>

    <script>
        $(document).ready(function(){
            $('#search').on('keyup' , function(){
                $('#x_dismiss').addClass('show');

                var query = $(this).val();

                $.ajax({
                    url:"search",
                    type:"GET",
                    data:{'search':query},
                    success:function(data){
                        $('#search_list').html(data);
                    }
                });
            });

            /////////////////////


            ///////////////////////////

            $('#x_dismiss').on('click' ,function(){
     $('#table-live-search').fadeOut();
     $('#x_dismiss').removeClass('show');

});



        });




        ////////////////////////

    </script>




@endsection