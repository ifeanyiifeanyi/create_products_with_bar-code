<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product | {{ $product->title }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
        <a href="{{ route("product.name") }}" class="btn btn-outline-info mb-2">Back home</a>

                <form action="{{ route("product.update", $product) }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="title">Product Title </label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $product->title) }}">
                        @error("title")
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="title">Product Price </label>
                        <input type="text" name="price" class="form-control" value="{{ old('price', $product->price) }}">
                        @error("price")
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="title">Product Description</label>
                        <textarea name="description" id="" cols="30" rows="10" class="form-control">{{ old('description', $product->description) }}</textarea>
                        @error("description")
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-outline-info btn-block">Update</button>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
        
    </div>

</body>

</html>
