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
      width: 15%;
    }

        .card-body thead tr th:nth-child(3) {
      width: 15%;
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
          <h1>Thống Kê Thương Hiệu</h1>
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
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên Thương Hiệu</th>
                    <th colspan="2">Sửa Hoặc Xóa</th>
                  </tr>
                </thead>
                <tbody id="data">
                  @php
                    $count = 0;
                  @endphp
                  @foreach ($brandList as $brand)
                  <tr>
                    <td>{{++$count}}</td>
                    <td>{{$brand->name}}</td>
                    <td><a class="btn btn-warning" href="{{route('brand_edit',['id'=>$brand->id])}}">Sửa</a></td>
                    <td><button onclick="deleteBrand({{$brand->id}})" class="btn btn-danger">Xóa</button></td>
                  </tr>
                  @endforeach
                  
                </tbody>
              </table>
                <div style="margin-top: 10px">{{ $brandList->appends($_GET)->links() }}</div>
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


    function deleteBrand(id){
      var option = confirm('Bạn có chắc chắn muốn xóa danh mục sản phẩm này không?')
      if (!option) {
        return
      }

    $.post('{{route('brand_delete')}}', {
      'id': id,
      '_token': '{{csrf_token()}}'
    } , function(res){
        var res = JSON.parse(res);
        alert(res.message);
        location.reload();
      })
    }

  
</script>
@stop





