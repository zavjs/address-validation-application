<?php

namespace App\Controllers;

use App\Models\AddressModel;

class Address extends BaseController
{

  public function search()
  {
    header('Content-Type: application/json');

    $address = $this->request->getVar('address');
    $request_url = getenv('MAILING_ADDRESS_VALIDATION_BASE') . getenv('MAILING_ADDRESS_VALIDATION_API_KEY');

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $request_url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
      "Accept: application/json",
      "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $data = <<<DATA
    {
      "address": {
        "regionCode": "US",
        "addressLines": ["$address"]
      }
    }
    DATA;

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $resp = curl_exec($curl);
    curl_close($curl);

    return $resp;
  }

  public function list()
  {
    $model = model(AddressModel::class);
    $data['title'] = "Address Validation App";
    $data['addresses'] = $model->getAddresses();

    return view('partials/header', $data) . view('addresses') . view('partials/footer');
  }

  public function save()
  {

    helper('form');
    $data['title'] = "Address Validation App";

    $post = $this->request->getPost(['address']);

    if (!$this->request->is('post') || !$this->validateData($post, [
      'address' => 'required|min_length[3]',
    ])) {
      $data['error'] = 'Review the submitted information and try again';
      return view('home', $data);
    }

    $model = model(AddressModel::class);

    $model->save([
      'address' => $post['address'],
    ]);

    return view('partials/header', $data) . view('success') . view('partials/footer');
  }
}
