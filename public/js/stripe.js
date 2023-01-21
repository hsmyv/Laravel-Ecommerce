// Set your publishable key: remember to change this to your live publishable key in production
// See your keys here: https://dashboard.stripe.com/apikeys
var stripe = Stripe('pk_test_TYooMQauvdEDq54NiTphI7jx');
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

  var options ={
    name: document.getElementById('name_on_card').value,
    address_line1: document.getElementById('address').value,
    address_city: document.getElementById('city').value,
    address_state: document.getElementById('province').value,
    address_zip: document.getElementById('postalcode').value
  }
  stripe.createToken(card,options).then(function(result) {
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




