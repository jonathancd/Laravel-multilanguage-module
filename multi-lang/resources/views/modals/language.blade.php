
<div class="modal fade" id="language-modal" tabindex="-1" role="dialog" aria-labelledby="languageShortModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <form  action="{{url('/languages/update')}}" method="post">
        {{ csrf_field() }}
        
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change project language</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <div class="form-group">
              <label>Select the language</label>
              <select name="language" class="form-control">
                @foreach(App\Language::all() as $language)
                  @if($language->active == 1)
                    <option value="{{$language->id}}" selected>{{$language->name}}</option>
                  @else
                    <option value="{{$language->id}}">{{$language->name}}</option>
                  @endif
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>

    </div>
  </div>
</div>

  