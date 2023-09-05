<html>
<head>
    <title>Welcome to My Laravel App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <a href="{{ route("business.create") }}" class="btn btn-primary">Create Business</a>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Logo</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($datas as $data)
        <tr>
            <td>{{ $loop->index }}</td>
            <td>{{ $data->name }}</td>
            <td>{{ $data->email }}</td>
            <td>{{ $data->phone_number }}</td>
            <td><img src="{{ asset('images/logo.png') }}" alt="Logo"></td>
            {{-- <td>{{ $data->logo }}</td> --}}
            <td>
                <a class="btn btn-primary" href="{{ route('branches.index',$data->id) }}" method="POST">Branches</a>
            </td>
        </tr>
        @endforeach
    </table>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</html>



