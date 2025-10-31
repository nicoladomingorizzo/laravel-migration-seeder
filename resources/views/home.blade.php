@extends('layouts.app')

@section('title', 'Partenze - Tabellone Elettronico')

@section('content')

    <div class="container mt-5 mb-5">
        <h1 class="text-center mb-4">Prossime Partenze</h1>

        <table class="table table-dark table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col">Codice Treno</th>
                    <th scope="col">Azienda</th>
                    <th scope="col">Partenza</th>
                    <th scope="col">Arrivo</th>
                    <th scope="col">Da</th>
                    <th scope="col">A</th>
                    <th scope="col">Stato</th>
                </tr>
            </thead>
            <tbody>
                <!-- Ciclo sui treni passati dal Controller ($trains) -->
                @foreach ($trains as $train)
                    <!-- Applica la classe 'cancelled' se il treno è stato cancellato -->
                    <tr class="{{ $train->is_cancelled ? 'cancelled' : '' }}">
                        <td>{{ $train->train_code }}</td>
                        <td>{{ $train->company }}</td>
                        <!-- Combinazione Data e Ora di Partenza -->
                        <td>
                            {{ \Carbon\Carbon::parse($train->departure_date)->format('d/m') }}
                            <span class="d-block fw-bold">{{ $train->departure_time }}</span>
                        </td>
                        <td>{{ $train->arrival_time }}</td>
                        <td>{{ $train->departure_station }}</td>
                        <td>{{ $train->arrival_station }}</td>
                        <td>
                            @if ($train->is_cancelled)
                                Cancellato
                            @elseif (!$train->is_on_time)
                                <span class="late">In Ritardo</span>
                            @else
                                In Orario
                            @endif
                        </td>
                    </tr>
                @endforeach

                @if ($trains->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center text-secondary py-4">
                            Nessun treno in partenza.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>

        <p class="text-end text-muted fst-italic mt-4">
        </p>

    </div>

@endsection
