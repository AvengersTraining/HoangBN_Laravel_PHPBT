@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <div class="card">
                <div class="card-header">{{ __('Dashboarh') }}</div>

                <div class="card-body">
                    <a href="{{ route('home') }}">{{ __('Home') }}</a>
                </div>
            </div>
        </div>

        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Tag list') }}</div>
                <div class="add-tag">
                    <a href="{{ route('tags.create') }}">Create new tag</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive tag-table-center">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('ID') }}</th>
                                    <th scope="col">{{ __('Tag name') }}</th>
                                    <th scope="col">{{ __('Created at') }}</th>
                                    <th scope="col">{{ __('Updated at') }}</th>
                                    <th scope="col">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tags as $key => $tag) : ?>
                                <tr>
                                    <td>{{ $tag->id }}</td>
                                    <td>{{ $tag->tag_name }}</td>
                                    <td>{{ $tag->created_at }}</td>
                                    <td>{{ $tag->updated_at }}</td>
                                    <td>
                                        <a type="button" href="{{ route('tags.show', $tag->id) }}">Detail</a>
                                        <p class="tag-delete">Delete</p>
                                        <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="confirm-delete">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="row justify-content-center margin-zero">
                            {{ $tags->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
