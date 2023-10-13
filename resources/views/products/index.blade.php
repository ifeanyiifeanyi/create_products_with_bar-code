<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.bootstrap4.min.css ') }}">
</head>

<body>
    <div class="container mt-5">
        @if (session()->has('status'))
            <div class="alert alert-success">
                {{ session()->get('status') }}
            </div>
        @endif

        <div class="table-responsive" id="table-view">
            @if ($products->count())
                <a href="{{ route('product.create') }}" id="deleteAllSelectedRecords"
                    class="btn btn-danger btn-sm mb-2">Delete selected</a>
                <a href="{{ route('product.pdf') }}" class="btn btn-outline-info btn-sm mb-2">print PDF</a>

                <a href="{{ route('product.create') }}" class="btn btn-outline-primary btn-sm mb-2">Add new</a>
            @else
                <h4 class="alert-heading">No products ...</h4>
                <a href="{{ route('product.create') }}" class="btn btn-primary btn-bg mb-2">Add new product</a>
            @endif

            @if ($products->count())
                <table id="example1" class="table table-striped table-hover table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th scope="col"><input type="checkbox" name="select_all_ids" id="select_all_ids" /></th>
                            <th scope="col">s/n</th>
                            <th scope="col">Title</th>
                            <th scope="col">Price</th>
                            <th scope="col">Barcode</th>

                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr id="product_ids{{ $product->id }}">
                                <th scope="col"><input type="checkbox" id="ids" class="checkbox_ids"
                                        name="ids" value="{{ $product->id }}" /></th>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->price }}</td>
                                <td class="p-3 text-center">
                                    <center>
                                        {!! '<img src="data:image/png;base64,' .
                                            DNS1D::getBarcodePNG($product->product_code, 'PHARMA', 1.15, 23) .
                                            '" alt="barcode"   />' !!}
                                        <br>
                                        <b>{{ $product->product_code }}</b>
                                        <br>
                                    </center>
                                </td>
                                <td>
                                    <a href="{{ route('product.edit', $product) }}" class="btn btn-primary">edit</a>
                                    <a href="{{ route('product.destroy', $product) }}"
                                        onClick="return confirm('Are you sure')" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            @else
            @endif

        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>



    <!-- DataTables  & Plugins -->
    <script src="{{ asset('') }}assets/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('') }}assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}assets/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('') }}assets/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}assets/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('') }}assets/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}assets/js/jszip.min.js"></script>
    <script src="{{ asset('') }}assets/js/pdfmake.min.js"></script>
    <script src="{{ asset('') }}assets/js/vfs_fonts.js"></script>
    <script src="{{ asset('') }}assets/js/buttons.html5.min.js"></script>
    <script src="{{ asset('') }}assets/js/buttons.print.min.js"></script>
    <script src="{{ asset('') }}assets/js/buttons.colVis.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#select_all_ids").click(function() {
                $(".checkbox_ids").prop('checked', $(this).prop("checked"));
            });

            $("#deleteAllSelectedRecords").click(function(e) {
                e.preventDefault();
                var all_ids = [];
                $('input:checkbox[name=ids]:checked').each(function() {
                    all_ids.push($(this).val());
                });

                $.ajax({
                    url: "{{ route('product.delete.all') }}",
                    type: "DELETE",
                    data: {
                        ids: all_ids,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $.each(all_ids, function(key, val) {
                            $("#product_ids" + val).remove();
                        })
                        window.location.href = "{{ route('product.name') }}"
                    }
                })
            })
        })
    </script>
</body>

</html>
