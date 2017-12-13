@extends('template')


@section('page_name')
    <span class="breadcrumb-item active">Module - {{$module->name}}</span>
@endsection


@section('content')
    
    <div class="page-head">
        <h3>
            Module - {{$module->name}}
        </h3>

        <div style="text-align: right;">
            <a class="btn btn-primary" href="{{url('/modules')}}/{{$module->id}}/item/create">Create Item</a>
        </div>
    </div>


    @if (session('status'))
        <div class="row">
            <div class="alert alert-dark">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                {{ session('status') }}
            </div>
        </div>
    @endif
    

    
    <div>
         <div class="row">        
            <div style="width: 100%;">
                <div class="col-md-12">
                    <div class="sl-page-title" style="margin-bottom: 0px!important;">
                        <h5>Items</h5>

                    </div>

                    <div class="card pd-20 pd-sm-20 mb-2">
                        <table id="datatable1" class="table display responsive nowrap data-table">
                            <thead>
                                <tr>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                <tr>
                                    <td>
                                        {{$item->name}}
                                    </td>
                                    <td>
                                        {{$item->description}}
                                    </td>
                                    <td>
                                        <a href="{{url('/modules')}}/item/{{
                                        $item->id}}/edit">Edit</a>
                                    </td>
                                    <td>   
                                        <form action="{{url('/item/delete')}}" method="post" >
                                            {{ csrf_field() }}

                                            <input type="hidden" value="{{$item->id}}" name="id">
                                            <button Onclick="return ConfirmDelete();" style="color: red;" type="submit">Delete</button>
                                        </form>    
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>        
        </div>    
    </div>
    

    <div>
        <div>
            <h3 style="margin-top:25px; text-align: center;">
                Translations
            </h3>
        </div>
        @foreach(App\Language::all() as $language)
            <div>
                <div class="row">        
                    <div style="width: 100%;">
                        <div class="col-md-12">
                            <div class="sl-page-title" style="margin-bottom: 0px!important;">
                                <h5>
                                    <img src="{{url('/assets')}}/img/flags/png/{{$language->code}}.png">
                                    {{$language->name}}
                                </h5>
                                <div style="text-align: right;">
                                    <a class="btn btn-primary" href="{{url('/module')}}/{{$module->id}}/language/{{$language->id}}/translation/create">
                                        Add translation
                                    </a>
                                </div>
                            </div>

                            <div class="card pd-20 pd-sm-20 mb-2">
                                <table id="datatable1" class="table display responsive nowrap data-table">
                                    <thead>
                                        <tr>
                                            <th>
                                                id
                                            </th>
                                            <th>
                                                Item
                                            </th>
                                            <th>
                                                Translation
                                            </th>
                                            <th>
                                                
                                            </th>
                                            <th>
                                                
                                            </th>

                                        </tr>
                                    </thead>
                                <tbody>
                                @foreach($items as $item)
                                    @foreach($item->translation as $translation)
                                        @if($translation->id_item == $item->id)
                                            @if($translation->id_language == $language->id)
                                                <td>
                                                    {{$translation->id}}
                                                </td>
                                                <td>
                                                    {{$item->name}}
                                                </td>
                                                <td>
                                                    {{$translation->value}}
                                                </td>
                                                    
                                                <td>
                                                    <a href="{{url('/modules')}}/{{$module->id}}/translation/{{$translation->id}}/edit">Edit</a>
                                                </td>
                                                <td>
                                                    <form action="{{url('/modules')}}/{{$module->id}}/translation/delete" method="post" >
                                                        {{ csrf_field() }}

                                                        <input type="hidden" value="{{$translation->id}}" name="id">
                                                        <button Onclick="return ConfirmDelete();" style="color: red;" type="submit">Delete</button>
                                                    </form> 
                                                </td>
                                            @endif
                                        @endif
                                    @endforeach
                                @endforeach
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>    
            </div>
        @endforeach
    </div>

@endsection
