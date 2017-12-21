@extends('template')

@section('page_name')
    <span class="breadcrumb-item active">{{$module->name}} - Create Translation</span>
@endsection


<style type="text/css">
    .form-content{
        width: 100%;
    }
</style>



@section('content')
    
    @if (session('status'))
        <div>
            <div class="alert alert-dark">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                {{ session('status') }}
            </div>
        </div>
    @endif
    

    <div>
        <div class="row">        

          <form action="{{url('/translation')}}" method="post" class="form-content fadeIn animated">
            {{ csrf_field() }}
            <input type="hidden" name="language" value="{{$language->id}}">
            <input type="hidden" name="module" value="{{$module->id}}">

            <div class="bg-gray-200">
                <div class="card-body">
                    <div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Language</label>
                                    <img src="{{url('/assets')}}/img/flags/png/{{$language->code}}.png">

                                    <input type="text" name="translation" class="form-control"  value="{{$language->name}}" readOnly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Item</label>
                                    <select name="item" class="form-control">
                                        @foreach(App\Item::where('id_module', $module->id)->get() as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach

                                    </select>
                                    <span class="text-danger" style="font-size: 13px;">{{ $errors->first('item') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Translation</label>
                                    <input type="text" name="translation" class="form-control"  value="{{ old('translation') }}" >

                                    <span class="text-danger" style="font-size: 13px;">{{ $errors->first('translation') }}</span>
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