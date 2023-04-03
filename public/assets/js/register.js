$(document).ready(function() {
    
    $("#register-btn").click(function(event) {
        event.preventDefault();
        var formData = $(".register-form").serializeArray();
        console.log(formData);

        // Form validation
        var isEmpty = false;
        var data = {};
        formData.forEach(el => {
            if (!el.value) {
                isEmpty = true;
                return;
            }
            data[el.name] = el.value;
        });
        if(isEmpty) {
            addResponseMessage("Please fill all the empty filed", "text-danger");
        }
        else if (validateForm()) {
            $.post(
                '/register',
                data,
                function(data, success) {
                    if (data.status === 'success') {
                        addResponseMessage(data.message, "text-success");
                        setTimeout(function() {
                            window.location.href = "/login";
                        }, 500)
                    }
                    else if (data.status === 'failed') {
                        addResponseMessage(data.message, "text-danger");
                    }
                    else {
                        window.location.href = "/error";
                    }
                }
            )
        }

    });

    $("#login-btn").click(function(event) {
        event.preventDefault();
        var formData = $(".login-form").serializeArray();

        // Form validation
        var isEmpty = false;
        var data = {};
        formData.forEach(el => {
            if (!el.value) {
                isEmpty = true;
                return;
            }
            data[el.name] = el.value;
        });
        if(isEmpty) {
            addResponseMessage("Please fill all the empty filed", "text-danger");
        }
        else {
            console.log("llgin");
            $.post(
                '/login',
                data,
                function(data, success) {
                    console.log(data);
                    if (data.status === 'success') {
                        addResponseMessage(data.message, "text-success");
                        setTimeout(function() {
                            window.location.href = "/";
                        }, 300)
                    }
                    else if (data.status === 'failed') {
                        addResponseMessage(data.message, "text-danger");
                    }
                    else {
                        window.location.href = "/error";
                    }
                }
            )
        }

    });
    
    function addResponseMessage(message, cssClass) {
        $("#response-msg").html(message);
        $("#response-msg").removeClass("text-danger");
        $("#response-msg").removeClass("text-success");
        $("#response-msg").addClass(cssClass);
        if (cssClass == "text-success") {
            setTimeout(function() {
                $("#response-msg").html("");
            },5000);
        }
    }

    function validateForm() {
        var isValid = true;
        if (!validNameSyntax($("[name='fullName']").val())) {
            $("#error-fullName").html("Only alphabets and white spaces are allowed.");
            isValid &= false;
        }
        if (!validEmailSyntax($("[name='email']").val())) {
            $("#error-email").html("Please enter email in valid email format.");
            isValid &= false;
        }
        if ($("[name='password']").val().length < 8) {
            $("#error-password").html("minimum password length should be 8");
            isValid &= false;
        }
        else if ($("[name='password']").val() !== $("[name='confPassword']").val()) {
            $("#error-confPassword").html("Password and confirmed passwords are not same.");
            isValid &= false;
        }
        return isValid;
    }

    function validNameSyntax(value) {
        var regex = /^[a-zA-Z]+[ ][a-zA-Z]+$/;
        var regex2 = /^[a-zA-Z]+$/;
        return regex.test(value) || regex2.test(value);
    }

    function validEmailSyntax(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
})