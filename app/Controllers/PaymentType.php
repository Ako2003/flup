<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\PaymentType as PaymentTypeModel;

class PaymentType extends BaseController
{
    public function index()
    {
        return view('payment_type');
    }

    public function get()
    {
        $paymentType = new PaymentTypeModel();
        $data = $paymentType->findAll();
        return
            $this
                ->response
                ->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON($data);
    }

    public function add()
    {
        try{
            $paymentType = new PaymentTypeModel();
            $paymentType->save([
                'name' => $this->request->getVar('payment_type')
            ]);

            return
                $this
                    ->response
                    ->setStatusCode(ResponseInterface::HTTP_CREATED)
                    ->setJSON(['message' => 'Payment type added successfully']);
        }
        catch(\Exception $e){
            return
                $this
                    ->response
                    ->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                    ->setJSON(['message' => 'An error occurred while adding payment type']);
        }
        finally{
            return redirect()->back();
        }

    }
}
