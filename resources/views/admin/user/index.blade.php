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
          <h1>Thống Kê Tài Khoản Người Dùng</h1>
        </div>
      </div>
    </div>

    <!-- Form tim kiem -->
    <form name="search" method="get" action="">
      <div class="row">
   <div class="col-sm-10">
     <div class="form-group">
      <div class="input-group md-form form-sm form-2 pl-0">
        <input value="{{$user_name}}" id="product_name" name="user_name" class="form-control my-0 py-1 amber-border" type="text" placeholder="Tên người dùng muốn tìm..." aria-label="Search">
      </div>
    </div>
  </div>

  <div class="col-sm-2">
   <button style="width: 100%" type="submit" class="btn btn-success">Tìm</button>
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
                  <th>Họ Và Tên</th>
                  <th>Email</th>
                  <!-- <th>Mật Khẩu</th> -->
                  <th>Đối Tượng Phân Quyền</th>
                  <th>Xóa Tài Khoản</th>
                </tr>
              </thead>
              <tbody id="data">
                @foreach ($userList as $user)
                <tr>
                  <td>{{++$index}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <!-- <td>{{$user->password}}</td> -->
                  <td>
                  <select class="form-control" onchange="updateRole(this,{{$user->id}} )">
                      @foreach ($roleList as $role)
                         <option value="{{$role->id}}" {{$role->id == $user->role_id?'selected':''}}>
                            {{$role->name}}
                         </option>
                      @endforeach
                  </select>
                  </td>
                  <td><button onclick="deleteUser({{$user->id}})" class="btn btn-danger">Xóa</button></td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div style="margin-top: 10px">{{ $userList->appends($_GET)->links() }}</div>
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

      function updateRole(that, user_id){
      var option = confirm('Bạn có chắc chắn muốn sửa cài đặt phân quyền?');
      if (option == false) {
        return
        location.reload();
      }

      var role_id = $(that).val();

      $.post('{{route('role_update')}}', {
      'user_id': user_id,
      'role_id' : role_id,
      '_token': '{{csrf_token()}}'
    } , function(res){
        alert(res);
        location.reload();
      })
    }

    function deleteUser(user_id){
      var option = confirm('Bạn có chắc chắn muốn tài khoản người dùng này không?');
      if (!option) {
        return
      }

      $.post('{{route('users_delete')}}', {
        'user_id': user_id,
        '_token': '{{csrf_token()}}'
      } , function(res){
        alert(res);
        location.reload();
      })

    }




</script>
@stop





