<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
    div.dataTables_wrapper div.dataTables_paginate {
      display: none;
    }

    a.bg-a{
      text-decoration: none;
      color: black;
      padding: 5px;
      border-radius: 9px;
      background: grey;
      border: 1px solid;
    }

    .card-header.py-3 {
      margin-bottom: 20px;
    }

    form {
      display: inline-table;
    }

    .zoom {
      transition: transform .2s;
      /* Animation */
    }

    .zoom:hover {
      transform: scale(1.3);
    }

    img.img-fluid.zoom {
      width: 200px;
    }

    table#banner-dataTable {
      text-align: center;
    }
  </style>

</head>

<body>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="row">
      <div class="col-md-12">
      </div>
    </div>
    <div class="card-header py-3">
      <h1 class="m-0 font-weight-bold text-primary float-left">Category List</h1>
      <h3 class="m-0 font-weight-bold text-primary float-left">UserName: <span>{{Auth::user()->name}}</span>&emsp;
        <?php echo "<a href = http://localhost/TT_Tuan1/public/logout class = bg-a>Logout</a>"; ?></h3>
      <a href="{{route('catelory.create')}}" class="bg-a" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Category</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">

        <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Title</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
            @foreach($banners as $banner)
            <tr>
              <td>{{$banner->id}}</td>
              <td>{{$banner->title}}</td>
              <td>{{$banner->description}}</td>
              <td>

                <form method="POST" action="{{route('catelory.destroy',[$banner->id])}}">
                  @csrf
                  @method('delete')
                  <button class="btn btn-danger btn-sm dltBtn" data-id={{$banner->id}}>Xóa</button>
                </form>

                <form method="GET" action="{{route('catelory.edit',$banner->id)}}">
                  @csrf
                  @method('put')
                  <button class="btn btn-danger btn-sm dltBtn" data-id={{$banner->id}}>Sữa</button>
                </form>
              </td>



      </div>
      </tr>
      @endforeach
      </tbody>

      </table>

    </div>
  </div>

</body>
<!-- Page level plugins -->
<script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
<script>
  $('#banner-dataTable').DataTable({
    "columnDefs": [{
      "orderable": false,
      "targets": [3, 4, 5]
    }]
  });

  // Sweet alert

  function deleteData(id) {

  }
</script>
<script>
  $(document).ready(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('.dltBtn').click(function(e) {
      var form = $(this).closest('form');
      var dataID = $(this).data('id');
      // alert(dataID);
      e.preventDefault();
      swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this data!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            form.submit();
          } else {
            swal("Your data is safe!");
          }
        });
    })
  })
</script>

</html>