@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Comments</h3></div>
                    <div class="panel-heading">Page {{ $comments->currentPage() }} of {{ $comments->lastPage() }}</div>
                    @foreach ($comments as $comment)
                        <div class="panel-body">
                            <li style="list-style-type:disc">
                                <a href="{{ route('comments.show', $comment->id ) }}"><b>{{ $comment->body }}</b><br>
                                   
                                </a>
                            </li>
                        </div>
                    @endforeach
                    </div>
                    <div class="text-center">
                        {!! $comments->links() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection