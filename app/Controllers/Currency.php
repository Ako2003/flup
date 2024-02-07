<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\Currency as CurrencyModel;

class Currency extends BaseController
{
    public function index()
    {
        return view('currency');
    }

    public function get() {
        $currency = new CurrencyModel();
        $data = $currency->findAll();
        return 
            $this
                ->response
                ->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON($data);
    }

    public function add() {
        try {
            $currency = new CurrencyModel();
            $currency->save([
                'name' => $this->request->getVar('currency')
            ]);

            return 
                $this
                    ->response
                    ->setStatusCode(ResponseInterface::HTTP_CREATED)
                    ->setJSON(['message' => 'Currency added successfully']);
        }
        catch(\Exception $e) {
            return 
                $this
                    ->response
                    ->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                    ->setJSON(['message' => 'An error occurred while adding currency']);
        }
        finally {
            return redirect()->back();
        }
    }
}
