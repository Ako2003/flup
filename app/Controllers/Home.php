<?php

namespace App\Controllers;

use \App\Models\Payment;
use \App\Models\PaymentType;
use \App\Models\Currency;
use CodeIgniter\HTTP\ResponseInterface;


class Home extends BaseController
{
    public function index()
    {
        $payment = new Payment();
        $data = $payment->select('payments.*, payment_types.name AS payment_type_name, currencies.name AS currency_name')
        ->join('payment_types', 'payments.payment_type_id = payment_types.id')
        ->join('currencies', 'payments.currency_id = currencies.id')
        ->findAll();

        // payment type
        $paymentType = new PaymentType();
        $paymentTypeData = $paymentType->findAll();
        
        // currency data
        $currency = new Currency();
        $currencyData = $currency->findAll();

        $income = $payment->selectSum('amount')->where('type', 'Income')->get()->getRow()->amount;
        $expense = $payment->selectSum('amount')->where('type', 'Expense')->get()->getRow()->amount;
        $balance = $income - $expense;


        return view('home', ['data' => $data, 'income' => $income, 'expense' => $expense, 'balance' => $balance, 'paymentTypeData' => $paymentTypeData, 'currencyData' => $currencyData]);
    }

    public function filter(){
        try {
            $payment = new Payment();
            $data = $payment->select('payments.*, payment_types.name AS payment_type_name, currencies.name AS currency_name')
            ->join('payment_types', 'payments.payment_type_id = payment_types.id')
            ->join('currencies', 'payments.currency_id = currencies.id')
            ->where('payment_type_id', $this->request->getVar('payment_type'))
            ->where('currency_id', $this->request->getVar('currency'))
            ->where('type', $this->request->getVar('type'))
            ->findAll();
    
            return 
                $this
                    ->response
                    ->setStatusCode(ResponseInterface::HTTP_OK)
                    ->setJSON($data);
        } catch (\Throwable $th) {
            return 
                $this
                    ->response
                    ->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                    ->setJSON(['message' => 'An error occurred while filtering payments']);
        }
        finally{
            return redirect()->back();
        }
    }
}
