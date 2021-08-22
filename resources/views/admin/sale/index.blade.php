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
    width: 10%;
  }

  .card-body thead tr th:nth-child(3) {
    width: 15%;
  }

  .card-body thead tr th:nth-child(4) {
    width: 10%;
  }

  .card-body thead tr th:nth-child(5) {
    width: 10%;
  }

  .card-body thead tr th:nth-child(6) {
    width: 10%;
  }

    img {
      max-width: 100%;
      height: auto;
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
          <h1>Thống Kê Doanh Số</h1>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <form method="get" action="">
      <div class="row">
        <div class="col-3">
         <div class="form-group">
          <div class="input-group md-form form-sm form-2 pl-0">
            <input value="{{$product_name}}" id="product_name" name="product_name" class="form-control my-0 py-1 amber-border" type="text" placeholder="Tên sản phẩm...">
          </div>
        </div>
      </div>

      <div class="col-2">
        <select name="sort_quantity" class="form-control">
          <option>--Số lượng bán--</option>
          <option
          @if ($sort_quantity == "desc")
           {{"selected"}}
          @endif
           value="desc">Giảm Dần
         </option>

         <option
          @if ($sort_quantity == "acs")
            {{"selected"}}
          @endif
           value="asc">Tăng Dần
         </option>
        </select>
      </div>

      <div class="col-3">
         <div class="form-group">
          <div class="input-group md-form form-sm form-2 pl-0">
              <label>Từ &nbsp</label>
            <input value="{{$time_start}}" type="date" name="time_start" class="form-control my-0 py-1 amber-border" type="text" >
          </div>
        </div>
      </div>

      <div class="col-3">
         <div class="form-group">
          <div class="input-group md-form form-sm form-2 pl-0">
              <label>Đến &nbsp</label>
            <input value="{{$time_end}}" type="date" name="time_end" class="form-control my-0 py-1 amber-border" type="text" >
          </div>
        </div>
      </div>



      <div class="col-1">
        <button style="width: 100%" class="btn btn-success">Tìm</button>
      </div>
    </div>
  </form>

    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Danh sách</h3>
              <div id="message"></div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Trạng Thái Đơn Hàng</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Số Lượng Bán</th>
                    <th>Giá Bán Đơn Vị</th>
                  </tr>
                </thead>
                <tbody id="data">
                  @foreach ($saleList as $sale)
                  <tr>
                    <td>{{++$index}}</td>
                    <td>{{$sale->order_status_name}}</td>
                    <td>{{$sale->product_name}}</td>
                    <td><img src="{{asset($sale->product_image)}}"></td>
                    <td>{{$sale->sale_quantity}}</td>
                     <td>{{number_format($sale->product_price, 0, '', '.')}}</td>
                  </tr>
                  @endforeach
                  
                </tbody>
              </table>
               <div style="margin-top: 10px">{{ $saleList->appends($_GET)->links() }}</div>
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



  
</script>
@stop





