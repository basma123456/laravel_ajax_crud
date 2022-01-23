
jQuery(function() { 
        $(document).on('click' , '.category_checkbox' , function(e){

        var ids = [];
        var counter = 0;

        $('#catFilters').empty();
        $('.category_checkbox').each(function(){
            if($(this).is(":checked")){
                ids.push($(this).attr('id'));
                //$('#catFilters').addClass('p-2 bg-danger');
                                $('#catFilters').append('<div class="alert toggle alert-color" role="alert"> <h2> ' + $(this).attr('attr-name') + ' </h2> <button type="button" class="close" data-dismiss="alert" aria-label="close"> <span aria-hidden="true">x</span></button> </div>');          
                                counter++;
            }
        });


        $('._t-item').text('(' + ids.length + ' items)');

        if(counter == 0){
            $('.causes_div').empty();
            $('.causes_div').append('No Data Found');
        }else{

        //     ids.forEach(func3);
        //    function func3(id){
             fetchCauseAgainstCategory(ids);
        //    }
            
        }

    });
});

function fetchCauseAgainstCategory(ids){
    // const data = ids;
//  data.forEach(secondFunc);

//    function secondFunc(id){
   $('.causes_div').empty();
   let url = "/get_causes_against_category/" + ids;

    $.ajax({
        type: "GET",
        url: url,
        // cache: false,
        // dataType : 'json',
        success: function(response){

            var response = JSON.parse(response);
            console.log(response);


            if(response.length == 0){
                $('.causes_div').append('No data found');
            }else{
                response.forEach(element => {
                    $('.causes_div').append('<div href="#" class="col-lg-4 col-md-6 col-sm-6 col-xs-12 r-causes IMGsize"> <div class"img_thumb"> <img width="200" height="200" src="photos/categories/'+ element.cat_image +'" />  </div> <h3>'+ element.cat_title +'</3> </div>');
                });

                

            }
        }
    });
// }//secondFunc
}