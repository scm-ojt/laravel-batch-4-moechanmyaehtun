@extends('../layouts/app')



@section('content')
    <section class="sec-index">
        <div class="inner">
            <div class="create-btn1">
                <a href="{{ route('categories.create') }}">Create</a>
            </div>
            <table class="category-index">
                <tr class="cat-ttl">
                    <th>No</th>
                    <th class="name">Name</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th class="action">Action</th>
                </tr>

                @foreach ($categories as $category)
                    <tr>

                        <td>{{ ++$i }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>{{ $category->updated_at }}</td>
                        <td>
                            <div class="btn-div clearfix">
                                <button class="edit-btn"><a href="{{ route('categories.edit', $category->id) }}"
                                        class="edit">
                                        Edit
                                    </a></button>
                                <form class="del-form " action="{{ route('categories.delete', $category->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <input type="submit" class="del-btn" value="Del">
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $categories->links() }}
            @include('flash-message')


        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="/js/app.js"></script>
    </section>
@endsection
