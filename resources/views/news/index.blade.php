@extends('app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">News</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('news.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($news->isEmpty())
                <div class="well text-center">No News found.</div>
            @else
                <table class="table">
                    <thead>
                    <th>Title</th>
			<th>Summary</th>
			<th>Full News</th>
			<th>Publication Date</th>
			<th>Author</th>
			<th>Enable</th>
                    <th width="50px">Action</th>
                    </thead>
                    <tbody>
                     
                    @foreach($news as $news)
                        <tr>
                            <td>{!! $news->title !!}</td>
					<td>{!! $news->summary !!}</td>
					<td>{!! $news->full_news !!}</td>
					<td>{!! $news->publication_date !!}</td>
					<td>{!! $news->author !!}</td>
					<td>{!! $news->enable !!}</td>
                            <td>
                                <a href="{!! route('news.edit', [$news->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{!! route('news.delete', [$news->id]) !!}" onclick="return confirm('Are you sure wants to delete this News?')"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection