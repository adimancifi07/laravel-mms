@extends('backend.panel')
@section('title', 'Dashboard')

@push('style')
    <style>
        body {
            background-color: green;
        }
    </style>
@endpush

@section('content')
    <div>

        <br>{{ url()->current() }}
        <br>{{ url('/tentang-kami') }}
        <br>{{ route('post.edit', ['id' => '7']) }}
        <br>{{ url()->query('/posts', ['search' => 'Laravel']) }}
        <br>
        <br>
        <br>
        <br>
        <br>

    </div>
@endsection

@push('script')
    <script type="text/javascript">
        alert('Hello, World!');
    </script>
@endpush
