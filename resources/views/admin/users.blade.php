@extends('layouts.app')

@section('title', 'Kelola Pengguna')

@section('content')
    <style>

        .main-content {
            margin-left: 280px;
            padding: 2rem;
        }


        @media (max-width: 1024px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }
</style>

@endsection