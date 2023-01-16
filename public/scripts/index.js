const mailingInputModule = function (selector, validationCb) {
  const setListeners = function () {
    try {
      const mailingInput = document.querySelector(selector);
      mailingInput.addEventListener("keyup", validationCb);
    } catch (err) {
      console.log(err);
    }
  };

  return {
    init: setListeners,
  };
};

const makeApiRequest = function (reqData) {
  const stepTwoEl = document.querySelector(".step-two");

  const customAddressEl = document.querySelector(".js-custom-address");
  const customAddressInputEl = document.querySelector(
    ".js-recommended-address-input"
  );

  const recommendedAddressEl = document.querySelector(
    ".js-recommended-address"
  );
  const recommendedAddressInputEl = document.querySelector(
    ".js-recommended-address-input"
  );

  const formSpinner = document.querySelector(".js-form-spinner");
  formSpinner.className = formSpinner.className.replace(" disabled", "");

  const reqBody = JSON.stringify({
    address: reqData,
  });

  console.log("2. shooting", reqBody);
  const validationApiEndpoint = "/search";
  const response = fetch(validationApiEndpoint, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: reqBody,
  });

  response
    .then((res) => res.json())
    .then((resData) => {
      const formattedAddress = resData?.result?.address?.formattedAddress || "";

      recommendedAddressEl.innerHTML = formattedAddress;
      recommendedAddressInputEl.value = formattedAddress;

      customAddressEl.innerHTML = reqData;
      customAddressInputEl.innerHTML = reqData;

      stepTwoEl.className = stepTwoEl.className.replace(" disabled", "");
      formSpinner.className = formSpinner.className += " disabled";

      console.log({
        reqData,
        formattedAddress,
      });
    });
};

window.onload = function () {
  const handleApiResponse = _.debounce(function (e) {
    const { value } = e.target;

    if (value) {
      makeApiRequest(value);
    }
  }, 1000);

  const inputModule = mailingInputModule(
    ".js-mailing-input",
    handleApiResponse
  );
  inputModule.init();
};
