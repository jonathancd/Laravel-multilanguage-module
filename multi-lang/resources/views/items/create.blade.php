@extends('template')

@section('page_name')
    <span class="breadcrumb-item active">{{$module->name}} - Create Item</span>
@endsection


<style type="text/css">
    .form-content{
        width: 100%;
    }
</style>



@section('content')
    
    @if (session('status'))
        <div class="row">
            <div class="alert alert-dark">
                {{ session('status') }}
            </div>
        </div>
    @endif
    

    <div>
        <div class="row">        

          <form action="{{url('/modules/item')}}" method="post" class="form-content fadeIn animated">
            {{ csrf_field() }}
            <input type="hidden" name="module" value="{{$module->id}}">
            <div class="bg-gray-200">
                <div class="card-body">
                    <div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control"  value="{{ old('name') }}" placeholder="Example: home_title">

                                    <span class="text-danger" style="font-size: 13px;">{{ $errors->first('name') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" name="description" class="form-control"  value="{{ old('description') }}" >

                                    <span class="text-danger" style="font-size: 13px;">{{ $errors->first('description') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <br>
                                <button id="btn-continue-auth" class="btn btn-primary">Save  </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
          </div>

        </div>    
    </div>

@endsection