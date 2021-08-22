@extends('admin/layouts/master')
@section('css')
<style type="text/css">
  .card-body thead th {
    text-align: center!important;
  }

  .card-body thead th {
    padding: 5px 5px;
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
          <h1>Danh Sách Phân Quyền</h1>
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
                  <th>Tên</th>
                  <th>Cài Đặt Chi Tiết</th>
                </tr>
              </thead>
              <tbody id="data">
                @foreach ($roleList as $role)
                <tr>
                  <td>{{++$count}}</td>
                  <td>{{$role->name}}</td>
                  <td><a href="{{route('rolesetting',['id'=>$role->id])}}">Xem chi tiết</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div style="margin-top: 10px">{{ $roleList->appends($_GET)->links() }}</div>
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





