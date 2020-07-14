@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm card p-4">
                <h3>{{ $project["projectName"] }}</h3>
                <figure><img width="200em" height="200em" src="{{ asset('images/coolbuilding.jpg') }}"></figure>
                <p>Type: {{ $project["type"] }}</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ad aliquid asperiores
                    aspernatur atque beatae culpa delectus dolorem doloribus earum eum excepturi facilis illum impedit
                    inventore, ipsam, itaque laudantium molestias natus necessitatibus obcaecati odio omnis perspiciatis
                    praesentium provident quod reiciendis rem reprehenderit similique temporibus ullam unde ut velit
                    vitae voluptatum.</p>
            </div>
            <div class="col-sm card p-4">
                <h3>Information</h3>
                <ul>
                    <li>Location:<br>
                        {{ $project["address1"] }}<br>
                        {{ $project["address2"] }}</li>
                    <li>Measuring State</li>
                    <li>Material list</li>
                    <li>Surface</li>
                    <li>Plans</li>
                    <li>Pictures</li>
                </ul>
            </div>
            <div class="col-sm card p-4">
                <h3>Material Streams</h3>
                <ul>
                    <li>Stone</li>
                    <li>Wood</li>
                    <li>Synthetic material</li>
                    <li>Glass</li>
                    <li>Bitumen</li>
                    <li>Metals</li>
                    <li>Soil</li>
                    <li>Isolation</li>
                    <li>Plaster</li>
                    <li>CellConcrete</li>
                    <li>Remainder</li>
                </ul>
            </div>
                <div class="col-sm card p-4">

                    <h3>Waste Streams</h3>
                    <ul>
                        <li>Stone</li>
                        <li>Wood</li>
                        <li>Synthetic material</li>
                        <li>Glass</li>
                        <li>Bitumen</li>
                        <li>Metals</li>
                        <li>Soil</li>
                        <li>Isolation</li>
                        <li>Plaster</li>
                        <li>CellConcrete</li>
                        <li>Remainder</li>
                    </ul>

                </div>
            </div>
        </div>
@endsection
