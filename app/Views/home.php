    <!-- CONTENT -->
    <section class="content-wrapper px-4 text-left py-5">
        <fieldset class="step-one">
            <div class="form-group mb-5">
                <legend>
                    <label for="address-search" role="button"><b>Step 1:</b> Provide a mailing address</label>
                </legend>
                <div class="d-flex">
                    <input id="address-search" type="text" name="address-search" class="js-mailing-input w-100 p-2" placeholder="e.g: 2480 South Drive, Houston" />
                    <div class="ml-4">
                        <div class="spinner-border text-dark js-form-spinner spinner disabled" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <form action="/save" method="post">
            <?= csrf_field() ?>
            <fieldset class="step-two disabled">
                <legend>
                    <b>Step 2:</b> Confirm the address
                </legend>
                <div class="form-group container">
                    <label class="row selection-container p-3 rounded" role="button">
                        <div class="p-2 mr-2">
                            <input id="custom-address" class="js-custom-address-input" type="radio" name="address" value="custom" />
                        </div>
                        <div>
                            What you entered:
                            <div>
                                <p class="mb-0 js-custom-address"></p>
                            </div>
                        </div>
                    </label>
                    <label class="row selection-container p-3 rounded" role="button">
                        <div class="p-2 mr-2">
                            <input id="recommended-address" type="radio" class="js-recommended-address-input" name="address" value="recommended" />
                        </div>
                        <div>
                            Recommended:
                            <div>
                                <p class="mb-0 js-recommended-address"></p>
                            </div>
                        </div>
                    </label>
                    <div class="submit-container row mt-3">
                        <button class="btn-primary ml-auto mr-0" type="submit">Save address</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </section>
    <!-- SCRIPTS -->
    <script src="/scripts/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@mig8447/lodash-debounce-throttle@4.17.5/dist/lodash-debounce-throttle.min.js"></script>