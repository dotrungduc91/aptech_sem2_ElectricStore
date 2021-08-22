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
    width: 75%;
  }

  .card-body thead tr th:nth-child(3) {
    width: 20%;
  }
  .card-title{
    width: 100%;
    display: flex;
    padding: 5px 0px;
  }

  .card-title div:nth-child(1){
    width: 20%;
  }
  .card-title div:nth-child(2){
    width: 10%;
  }
  .card-title div:nth-child(3){
    width: 10%;
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
          <h1>Thống Kê Danh Mục Sản Phẩm</h1>
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
             <div style="width: 50%"><a style="float: right; width: 50%" class="btn btn-success" href="{{route('category_create')}}">Thêm Mới</a></div>
            </div>
            <!-- /.card-header -->
            <div id ="data" class="card-body">
              @foreach ($categoryParentList as $categoryParent)

              <div class="card">
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="text-align: left!important;" colspan="2">{{$categoryParent->name}}</th>
                        <th> <a class="btn btn-warning" href="{{route('category_edit',['id'=>$categoryParent->id])}}">Sửa</a></th>
                        <th><button onclick="deleteCategory({{$categoryParent->id}},{{$delete_permission}})" class="btn btn-danger">Xóa</button></th>
                      </tr>
                      <tr>
                        <th>STT</th>
                        <th>Tên Danh Mục</th>
                        <th colspan="2">Sửa Hoặc Xóa Danh Mục</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                      $count = 0;
                      @endphp
                      @foreach ($categoryChildList as $categoryChild)
                      @if ($categoryParent->id == $categoryChild->parent_id)
                      <tr>
                        <td>{{++$count}}</td>
                        <td>{{$categoryChild->name}}</td>
                        <td><a class="btn btn-warning" href="{{route('category_edit',['id'=>$categoryChild->id])}}">Sửa</a></td>
                        <td><button onclick="deleteCategory({{$categoryChild->id}},{{$delete_permission}})" class="btn btn-danger">Xóa</button></td>
                      </tr>
                      @endif   
                      @endforeach

                    </tbody>
                  </table>
                </div>
              </div>
              @endforeach
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


    function deleteCategory(id,delete_permission){
     if (delete_permission == 0) {
      $('#permission_alert').html(`
         <div class="alert alert-danger">Bạn Không Được Thực Hiện Hành Động Xóa</div>
        `)
      return;
    }
      var option = confirm('Bạn có chắc chắn muốn xóa danh mục sản phẩm này không, toàn bộ các sản phẩm trong danh mục sẽ bị xóa?')
      if (!option) {
        return
      }

    $.post('{{route('category_delete')}}', {
      'id': id,
      '_token': '{{csrf_token()}}'
    } , function(res){
        alert(res);
        location.reload();
      })
    }


  </script>
  @stop





