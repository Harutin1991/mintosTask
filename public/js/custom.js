$(document).ready(function () {
    $('#email').on('change', function (e) {
	  var urlInfo = $('#urlInfo').val();
	  var email = $(this).val();
	  if (validateEmail(email)) {
		$.ajax({
		    url: urlInfo + 'login/checkEmail',
		    method: 'POST',
		    data: {email: email},
		    success: function (result) {
			  var obj = JSON.parse(result);
			  if (!obj['success']) {
				$('#emailError').html('Email already exist');
				$('#emailError').removeClass('hidden');
				$('#submitForm').prop('disabled', true);
			  } else {
				$('#emailError').html('');
				$('#submitForm').prop('disabled', false);
			  }
		    }
		});
	  }
    });
})
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function openLogout(element) {
    if (!$(element).parent().hasClass('open')) {
        console.log(123)
        $(element).parent().addClass('open');
        $('#logoutDropDown').attr('aria-expanded', true);
    } else {
        $(element).parent().removeClass('open');
        $('#logoutDropDown').attr('aria-expanded', false);
    }
    //$('#dropdownParent').addClass('open');

}