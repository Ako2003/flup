<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\Payment as PaymentModel;

class Payment extends BaseController
{
    public function index()
    {
        return view('payment');
    }

    public function get()
    {
        $payment = new PaymentModel();
        $data = $payment->findAll();
        return
            $this
                ->response
                ->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON($data);
    }

    public function add()
    {
        try {
            $payment = new PaymentModel();
            $saved = $payment->save([
                'payment_type_id' => $this->request->getVar('payment_type_id'),
                'currency_id' => $this->request->getVar('currency_id'),
                'amount' => $this->request->getVar('amount'),
                'type' => $this->request->getVar('type'),
                'feedback' => $this->request->getVar('feedback')
            ]);

            if (!$saved) {
                return
                    $this
                        ->response
                        ->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                        ->setJSON(['message' => 'An error occurred while adding payment']);
            }

            
            return
                $this
                    ->response
                    ->setStatusCode(ResponseInterface::HTTP_CREATED)
                    ->setJSON(['message' => 'Payment added successfully']);
        } catch (\Exception $e) {
            return
                $this
                    ->response
                    ->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                    ->setJSON(['message' => 'An error occurred while adding payment']);
        }
        finally {
            return redirect()->back();
        }
    }
}
