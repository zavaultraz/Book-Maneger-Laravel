<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">Book Manager</a>
        </div>
    </nav>
    <div class="container mt-3">
        <div class="row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Category</h5>
                        <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <label for="exampleInputEmail1" class="form-label"></label>
                            <input type="text" class="form-control" id="InputName" name="name" placeholder="category name">
                            <button type="submit" class="mt-3 btn btn-primary">Add Category</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Place</h5>
                        <form action="{{route('place.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <label for="exampleInputEmail1" class="form-label"></label>
                            <input type="text" class="form-control" id="InputPlace" name="name" placeholder="place coordinate">
                            <button type="submit" class="mt-3 btn btn-primary">Add Place</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <h3 class="card-title text-center">Add Books</h3>
                <form action="{{route('book.store')}}" enctype="multipart/form-data" method="post">
                    <label for="InputTitle" class="form-label fs-5 mt-2">Judul Buku</label>
                    <input type="text" class="form-control" id="InputTitle" name="title" placeholder="Book Title">

                    <div class="col-sm-10">
                    <label for="InputTitle" class="form-label fs-5 mt-2">Genre Buku</label>
                        <select class="form-select" name="category_id" aria-label="Default select example">
                            <option selected>--Select Category--</option>
                            @foreach ($category as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>

                            @endforeach
                        </select>
                    </div>

                    <label for="InputTitle" class="form-label fs-5 mt-2">Author</label>
                    <input type="text" class="form-control" id="InputTitle" name="author" placeholder="Book author">

                    <label for="InputTitle" class="form-label fs-5 mt-2">Publisher</label>
                    <input type="text" class="form-control" id="InputTitle" name="publishing" placeholder="Book Publisher">

                    <label for="InputTitle" class="form-label fs-5 mt-2">Edisi Buku</label>
                    <input type="text" class="form-control" id="InputTitle" name="publishing" placeholder="Book Edition">

                    <label for="InputTitle" class="form-label fs-5 mt-2">ISBN</label>
                    <input type="number" class="form-control" id="InputTitle" name="isbn" placeholder="kode isbn">

                    <label for="formFile" class="form-label mt-2 fs-5">Cover</label>
                    <input class="form-control" type="file" id="formFile" name="image">

                    <label for="formFile" class="form-label mt-2 fs-5">Digital Book</label></label>
                    <input class="form-control" type="file" id="formFile" name="pdf">

                    <label for="InputTitle" class="form-label fs-5 mt-2">Lokasi Buku</label>
                        <select class="form-select" name="place_id" aria-label="Default select example">
                            <option selected>--Select Place--</option>
                            @foreach ($place as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>

                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="mt-3 btn btn-primary">Add Book</button>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script>
        //sweetalert for success or error message
        @if(session() -> has('success'))
        swal({
            type: "success",
            icon: "success",
            title: "BERHASIL!",
            text: "{{ session('success') }}",
            timer: 5000,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        });
        @elseif(session() -> has('error'))
        swal({
            type: "error",
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('error') }}",
            timer: 5000,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        });
        @elseif(session() -> has('info'))
        swal({
            type: "info",
            icon: "info",
            title: "INFO!",
            text: "{{ session('info') }}",
            timer: 5000,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        });
        @endif
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>