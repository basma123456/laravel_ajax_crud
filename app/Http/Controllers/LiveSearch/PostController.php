<?php

namespace App\Http\Controllers\LiveSearch;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
 public function showLiveSearchPage()
 {
    return view('LiveSearch.live_search');
 } 

 ////////////////////////////////////////////

 public function showList(Request $request){

   if($request->ajax()){
      $data = Post::where('id' , 'like' , '%'.$request->search.'%' )
               ->orWhere('title' , 'like' , '%'.$request->search.'%')
               ->orWhere('description' , 'like' , '%'.$request->search.'%')->get();

               $output = '';

      if(count($data)>0){

         $output = "
            <table id='table-live-search' class='table-live-search border border-2 table'>

               <thead class='border border-2 p-5'>
                  <tr>
                     <th scope='col'>#</th>
                     <th scope='col'>Title</th>
                     <th scope='col'>Description</th>
                  </tr>
               </thead>

               <tbody class='p-5'>";


                     foreach($data as $row){

                        $output .=  "<tr class='w-100 p-2'>  
                                       <th class='p-2' scope='row'>".$row->id."</th>
                                       <td class='p-2'>".$row->title."</td>
                                       <td class='p-2'>".$row->description."</td>

                                    </tr>";
                     }

                  
              $output .= "</tbody>
            </table>
         ";

      }else{
         $output .= 'No Results';
      }
   }

   return $output;
 }//showList function

 
 
}
