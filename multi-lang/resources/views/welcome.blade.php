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
    	<img src="{{url('/assets')}}/img/LOGO_HUB_TRIBUTARIO_JPEG.jpg" class="project-logo rounded mx-auto d-block" alt="">

    	<p class="actual-language">
    		Currently language:  
    		@if(getLocalLanguage())
    			<span data-toggle="modal" data-target="#language-modal">
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
                        <h5>Modules</h5>
                        <div style="text-align: right;">
                            <a class="btn btn-primary" href="{{url('/modules/create')}}">
                                Add Module
                            </a>
                        </div>
                    </div>

                    <div class="card pd-20 pd-sm-20 mb-2">
                        <table id="datatable1" class="table display responsive nowrap data-table">
                            <thead>
                                <tr>
                                    <th>
                                        Id
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Module::all() as $module)
                                    <tr>
                                        <td>
                                            {{$module->id}}
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
