# Address App

Welcome to the Address Validator.

Overall there's plenty of opportunity for improvement for example in the modularization of scripts and backend modules, but the main focus is functionality and good security practices given the limited time invested. 

### The App

The app is divided in two sections:

**Home** is the place where you can register new addresses. Follow through the form instructions and if provided with enough information, the address validation API will offer a recommendation. 

- The address validation API is a proxy in the PHP server to prevent exposing api credentials. 

**Addresses List**, which is where you see the list of previously saved addresses.