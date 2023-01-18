window.onload = function () {  
  $('#myTab a').click(function (e) {
    e.preventDefault();
    $('.tab-content input').prop('disabled', true);

    const target = $(this).attr('href');
    $(target).find('input').prop('disabled', false);
  });

  // form management
  function submitData(data) {
    const formData = new FormData(data);
    const formProps = Object.fromEntries(formData);
    const reqBody = JSON.stringify(formProps);

    const validationApiEndpoint = "/search";
    fetch(validationApiEndpoint, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: reqBody,
    })
      .then(res => res?.json())
      .then(data => {
        $('.js-errors').empty();
        if (data?.status === 200) {
          // recommended
          const firstAddressLineEl = $('.js-first-line');
          const secondAddressLineEl = $('.js-city-state-line');

          // user-created
          const addressLineOneEl = $('.js-you-address-line-1');
          const addressLineTwoEl = $('.js-you-address-line-2');
          const cityEl = $('.js-you-city');
          const stateEl = $('.js-you-state');
          const zipEl = $('.js-you-zip');
          
          // text insertions
          const { firstAddressLine = '', cityStateZipAddressLine = '', } = data?.data?.result?.uspsData?.standardizedAddress;

          firstAddressLineEl.text(firstAddressLine);
          secondAddressLineEl.text(cityStateZipAddressLine);
            
          addressLineOneEl.text(formProps['address-line-1'] || '');
          addressLineTwoEl.text(formProps['address-line-2'] || '');
          cityEl.text(formProps['city'] || '');
          stateEl.text(formProps['state'] || '');
          zipEl.text(formProps['zip'] || '');

          // capture full address
          const fullUserCreated = $('#you code').text();
          const recommended = $('#recommended code').text();

          // show modal
          $('#confirmationModal').modal('show');
          
          $('#text-you').val(fullUserCreated);
          $('#text-recommended').val(recommended);
      
        } else {
          const messages = Object.values(data?.message ?? {});
          messages.forEach(function (message) {
            $('.js-errors').append(`<p class="text-danger">${message}</p>`);
          })
        }
        $('.js-spinner').addClass('d-none');
      })
  }

  const address_form = document.forms[0];
  address_form.addEventListener('submit', function (e) {
    e.preventDefault();
    $('.js-spinner').removeClass('d-none');
    submitData(e.target);
  })
};
