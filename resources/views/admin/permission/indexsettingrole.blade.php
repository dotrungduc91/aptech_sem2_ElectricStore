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
          <h1>Cài Đặt Phân Quyền</h1>
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
                  <th>Tên Route</th>
                  <th>Mô Tả</th>
                  <th>Trạng Thái</th>
                </tr>
              </thead>
              <tbody id="data">
                @foreach ($list as $item)
                <tr>
                  <td>{{++$count}}</td>
                  <td>{{$item['route_name']}}</td>
                  <td>{{$item['route_title']}}</td>
                  <td>
                    <select class="form-control" onchange="updatePermission(this, {{$item['route_id']}}, {{$role_id}})">
                      <option value="0" 
                      {{ $item['status']==0?'selected':'' }}>Không Kích Hoạt
                    </option>
                      <option value="1" 
                      {{ $item['status']==1?'selected':'' }}>Kích Hoạt
                    </option>
                    </select>
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>
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

function updatePermission(that, route_id, role_id){

  var status = $(that).val();
  $.post("{{route('update_permisson')}}", {
      '_token': '{{ csrf_token() }}',
      'route_id': route_id,
      'role_id': role_id,
      'status': status
  }, function(res){
    alert(res);
    location.reload();
  })

}




</script>
@stop





