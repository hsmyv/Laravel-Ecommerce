// Set your publishable key: remember to change this to your live publishable key in production
// See your keys here: https://dashboard.stripe.com/apikeys
var stripe = Stripe('pk_test_51MSgXMFGPKMMRWmDiQdjqrVRj1hpjHUS9zC70wBrYYIQzWWWkFumN1lu0ILnfT2PeHaasTgkNIFYDOwAtUto7Qm400GrMCHHdB');
var elements = stripe.elements();

// Set up Stripe.js and Elements to use in checkout form
var elements = stripe.elements();
var style = {
  base: {
    color: "#32325d",
  }
};

var card = elements.create("card", {
    style: style,
    hidePostalCode: true
 });
card.mount("#card-element");

 card.addEventListener('change', function(event){
        let displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });


var form = document.getElementById('payment-form');

form.addEventListener('submit', function(ev) {
  ev.preventDefault();

//   var options ={
//     address_line1: document.getElementById('address').value,
//     address_city: document.getElementById('city').value,
//     address_state: document.getElementById('country').value,
//     address_zip: document.getElementById('postcode').value
//   }

  stripe.createToken(card).then(function(result) {
    if(result.error){
        var errorElement = document.getElementById('card-errors');
        errorElement.textContent = result.error.message;
    }else{
        stripeTokenHandler(result.token);
    }
});
});

function stripeTokenHandler(token){
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    form.submit();
}




