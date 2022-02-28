@extends('products.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>TODO APPLICATION</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Task</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Task</th>
            <th>Details</th>
            <th>Date</th>
            <th>Time</th>
            <th>Timezone</th>
            {{-- <th>Date & Time of Creation</th> --}}
            {{-- <th>Date & Time of Updation</th> --}}
            <th width="280px">Action</th>
        </tr>

        @foreach ($products as $product)

        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->detail }}</td>
            <td>{{ $product->date }}</td>
            <td>{{ $product->time }}</td>
            <td> <script>document.write(Intl.DateTimeFormat().resolvedOptions().timeZone)</script> </td>
            {{-- <td><?php echo date_default_timezone_get();?></td> --}}
            {{-- <td>{{ Timezone::convertToLocal($product->created_at) }}</td> --}}

            {{-- <td>{{ $product->detail }}</td>
            {{-- <td>{{ $product->updated_at }}</td> --}}

            <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>

                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>

        @endforeach
    </table>

    {!! $products->links() !!}

@endsection
