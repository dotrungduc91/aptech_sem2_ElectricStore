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
    width: 10%;
  }

  .card-body thead tr th:nth-child(2) {
    width: 25%;
  }

  .card-body thead tr th:nth-child(3) {
    width: 20%;
  }

    .card-body thead tr th:nth-child(4) {
    width: 15%;
  }

  .card-body thead tr th:nth-child(5) {
    width: 15%;
  }

  .card-body thead tr th:nth-child(6) {
    width: 15%;
  }
  .card-title{
    width: 100%;
    display: flex;
    padding: 5px 0px;
  }



  tbody {
    text-align: center;
  }
  tbody img{
    max-width: 100%;
    height: auto;
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
          <h1>Chi Tiết Đơn Hàng</h1>
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
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Danh sách</h3>
              <div id="message"></div>
            </div>
            <!-- /.card-header -->
            <div id ="data" class="card-body">
            
                <div class="card">
                  <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>STT</th>
                          <th>Tên Sản Phẩm</th>
                           <th>Hình Ảnh</th>
                          <th>Số Lượng</th>
                          <th>Giá Đơn Vị</th>
                          <th>Tổng Tiền</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($orderDetails as $item)
                        <tr>
                          <td>{{++$count}}</td>
                          <td>{{$item->product_name}}</td>
                           <td><img src="{{asset($item->product_image)}}"></td>
                          <td>{{$item->quantity}}</td>
                          <td>{{number_format($item->price)}}</td>
                          <td>{{number_format($item->price * $item->quantity)}}</td>
                        </tr>
                      @endforeach

                    </tbody>
                  </table>
                </div>
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


    function deleteOrder(id){
      var option = confirm('Bạn có chắc chắn muốn xóa danh mục sản phẩm này không?')
      if (!option) {
        return
      }

    $.post('{{route('order.destroy',['order'=>1])}}', {
      'id': id,
      '_token': '{{csrf_token()}}'
    } , function(res){
        alert(res);
        location.reload();
      })
    }


  </script>
  @stop





