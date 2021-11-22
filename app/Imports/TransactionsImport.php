<?php

namespace App\Imports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\ToModel;

class TransactionsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Transaction([
            'name_on_card'     => $row[0],
            'card_no'    => $row[1], 
            'exp_month'    => $row[2], 
            'exp_year'    => $row[3], 
            'cvv'    => $row[4], 
        ]);
    }
}
