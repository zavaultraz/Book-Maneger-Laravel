<div class="container mt-5">
    <div class="row">
        <!-- Category Table -->
        <div class="col-md-6">
            <h2>Category</h2>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Category Name</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($category as $category)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $category->name }}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Place Table -->
        <div class="col-md-6">
            <h2>Places</h2>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Place Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($place as $place)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $place->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>