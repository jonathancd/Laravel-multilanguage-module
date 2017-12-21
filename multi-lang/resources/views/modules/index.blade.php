@extends('template')

<style type="text/css">
	.center-content{
		text-align: center;
	}
</style>


@section('content')
    <div class="center-content">
    	
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
                            <a class="btn btn-primary mb-3" href="{{url('/modules/create')}}">
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
                                        <td style="text-align: center; vertical-align: middle;">
                                            <a href="{{url('/modules')}}/{{$module->id}}">
                                                <i class="menu-item-icon icon ion-eye tx-22"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{url('/modules')}}/{{$module->id}}">
                                                {{$module->name}}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{url('/modules')}}/{{
                                            $module->id}}/edit">Edit</a>
                                        </td>
                                        <td>   
                                            <form action="{{url('/module/delete')}}" method="post" class="form-delete">
                                                {{ csrf_field() }}

                                                <input type="hidden" value="{{$module->id}}" name="id">
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

        @include('modals.language')

@endsection
