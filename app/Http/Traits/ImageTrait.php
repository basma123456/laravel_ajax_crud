<?php

namespace App\Http\Traits;


trait ImageTrait {


     function getImage($reqName , $path){
            ////////////////////////////////////////////////////
                $ext = $reqName->getClientOriginalExtension();
                $image_name = time() . '.' . $ext;
                $folder = $path;
                $reqName->move($folder , $image_name);
                //note in the above line that path is in the -----storage->app->public->{create a file and name it --media--}
              //  $brand->image = $image_name;
              return $image_name;
    
                ////////////////////////////////////////////////////
    

    }


}


