@extends('admin/layouts/master')
@section('css')
<style type="text/css">
  .card-body thead th {
    text-align: center!important;
  }

  .card-body thead th {
    padding: 5px 5px;
  }

  .card-body thead tr th:nth-child(1) {
    width: 5%;
  }

  .card-body thead tr th:nth-child(2) {
    width: 20%;
  }

  .card-body thead tr th:nth-child(3) {
    width: 10%;
  }

  .card-body thead tr th:nth-child(4) {
    width: 10%;
  }

  .card-body thead tr th:nth-child(5) {
    width: 10%;
  }

  .card-body thead tr th:nth-child(6) {
    width: 15%;
  }

  .card-body thead tr th:nth-child(7) {
    width: 20%;
  }

  .card-body thead tr th:nth-child(8) {
    width: 10%;
  }

  .card-body img {
    max-width: 100%;
    max-height: 150px;
  }

  tbody {
    text-align: center;
  }

</style>
@stop
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Thống Kê Sản Phẩm</h1>
        </div>
      </div>
    </div>

    <!-- Form tim kiem -->
    <form name="search" method="get" action="{{route('product_index')}}">
      <div class="row">
        <div class="col-sm-3">
          <div  class="form-group">
            <select id="category_parent" value = "" class="form-control" name="categoryparent_id">
              <option value="">Danh Mục</option>
              @foreach ($categoryParentList as $item)
              <option
              @if ($categoryparent_id == $item->id)
              {{"selected"}}
              @endif
              value="{{$item->id}}">{{$item->name}}
            </option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <select id="category_child" value = "" class="form-control" name="categorychild_id">
           <option value="">Thương Hiệu</option>

           <!-- Keep lai category con tim kiem -->
           @foreach ($categoryChildList as $item)
           <option
           @if ($categorychild_id == $item->id)
           {{"selected"}}
           @endif
           value="{{$item->id}}">{{$item->name}}
         </option>
         @endforeach
         <!-- Keep lai category con tim kiem End -->
       </select>
     </div>
   </div>

   <div class="col-sm-4">
     <div class="form-group">
      <div class="input-group md-form form-sm form-2 pl-0">
        <input value="{{$product_name}}" id="product_name" name="product_name" class="form-control my-0 py-1 amber-border" type="text" placeholder="Tên sản phẩm muốn tìm..." aria-label="Search">
      </div>
    </div>
  </div>

  <div class="col-sm-2">
   <button style="width: 100%" type="submit" class="btn btn-primary">Tìm sản phẩm</button>
 </div>
</div>
</form>
<!-- Form tim kiem End-->

<!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div id="permission_alert">
        <!-- Nếu không được phan quyền thì hiện ra message thông báo -->
          @if($errors->any())
            <div class="alert alert-danger">{{$errors->first()}}</div>
          @endif
        <!-- Nếu không được phan quyền thì hiện ra message thông báo end -->
        </div>
    
        <div class="card">
            <div class="card-header" style="display: flex;">
            <div style="width: 50%"><h3 class="card-title">Danh sách</h3></div>
             <div style="width: 50%"><a style="float: right; width: 50%" class="btn btn-success" href="{{route('product_create')}}">Thêm Mới</a></div>
            </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Tên Sản Phẩm</th>
                  <th>NSX</th>
                  <th>Giá </th>
                  <th>Giá giảm</th>
                  <th>Số lượng còn</th>
                  <th>Hình ảnh</th>
                  <th colspan="2">Sửa Hoặc Xóa</th>
                </tr>
              </thead>
              <tbody id="data">
                @if (count($productList) > 0)
                @foreach ($productList as $product)
                <tr>
                  <td>{{++$index}}</td>
                  <td>{{$product->name}}</td>
                  <td>{{$product->category_name}}</td>
                  <td>{{number_format($product->price)}}</td>
                  <td>{{number_format($product->price_discount)}}</td>
                  <td>{{number_format($product->quantity_available)}}</td>
                  <td><img  src="{{asset($product->image)}}"></td>
                  <td><a class="btn btn-warning" href="{{route('product_edit',['id'=>$product->id])}}">Sửa</a></td>
                  <td><button onclick="deleteProduct({{$product->id}},{{$delete_permission}})" class="btn btn-danger">Xóa</button></td>
                </tr>
                @endforeach
                @else
                <tr>
                  <td style="color: red" colspan="8">Không Tìm Thấy Sản Phẩm Nào Phù Hợp</td>
                </tr> 
                @endif

              </tbody>
            </table>
            <div style="margin-top: 10px">{{ $productList->appends($_GET)->links() }}</div>
          </div>
          <!-- /.card-body -->

        </div>
      </div>
      <!-- /.col -->
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
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });


  function deleteProduct(id,delete_permission){

      if (delete_permission == 0) {
      $('#permission_alert').html(`
         <div class="alert alert-danger">Bạn Không Được Thực Hiện Hành Động Xóa</div>
        `)
      return;
    }

    var option = confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')
    if (!option) {
      return
    }

    $.post('{{route('product_delete')}}', {
      //Gui id product
      'id': id,
      //Gui id danh muc con và product name sang Controller dang tim kiem de lam dieu kien loc hien thi cac san pham thoa man dieu kien dang tim sau khi xoa
      '_token': '{{csrf_token()}}'
    } , function(res){
      var res = JSON.parse(res);
     alert(res.message);
     location.reload();
   })
  }


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





