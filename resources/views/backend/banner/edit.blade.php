<div class="card">
  <h5 class="card-header">Edit Category</h5>
  <div class="card-body">
    <form method="post" action="{{route('catelory.update',$category->id)}}">
      @csrf
      @method('PATCH')
      <div class="form-group">
        <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="title" placeholder="Enter title" value="{{$category->title}}" class="form-control">
        @error('title')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="inputDesc" class="col-form-label">Description</label>
        <textarea class="form-control" id="description" name="description">{{$category->description}}</textarea>
        @error('description')
        <span class="text-danger">{{$message}}</span>
        @enderror
      </div>



      <div class="form-group mb-3">
        <button type="reset" class="btn btn-warning">Làm mới</button>
        <button class="btn btn-success" type="submit">Lưu</button>
      </div>
    </form>
  </div>
</div>