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

        .card-body thead tr th:nth-child(4) {
      width: 40%;
    }

        .card-body thead tr th:nth-child(5) {
      width: 15%;
    }

    tbody {
      text-align: justify;
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
          <h1>Thống Kê Tin Tức</h1>
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
             <div style="width: 50%"><a style="float: right; width: 50%" class="btn btn-success" href="{{route('news_create')}}">Thêm Mới</a></div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tiêu đề bài viết</th>
                    <th>Ảnh minh họa bài viết</th>
                    <th>Tóm tắt nội bài viết</th>
                    <th colspan="2">Sửa Hoặc Xóa Bài Viết</th>
                  </tr>
                </thead>
                <tbody id="data">
                
                  @foreach ($newsList as $news)
                  <tr>
                    <td>{{++$index}}</td>
                    <td>{{$news->title}}</td>
                    <td><img width="100%" src="{{asset($news->thumnail)}}"></td>
                    <td>{!!$news->short_content!!}</td>
                    <td><a class="btn btn-warning" href="{{route('news_edit',['id'=>$news->id])}}">Sửa</a></td>
                    <td><button onclick="deleteNews({{$news->id}},{{$delete_permission}})" class="btn btn-danger">Xóa</button></td>
                  </tr>
                  @endforeach
                 
                </tbody>
              </table>
               <div style="margin-top: 10px">{{ $newsList->links() }}</div>
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


    function deleteNews(id,delete_permission){

    if (delete_permission == 0) {
      $('#permission_alert').html(`
         <div class="alert alert-danger">Bạn Không Được Thực Hiện Hành Động Xóa</div>
        `)
      return;
    }

      var option = confirm('Bạn có chắc chắn muốn xóa danh mục sản phẩm này không?')
      if (!option) {
        return
      }

    $.post('{{route('news_delete')}}', {
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





