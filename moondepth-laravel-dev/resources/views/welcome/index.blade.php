@extends('layouts.app')

@section('content')
<div class="container pb-5">
    <div class="d-flex justify-content-center">
        <h1><strong>Welcome fellow man</strong></h1>
    </div>
</div>
<div class="container text-center">
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-4">
            <h2><i>Big Board:</i></h2><br/>
            <a href="{{ route('board.show', ['board' => $big_board->headline]) }}" class="text-primary">/{{ $big_board->headline }}/ - {{ $big_board->description }}</a>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4">
            <h2><i>Best board:</i></h2><br/>
            <a href="{{ route('board.show', ['board' => $best_board->headline]) }}" class="text-primary">/{{ $best_board->headline }}/ - {{ $best_board->description }}</a>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4">
            <h2><i>Your board:</i></h2><br/>
            <a href="{{ route('board.show', ['board' => $random_board->headline]) }}" class="text-primary">/{{ $random_board->headline }}/ - {{ $random_board->description }}</a>
        </div>
    </div>
</div>
@endsection
