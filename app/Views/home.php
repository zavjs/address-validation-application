    <!-- CONTENT -->
    <section class="content-wrapper px-4 text-left py-5">
        <div class="bg-white p-4 border rounded">
            <form id="first-form" class="container">
                <?= csrf_field() ?>
                <fieldset class="step-one">
                    <div class="form-group">
                        <legend>
                            <h3 class="mb-0">Address validator</h3>
                            <b class="h6">Validate/standardize addresses</b>
                            <hr />
                        </legend>
                        <div class="form-group mb-2">
                            <label for="address-line-1" role="button">Address Line 1</label>
                            <input id="address-line-1" type="text" name="address-line-1" class="w-100 p-2" placeholder="e.g: 2480 South Drive, Houston" />
                        </div>
                        <div class="form-group mb-2">
                            <label for="address-line-2" role="button">Address Line 2</label>
                            <input id="address-line-2" type="text" name="address-line-2" class="w-100 p-2" placeholder="e.g: Apt, Suite, Unit" />
                        </div>
                        <div class="form-group mb-2">
                            <label for="city" role="button">City</label>
                            <input id="city" type="text" name="city" class="w-100 p-2" />
                        </div>
                        <div class="form-group mb-2">
                            <label for="state" role="button">State</label>
                            <select id="state" name="state" class="w-100 p-2">
                                <option value="">
                                    <?php include 'partials/states-list.php'; ?>
                                </option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="zip" role="button">Zip Code</label>
                            <input id="zip" type="text" name="zip" class="w-100 p-2" />
                        </div>
                    </div>
                </fieldset>
                <div class="form-group p-2 js-errors"></div>
                <div class="d-flex mt-3">
                    <div class="col text-center">
                        <button class="btn btn-primary ml-auto mr-0" type="submit">Validate</button>
                    </div>
                    <div class="js-spinner spinner-border d-none" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </form>
        </div>


        <div id="confirmationModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Save Address</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/save" method="POST">
                            <?= csrf_field() ?>
                            <fieldset class="step-two">
                                <h4>Which address format do you want to save?</h4>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="you-tab" data-toggle="tab" href="#you" role="tab" aria-controls="you" aria-selected="true">What you entered</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="recommended-tab" data-toggle="tab" href="#recommended" role="tab" aria-controls="recommended" aria-selected="false">Recommended</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane active" id="you" role="tabpanel" aria-labelledby="you-tab">
                                        <div class="p-3 border rounded mt-2">
                                            <code>
                                                <p class="js-you-address-line-1 m-0"></p>
                                                <p class="js-you-address-line-2 m-0"></p>
                                                <p class="js-you-city m-0"></p>
                                                <p class="js-you-state m-0"></p>
                                                <p class="js-you-zip m-0"></p>
                                            </code>
                                            <input type="hidden" id="text-you" name="you" disabled />
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="recommended" role="tabpanel" aria-labelledby="recommended-tab">
                                        <div class="p-3 border rounded mt-2">
                                            <code>
                                                <p class="js-first-line m-0"></p>
                                                <p class="js-city-state-line m-0"></p>
                                            </code>
                                            <input type="hidden" id="text-recommended" name="recommended" disabled />
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="p-2 col text-right">
                                <button class="btn btn-primary ml-auto mr-0" type="submit">Save address</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="/scripts/index.js"></script>