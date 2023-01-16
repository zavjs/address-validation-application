<?php

namespace App\Controllers;

// use App\Models\AddressModel;

class Address extends BaseController
{
  public function save()
  {
    helper('form');

    $post = $this->request->getPost(['address']);

    // return with an error if data missing
    if (!$this->request->is('post') || !$this->validateData($post, [
      'address' => 'required|min_length[3]',
    ])) {
      return view('home');
    }

    // $model = model(AddressModel::class);
    // $model->save([
    //   'address' => $post['address'],
    // ]);

    return view('partials/header') . view('success') . view('footer');
  }
}
