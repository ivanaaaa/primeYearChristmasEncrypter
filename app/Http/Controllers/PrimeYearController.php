<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrimeYear;

class PrimeYearController extends Controller
{

    /**
     * @var PrimeYear
     *
     * instance of the PrimeYear model
     */
    protected $primeYear;

    /**
     * PrimeYearController constructor.
     *
     * @param PrimeYear $primeYear
     */
    public function __construct(PrimeYear $primeYear)
    {
        $this->primeYear = $primeYear;
    }

    /**
     * Display the index view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Save Christmas dates based on the provided year and redirect to the index view.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveChristmasDates(Request $request)
    {
        $validatedData = $request->validate([
            'year' => 'required|numeric' // Validates that 'year' is present and a numeric value
        ]);

        $primeYears = $this->primeYear->getPrimeYears($validatedData['year']);

        $christmasDates = [];
        foreach ($primeYears as $year) {
            $christmasDates[] = [
                'year' => $year,
                'day' => $this->primeYear->getChristmasDay($year),
            ];
        }

        // Save the Christmas dates into the database
        foreach ($christmasDates as $date) {
            PrimeYear::firstOrCreate(
                ['year' => $date['year']],
                ['day' => $date['day']]
            );
        }

        // Redirect to the index view and pass the retrieved data
        return redirect()->route('index')->with('success', true);
    }


    /**
     * Retrieve and return Christmas days data from the PrimeYear model as a JSON response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChristmasDays()
    {
        $primeYears = PrimeYear::all();

        $christmasDaysData = $primeYears->map(function ($primeYear) {
            return [
                'year' => $primeYear->year,
                'day' => $primeYear->day,
            ];
        });

        return response()->json($christmasDaysData);
    }

}
