@extends('layout')

@section('content')
    <div class="container">
        <h1>Informations sur les bornes</h1>
        <div class="interval">
            <select class="select" name="interval" id="intervalSelect">
                <option value="30">30 secondes</option>
                <option value="60">1 minute</option>
                <option value="300">5 minutes</option>
                <option value="900" selected>15 minutes</option>
                <option value="3600">1 heure</option>
                <option value="10800">3 heures</option>
                <option value="21600">6 heures</option>
                <option value="43200">12 heures</option>
                <option value="86400">1 jour</option>
            </select>
            <label for="interval">Interval de temps</label>
        </div>

        <canvas id="myChart" width="400" height="400"  aria-label="Informations sur les bornes" role="img"></canvas>
    </div>
@endsection