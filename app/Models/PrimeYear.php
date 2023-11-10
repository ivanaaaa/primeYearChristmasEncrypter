<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimeYear extends Model
{
    use HasFactory;

    protected $table = 'prime_years';
    protected $primaryKey = 'id';
    protected $fillable = ['year', 'day'];

    protected $casts = [
        'day' => 'encrypted',
    ];

    /**
     * Fetches the 30 most recent prime years before the provided input year.
     *
     * @param int $inputYear
     * @return array
     */
    public function getPrimeYears(int $inputYear)
    {
        $primeYears = [];
        $count = 0;

        for ($year = $inputYear; $count < 30; $year--) {
            if ($this->isPrime($year)) {
                $primeYears[] = $year;
                $count++;
            }
        }

        return $primeYears;
    }

    /**
     * Checks if the year is prime
     *
     * @param int $year
     * @return bool
     */
    private function isPrime(int $year)
    {
        if ($year <= 1) {
            return false;
        }

        for ($i = 2; $i * $i <= $year; $i++) {
            if ($year % $i == 0) {
                return false;
            }
        }

        return true;
    }

    /**
     * Determines the day of the week for Christmas on a given year.
     *
     * @param int $year
     * @return string
     */
    public function getChristmasDay(int $year)
    {
        return Carbon::createFromDate($year, 12, 25)->format('l');
    }

}
