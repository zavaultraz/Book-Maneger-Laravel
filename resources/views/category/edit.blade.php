<div class="modal fade" id="editbook{{$row->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editbook{{$row->id}}">Edit : {{$row->title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            
            <div class="modal-body">
                <form action="{{route('book.update',$row->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <label for="InputTitle" class="form-label fs-5 mt-2">Judul Buku</label>
                    <input type="text" class="form-control" id="InputTitle" name="title" placeholder="Book Title" value="{{$row->title}}">

                    <div class="col-sm-10">
                        <label for="InputTitle" class="form-label fs-5 mt-2">Genre Buku</label>
                        <select class="form-select" name="category_id" aria-label="Default select example">
                            <option selected value="{{$row->category->id}}">{{$row->category->name}}</option>
                            @foreach ($category as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- {{ $row }} -->

                    <label for="InputTitle" class="form-label fs-5 mt-2">Author</label>
                    <input type="text" class="form-control" id="InputTitle" name="author" placeholder="Book author" value="{{$row->author}}">

                    <label for="InputTitle" class="form-label fs-5 mt-2">Publisher</label>
                    <input type="text" class="form-control" id="InputTitle" name="publishing" placeholder="Book Publisher" value="{{$row->publishing}}">

                    <label for="InputTitle" class="form-label fs-5 mt-2">Edisi Buku</label>
                    <input type="text" class="form-control" id="InputTitle" name="edition" placeholder="Book Edition" value="{{$row->edition}}">

                    <label for="InputTitle" class="form-label fs-5 mt-2">ISBN</label>
                    <input type="text" class="form-control" id="InputTitle" name="isbn" placeholder="kode isbn" value="{{$row->isbn}}">

                    <label for="formFile" class="form-label mt-2 fs-5">Cover</label>
                    <input class="form-control" type="file" id="formFile" name="image">

                    <label for="formFile" class="form-label mt-2 fs-5">Digital Book</label></label>
                    <input class="form-control" type="file" id="formFile"  name="pdf">

                    <label for="InputTitle" class="form-label fs-5 mt-2">Lokasi Buku</label>
                    <select class="form-select" name="place_id" aria-label="Default select example">
                        @foreach ($place as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>