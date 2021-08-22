@extends('admin/layouts/master')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Nhập Thông Tin Chi Tiết Sản Phẩm</h1>
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

          @if (session('err_image'))
          <div class="alert alert-danger">
            {{session('err_image')}}
          </div>
          @endif

          <form enctype="multipart/form-data" method="post" action="{{route('product_store')}}">
            @csrf
            <div class="row">
              <div class="col-8">


                <div class="form-group">
                  <label for="description">Nhập Nội Dung Bài Giới Thiệu Sản Phẩm</label>
                  <textarea placeholder="Nhập nội dung chi tiết...." name="description" id="description"></textarea>
                </div>
              </div>

              <div class="col-4">


                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="category_parent">Danh Mục</label>
                      <select id="category_parent" value = "" class="form-control" name="categoryparent_id">
                        <option value="">Chọn</option>
                        @foreach ($categoryParentList as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="category_child">Thương Hiệu</label>
                      <select id="category_child" value = "" class="form-control" name="categorychild_id">
                       <option value="">Chọn</option>
                     </select>
                   </div>
                 </div>
               </div> 



              <div class="row">
                <div class="col-8">
                           <div class="form-group">
                <label for="name">Tên Sản Phẩm</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Tên sản phẩm...">
              </div>
              </div>
              <div class="col-4">
               <div class="form-group">
                <label for="quantity_available">Số Lượng</label>
                <input name="quantity_available" type="number" class="form-control" id="quantity_available" placeholder="Số lượng...">
              </div>
            </div>
          </div>

          <div for = "image" class="form-group">
            <label>Hình Ảnh Chính</label>
            <input type="file" name="image" class="form-control" id="image">
          </div>

          <div for = "slide" class="form-group">
            <label>Hình Slide</label>
            <input multiple type="file" name="slide[]" class="form-control" id="slide">
          </div>

          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="price">Giá</label>
                <input name="price" type="number" class="form-control" id="price" placeholder="Giá...">
              </div>
            </div>
            <div class="col-6">

                  <div class="form-group">
                    <label for="price_discount">Giá Discount</label>
                    <input name="price_discount" type="number" class="form-control" id="price_discount" placeholder="Giá discount...">
                  </div>
                </div>
              </div> 

              <div class="form-group">
                <label for="short_description">Các Thông Số Kĩ Thuật (Ví dụ Ram: 4GB....)</label>
                <textarea placeholder="Nhập thông số..." name="short_description" id="short_description"></textarea>
              </div>
            </div>
          </div>
          
          <button style="width: 100%" type="submit" class="btn btn-primary">Lưu Sản Phẩm</button>
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
    $('#short_description').summernote({
    height: 200,
    callbacks: {
      }
  });
   
  $('#description').summernote({
    height: 500,
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
      url: "{{route('product_sendfile')}}",
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


//Fill category child qua Ajax

$("#category_parent").on( "change", function() {
  var id = $("#category_parent").val(); 

  $.post('{{route('get_category_child')}}',{
    'id': id,
    '_token': '{{ csrf_token() }}'

  }, function(res){
    var categoryChildList = JSON.parse(res);
    $("#category_child").html('');

    for (let categoryChild of categoryChildList) {
      $("#category_child").append(`
          <option value="${categoryChild.id}">${categoryChild.name}</option>
      `);
    }
  })
});

</script>

@stop
