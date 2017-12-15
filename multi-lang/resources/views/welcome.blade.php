@extends('template')

<style type="text/css">
	.actual-language{
		margin-top: 25px;
	}
	.center-content{
		text-align: center;
	}
	.project-logo{
		max-height: 250px;
	}

</style>


@section('content')
    <div class="center-content">
    
    	<p class="actual-language" data-toggle="modal" data-target="#language-modal">
    		Current language:  
    		@if(getLocalLanguage())
    			<span>
    				<strong>{{getLocalLanguage()->name}}</strong>
    				<img src="{{url('/assets')}}/img/flags/png/{{getLocalLanguage()->code}}.png">
    			</span>
    		@endif
    	</p>
    	
    	@if (session('status'))
	        <div class="alert alert-dark">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
	            {{ session('status') }}
	        </div>
	    @endif

    </div>


    <div style="margin-top:25px;">
        <div class="row">        
            <div style="width: 100%;">
                <div class="col-md-12">
                    <div class="sl-page-title" style="margin-bottom: 0px!important;">
                        <h5>Languages</h5>
                        <div style="text-align: right;">
                            <a class="btn btn-primary" href="{{url('/languages/create')}}">
                                Add Language
                            </a>
                        </div>
                    </div>

                    <div class="card mb-2">
                        <table id="datatable1" class="table display responsive nowrap data-table">
                            <thead>
                                <tr>
                                    <th>
                                        Active
                                    </th>
                                    <th>
                                        Flag
                                    </th>
                                    <th>
                                        Iso
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Language::orderBy('name')->get() as $language)
                                    <tr>
                                        <td>
                                            @if($language->active == 1)
                                                Active
                                            @endif
                                        </td>
                                        <td>
                                            <img src="{{url('/assets')}}/img/flags/png/{{$language->code}}.png">
                                        </td>
                                        <td>
                                            {{$language->code}}
                                        </td>
                                        <td>
                                            {{$language->name}}
                                        </td>
                                        <td>
                                            @if($language->active == 0)
                                                <form action="{{url('/language/activate')}}" method="post" >
                                                    {{ csrf_field() }}

                                                    <input type="hidden" value="{{$language->id}}" name="language">
                                                    <button class="table-btn" style="color: blue;" type="submit">Activate</button>
                                                </form>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('/languages')}}/{{
                                            $language->id}}/edit">Edit</a>
                                        </td>
                                        <td>   
                                            <form action="{{url('/language/delete')}}" method="post" >
                                                {{ csrf_field() }}

                                                <input type="hidden" value="{{$language->id}}" name="id">
                                                <button class="table-btn" Onclick="return ConfirmDelete();" style="color: red;" type="submit">Delete</button>
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



    <div style="margin-top:25px;">
        <div class="row">        
            <div style="width: 100%;">
                <div class="col-md-12">
                    <div class="sl-page-title" style="margin-bottom: 0px!important;">
                        <h5>Modules</h5>
                        <div style="text-align: right;">
                            <a class="btn btn-primary" href="{{url('/modules/create')}}">
                                Add Module
                            </a>
                        </div>
                    </div>

                    <div class="card mb-2">
                        <table id="datatable1" class="table display responsive nowrap data-table">
                            <thead>
                                <tr>
                                    <th style="width: 50px;"></th>
                                    <th>
                                        Name
                                    </th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Module::orderBy('name')->get() as $module)
                                    <tr>
                                        <td style="text-align: center;">
                                            <a href="{{url('/modules')}}/{{$module->id}}">
                                                <i class="menu-item-icon icon ion-eye tx-22"></i>
                                            </a>
                                        </td>
                                        <td>
                                            {{$module->name}}
                                        </td>
                                        <td>
                                            <a href="{{url('/modules')}}/{{
                                            $module->id}}/edit">Edit</a>
                                        </td>
                                        <td>   
                                            <form action="{{url('/module/delete')}}" method="post" >
                                                {{ csrf_field() }}

                                                <input type="hidden" value="{{$module->id}}" name="id">
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

        @include('modals.language')

@endsection
