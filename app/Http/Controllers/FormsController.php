<?php

namespace App\Http\Controllers;

use App\Traits\RedisTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FormsController extends Controller
{
    use RedisTrait;

    public function index()
    {
        return view('form.index', [
            'sumOfNumbers' => $this->getArrayFromRedis('sumOfNumbers'),
            'messages' => $this->getArrayFromRedis('messages')
        ]);
    }

    public function addTextToList(Request $request)
    {
        try {
            $request->validate([
                'message' => 'required|string|min:3|max:250',
            ]);

            $message = (string) $request->get('message');
            $this->pushToArrayInRedis('messages', [$message]);

            return redirect()
                ->action([FormsController::class, 'index'])
                ->with('addTextToListStatus', "Dodano wiadomość do listy");

        } catch (\ErrorException $ex) {
            Log::error($ex->getMessage());
            return redirect()
                ->action([FormsController::class, 'index'])
                ->with('appError', "Wystąpił nieoczekiwany błąd");
        }
    }

    public function sumOfNumbers(Request $request)
    {
        try {
            $request->validate([
                'firstNumber' => 'required|integer|min:1|max:9999',
                'secondNumber' => 'required|integer|min:1|max:9999'
            ]);

            $firstNumber = (int) $request->get('firstNumber', 0);
            $secondNumber = (int) $request->get('secondNumber', 0);
            $sumOfNumbers = $firstNumber + $secondNumber;

            $this->setNewArrayToRedis('sumOfNumbers', [
                'firstNumber' => $firstNumber,
                'secondNumber' => $secondNumber,
                'sumOfNumbers' => $sumOfNumbers
            ]);

            return redirect()
                ->action([FormsController::class, 'index'])
                ->with('sumOfNumbersStatus', "Dodano liczby {$firstNumber} i {$secondNumber}");

        } catch (\ErrorException $ex) {
            Log::error($ex->getMessage());
            return redirect()
                ->action([FormsController::class, 'index'])
                ->with('appError', "Wystąpił nieoczekiwany błąd");
        }
    }
}
