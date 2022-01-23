@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
         <div class="col-lg-3 col-md-12 col-sm-12">
            <div class="card mb-30">
                <h3>Refine By: <span class="_t-item"> (0 items) </span> </h3>
                <div class="col-12 p-0" id="catFilters"></div>
            </div>                              
            
            <div class="card">
                <div class="accordion" id="accordionExample">
                    <div class="card-header" id="headingTwo"> 
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            Categories                                   
                        </button>    
                    </div>


                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">

                        <div class="panel-body">
                            @php
                                $counter = 0;
                            @endphp

                            @if(!empty($main_categories))
                                @foreach($main_categories as $category)
                                    <div class="category_checkbox">
                                        <input 
                                        type="checkbox" 
                                        {{($counter == 0 ? 'checked' : '')}} 
                                        attr-name = "{{$category->name}}"
                                        class="category_checkbox"
                                        id="{{$category->id}}"
                                        />

                                        <label  
                                        for="{{$category->id}}">
                                            {{ucfirst($category->name)}}
                                        </label>
                                    </div>
                                    @php 
                                    $counter++;
                                    @endphp
                                @endforeach
                            @endif
                        </div>

                    </div>
            
            

                
                </div>

            </div>

         </div>

         <div class="col-lg-9 col-md-12 col-sm-12 mb-30">
            <div class="card h-100 mb-0">
                <h1>
                    <span class='text-success'>
                        {{$sub_categories->name}}
                    </span>
                </h1>

                <div class="row m-0 causes_div">

                </div>

            </div>
         </div>
     
    </div>
</div>

@endsection
