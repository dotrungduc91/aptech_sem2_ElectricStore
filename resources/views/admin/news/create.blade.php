@extends('admin/layouts/master')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Nhập Thông Tin Bài Viết Tin Tức</h1>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          @if ($errors->any())
          <div class="alert alert-danger">
            @foreach ($errors->all() as $err)
            {{$err}}<br>
            @endforeach
          </div>
          @endif

          @if (session('message'))
          <div class="alert alert-success">
            {{session('message')}}
          </div>
          @endif

          @if (session('err_thumnail'))
          <div class="alert alert-danger">
            {{session('err_thumnail')}}
          </div>
          @endif

          <form enctype="multipart/form-data" method="post" action="{{route('news_store')}}">
            @csrf
            <div class="row">
              <div class="col-5">
                <div class="form-group">
                  <label for="title">Tiêu đề</label>
                  <input name="title" type="text" class="form-control" id="title" placeholder="Nhập tiêu đề bài viết...">
                </div>

                <div for = "thumnail" class="form-group">
                  <label>Hình minh họa</label>
                  <input type="file" name="thumnail" class="form-control" id="thumnail">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Tóm tắt nội dung</label>
                  <textarea placeholder="Nhập tóm tắt nội dung" name="short_content" id="short_content"></textarea>
                </div>
              </div>

              <div class="col-7">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nội dung chi tiết</label>
                  <textarea placeholder="Nhập nội dung chi tiết bài viết" name="content" id="content"></textarea>
                </div>
              </div>
            </div>

            <button style="width: 100%" type="submit" class="btn btn-primary">Lưu Bài Viết</button>
          </form>
        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@stop

@section('js')
<script>
$(document).ready(function() {
    $('#short_content').summernote({
    height: 200,
    callbacks: {
      }
  });
   
  $('#content').summernote({
    height: 450,
    callbacks: {
        onImageUpload: function(files, editor, welEditable) {
            that = $(this);
            for (var i = 0; i < files.length; i++) {
              sendFile(files[i], that);
            }
        }
      }
  });


function sendFile(file, editor, welEditable) {
    data = new FormData();
    data.append("file", file);
     data.append("_token",'{{ csrf_token()}}');
    $.ajax({
      data: data,
      type: "POST",
      url: "{{route('news_sendfile')}}",
      cache: false,
      contentType: false,
      processData: false,
      success: function(res) {
        res = JSON.parse(res);
        if (res.message == 'success') {
          $(that).summernote('insertImage', location.origin+'/'+res.url, '');
        }else{
          alert(res.message);
        }
      }
    });
  }
});
</script>

@stop
