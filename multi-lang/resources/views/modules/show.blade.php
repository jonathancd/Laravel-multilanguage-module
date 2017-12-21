@extends('template')


<style type="text/css">
    th{
        /*display: block!important;*/
    }


    .item-name{
        white-space: normal!important;
        width: 20%!important;
    }
    .item-description, .item-code{
        white-space: normal!important;
        width: 30%!important;
    }
    .item-option{
        white-space: normal!important;
        width: 10%!important;
    }

    .translation-item{
        white-space: normal!important;
        width: 25%!important;
    }
    .translation-value{
        white-space: normal!important;
        width: 55%!important;
    }
    .translation-option, .translation-option{
        white-space: normal!important;
        width: 10%!important;
    }



    .nav-tabs {
        border-bottom: 1px solid #ddd;
    }
    .nav {
        padding-left: 0;
        margin-bottom: 0;
        list-style: none;
    }
    .nav-tabs {
        border-bottom: 1px solid #ddd;
    }

    .nav-tabs .nav-link.active, .nav-tabs .nav-link.active:focus, .nav-tabs .nav-link.active:hover, .nav-tabs .nav-item.open .nav-link, .nav-tabs .nav-item.open .nav-link:focus, .nav-tabs .nav-item.open .nav-link:hover {
        color: #55595c;
        background-color: #fff;
        border-color: #ddd #ddd transparent;
    }
    .nav-tabs .nav-link {
        display: block;
        padding: .5em 1em;
        border: 1px solid transparent;
        border-radius: .25rem .25rem 0 0;
    }
    .nav-tabs .nav-item {
        float: left;
        margin-bottom: -1px;
    }
</style>



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
        <div style="margin-top: 10px;">
            <div class="alert alert-dark" style="width: 100%;">
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

                    <div class="card mb-2">
                        <table id="datatable1" class="table display responsive nowrap data-table">
                            <thead>
                                <tr>
                                    <th class="item-name" style="width: 20%!important;">
                                        Name
                                    </th>
                                    <th class="item-description" style="width: 30%!important;">
                                        Description
                                    </th>
                                    <th class="item-code" style="width: 30%!important;">
                                        PHP code
                                    </th>
                                    <th class="item-option"></th>
                                    <th class="item-option"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                <tr>
                                    <td class="item-name">
                                        {{$item->name}}
                                    </td>
                                    <td  class="item-description">
                                        {{$item->description}}
                                    </td>
                                    <td class="item-code">
                                        <!-- <pre> -->
                                            <code id=code-php class="code xml" data-clipboard-target="#code-php">
                                                &#123;&#123;App&#92;Translation&#58;&#58;getTranslation&#40;&#39;{{$item->name}}&#39;&#41;&#125;&#125;
                                            </code>
                                        <!-- </pre> -->
                                    </td>
                                    <td  class="item-option">
                                        <a href="{{url('/item')}}/{{
                                        $item->id}}/edit">Edit</a>
                                    </td>
                                    <td  class="item-option">   
                                        <form action="{{url('/items/delete')}}" method="post" class="form-delete">
                                            {{ csrf_field() }}

                                            <input type="hidden" value="{{$item->id}}" name="id">
                                            <button class="btn-delete" Onclick="return ConfirmDelete();" style="color: red;" type="submit">Delete</button>
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
            <h3 style="margin-top:25px;">
                Translations
            </h3>
        </div>

        <div>
            <ul class="nav nav-tabs" role="tablist">
                @foreach(App\Language::orderBy('name')->get() as $language)   
                    @if($language->active == 1)
                        <a data-toggle="tab" href="#{{$language->code}}-tab" class="nav-item nav-link active">
                            <img src="{{url('/assets')}}/img/flags/png/{{$language->code}}.png">
                        {{$language->name}} 
                        </a>
                    @else
                        <a data-toggle="tab" href="#{{$language->code}}-tab" class="nav-item nav-link">
                            <img src="{{url('/assets')}}/img/flags/png/{{$language->code}}.png">
                            {{$language->name}} 
                        </a>
                    @endif
                @endforeach
            </ul>

            <div class="tab-content" style="margin-top: 25px;">
                @foreach(App\Language::orderBy('name')->get() as $language)   
                    @if($language->active == 1)
                        <div id="{{$language->code}}-tab" class="tab-pane fade in active show">
                            <div>
                                <div class="sl-page-title" style="margin-bottom: 0px!important;">
                                    <div style="text-align: right;">
                                        <a class="btn btn-primary mb-3" href="{{url('/module')}}/{{$module->id}}/language/{{$language->id}}/translation/create">
                                            Add translation
                                        </a>
                                    </div>
                                </div>

                                <div class="card mb-2">
                                    <table id="datatable1" class="table display responsive nowrap data-table">
                                        <thead>
                                            <tr>
                                                <th class="translation-item">
                                                    Item
                                                </th>
                                                <th class="translation-value">
                                                    Translation
                                                </th>
                                                <th class="translation-option">
                                                    
                                                </th>
                                                <th class="translation-option">
                                                    
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($items as $item)
                                            @foreach($item->translation as $translation)
                                                @if($translation->id_item == $item->id)
                                                    @if($translation->id_language == $language->id)
                                                        <tr>
                                                            <td class="translation-item">
                                                                {{$item->name}}
                                                            </td>
                                                            <td class="translation-value">
                                                                {{$translation->value}}
                                                            </td>
                                                                
                                                            <td class="translation-option">
                                                                <a href="{{url('/modules')}}/{{$module->id}}/translation/{{$translation->id}}/edit">Edit</a>
                                                            </td>
                                                            <td class="translation-option">
                                                                <form action="{{url('/modules')}}/{{$module->id}}/translation/delete" method="post" class="form-delete">
                                                                    {{ csrf_field() }}

                                                                    <input type="hidden" value="{{$translation->id}}" name="id">
                                                                    <button class="btn-delete" Onclick="return ConfirmDelete();" style="color: red;" type="submit">Delete</button>
                                                                </form> 
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @else
                        <div id="{{$language->code}}-tab" class="tab-pane fade in">
                            <div>
                                <div class="sl-page-title" style="margin-bottom: 0px!important;">
                                    <div style="text-align: right;">
                                        <a class="btn btn-primary mb-3" href="{{url('/module')}}/{{$module->id}}/language/{{$language->id}}/translation/create">
                                            Add translation
                                        </a>
                                    </div>
                                </div>

                                <div class="card mb-2">
                                    <table id="datatable1" class="table display responsive nowrap data-table">
                                        <thead>
                                            <tr>
                                                <th class="translation-item">
                                                    Item
                                                </th>
                                                <th class="translation-value">
                                                    Translation
                                                </th>
                                                <th class="translation-option">
                                                    
                                                </th>
                                                <th class="translation-option">
                                                    
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($items as $item)
                                            @foreach($item->translation as $translation)
                                                @if($translation->id_item == $item->id)
                                                    @if($translation->id_language == $language->id)
                                                        <tr>
                                                            <td class="translation-item">
                                                                {{$item->name}}
                                                            </td>
                                                            <td class="translation-value">
                                                                {{$translation->value}}
                                                            </td>
                                                                
                                                            <td class="translation-option">
                                                                <a href="{{url('/modules')}}/{{$module->id}}/translation/{{$translation->id}}/edit">Edit</a>
                                                            </td>
                                                            <td class="translation-option">
                                                                <form action="{{url('/modules')}}/{{$module->id}}/translation/delete" method="post" class="form-delete">
                                                                    {{ csrf_field() }}

                                                                    <input type="hidden" value="{{$translation->id}}" name="id">
                                                                    <button  class="btn-delete" Onclick="return ConfirmDelete();" style="color: red;" type="submit">Delete</button>
                                                                </form> 
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

    </div>

@endsection



@section('scripts')
    <script type="text/javascript">
        $('#myTab a:first').tab('show')

        $('#myTab a').on('click', function (e) {
          e.preventDefault()
          $(this).tab('show')
        })

        hljs.initHighlightingOnLoad();
    </script>
@endsection