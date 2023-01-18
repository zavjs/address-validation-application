<?php

namespace App\Controllers;

use App\Models\AddressModel;

class Address extends BaseController
{
  public function search()
  {
    header('Content-Type: application/json');

    $validation = \Config\Services::validation();
    $validation->setRules([
      'address-line-1' => 'required|min_length[3]',
      'state' => 'required|min_length[2]',
    ], [   
      // Errors
      'address-line-1' => [
        'required' => 'Please inform address line.',
        'min_length' => 'Address line must be at least three characters long.',
      ],
      'state' => [
        'required' => 'Please inform state.',
        'min_length' => 'State must be at least two characters long.',
      ],
  ]);

    $is_valid = $validation->withRequest($this->request)->run();
   
    if (!$this->request->is('post') || !$is_valid) {
      $errors = $validation->getErrors();
      return json_encode(array('status' => 400, 'message' => $errors));
    }

    $request_url = getenv('MAILING_ADDRESS_VALIDATION_BASE') . getenv('MAILING_ADDRESS_VALIDATION_API_KEY');

    $address_line_1 = $this->request->getVar('address-line-1');
    $address_line_2 = $this->request->getVar('address-line-2');
    $city = $this->request->getVar('city');
    $state = $this->request->getVar('state');
    $zip = $this->request->getVar('zip');

    $data = <<<DATA
    {
      "address": {
        "regionCode": "US",
        "addressLines": ["$address_line_1", "$address_line_2"],
        "postalCode": "$zip",
        "administrativeArea": "$state",
        "locality": "$city",
      },
      "enableUspsCass": "true"
    }
    DATA;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $request_url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
      "Accept: application/json",
      "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $resp = curl_exec($curl);
    curl_close($curl);

    return json_encode(array('status' => 200, 'data' => json_decode($resp)));
  }

  public function list()
  {
    $model = model(AddressModel::class);
    $data['addresses'] = $model->getAddresses();

    return view('partials/header', $data) . view('addresses') . view('partials/footer');
  }

  public function save()
  {

    helper('form');
  
    $recommended = $this->request->getVar('recommended');
    $you = $this->request->getVar('you');
    $selected_version = '';

    if(!$recommended) {
      $selected_version = $you;
    } else {
      $selected_version = $recommended;
    }

    $model = model(AddressModel::class);

    $model->save([
      'address' => $selected_version,
    ]);

    return view('partials/header') . view('success') . view('partials/footer');
  }
}
