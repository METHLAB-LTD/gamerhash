<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GamerHash - zadanie rekrutacyjne</title>
        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    </head>
    <body>
    <div class="container mt-5 mb-20">
        @if(Session::has('appError'))
            <div class="alert alert-danger text-center">
                {{Session::get('appError')}}
            </div>
        @endif
        @if(Session::has('sumOfNumbersStatus'))
            <div class="alert alert-success text-center">
                {{Session::get('sumOfNumbersStatus')}}
            </div>
        @endif

        @if($sumOfNumbers)
            <div class="alert alert-dark" role="alert">
                Ostatnio obliczono sumę {{ $sumOfNumbers['firstNumber'] }} + {{ $sumOfNumbers['secondNumber'] }} = {{ $sumOfNumbers['sumOfNumbers'] }}
            </div>
        @endif
        <form  method="post" action="{{ route('forms.sumOfNumbers') }}" novalidate>
            @csrf
            <div class="form-group mb-2">
                <label for="firstNumber">Pierwsza liczba</label>
                <input type="number" min="1" max="9999" class="form-control @error('firstNumber') is-invalid @enderror" name="firstNumber" id="firstNumber">

                @error('firstNumber')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-2">
                <label for="secondNumber">Druga liczba</label>
                <input type="number" min="1" max="9999" class="form-control @error('secondNumber') is-invalid @enderror" name="secondNumber" id="secondNumber">

                @error('secondNumber')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="d-grid mt-3">
                <input type="submit" name="send" value="Oblicz sumę" class="btn btn-dark btn-block">
            </div>
        </form>
    </div>
    <div class="container mt-5">
        @if(Session::has('addTextToListStatus'))
            <div class="alert alert-success text-center">
                {{Session::get('addTextToListStatus')}}
            </div>
        @endif

        @if($messages)
            <div class="alert alert-dark" role="alert">
                <ul class="list-group">
                    @foreach ($messages as $message)
                        <li class="list-group-item">{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form  method="post" action="{{ route('forms.addTextToList') }}" novalidate>
                @csrf
                <div class="form-group mb-2">
                    <label for="message">Treść wiadomości</label>
                    <input type="text" minlength="3" maxlength="250" class="form-control @error('message') is-invalid @enderror" name="message" id="message">

                    @error('message')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="d-grid mt-3">
                    <input type="submit" name="send" value="Zapisz wiadomość" class="btn btn-dark btn-block">
                </div>
        </form>
    </div>
    </body>
</html>
