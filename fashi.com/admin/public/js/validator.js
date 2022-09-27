"use strict";

function Validator(formSelector, options = {}) {
    var formRules = {}

    function getParent(childElement, selector) {
        while (childElement.parentElement) {
            if (childElement.parentElement.matches(selector)) {
                return childElement.parentElement;
            }
            childElement = childElement.parentElement;
        }
    }

    var validatorRules = {
        required: function (value) {
            return value ? undefined : "This field is required!";
        },
        email: function (value) {
            var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return regex.test(value) ? undefined : "Email is not valid";
        },
        min: function (min) {
            return function (value) {
                return value.length >= min ? undefined : `Enter at least ${min} characters`;
            }
        },
        max: function (max) {
            return function (value) {
                return value.length <= max ? undefined : `Enter up to ${max} characters`;
            }
        },
        number : function (value){
            var regex = /^\d+(\.\d{1,2})?$/;
            return regex.test(value) ? undefined : "Value must have number or decimal number!";
        }
    }

    //lấy ra form cần validation:
    var formElement = document.querySelector(formSelector);

    // Chỉ xử lý khi có element trong DOM:
    if (formElement) {
        var inputs = formElement.querySelectorAll("[name][rules]");

        for (let input of inputs) {

            var rules = input.getAttribute("rules").split("|");
            

            for (let rule of rules) {

                var ruleInfo;
                var isRulesHasValue = rule.includes(":");

                if (isRulesHasValue) {
                    ruleInfo = rule.split(':');
                    rule = ruleInfo[0];
                }

                var ruleFunction = validatorRules[rule];

                if (isRulesHasValue) {
                    ruleFunction = ruleFunction(ruleInfo[1]);
                }

                if (Array.isArray(formRules[input.name])) {
                    formRules[input.name].push(ruleFunction);
                }
                else {
                    formRules[input.name] = [ruleFunction];
                }

            }
            input.onblur = handleValidate;
            input.oninput = handleClear;
        }
    }

    function handleValidate(event) {
        var listFuncs = formRules[event.target.name];
        var errorMessage;
        
        listFuncs.find(function (func) {
            return errorMessage = func(event.target.value);
        })

        if (errorMessage) {
            var formGroup = getParent(event.target, ".form-group");
            
            if (formGroup) {
                var formMessage = formGroup.querySelector(".error");
                formGroup.classList.add("invalid");
                formMessage.innerText = errorMessage;
            }
        }

        return !errorMessage;
    }

    function handleClear(event) {
        var formGroup = getParent(event.target, ".form-group");
        if (formGroup.classList.contains("invalid")) {
            formGroup.classList.remove("invalid");

            var formMessage = formGroup.querySelector(".error");
            if (formMessage) {
                formMessage.innerText = "";
            }
        }
    }

    // xử lý hành động submit form:
    formElement.onsubmit = function (event) {
        event.preventDefault();
        var isValid = true;
        var inputs = formElement.querySelectorAll("[name][rules]");
        for (let input of inputs) {
            if (!handleValidate({ target: input })) {
                isValid = false;
            }
        }

        // Khi không có lỗi submit form:
        if (isValid) {
            if (typeof options.onSubmit === "function") {
                // get all inputs element not disable
                var enableInputs = formElement.querySelectorAll('[name]:not([disable])');
                var formValues = Array.from(enableInputs).reduce(function(values, input){
                    switch (input.type) {
                        case 'radio':
                            // values[input.name] = formElement.querySelector(`input[name="${input.name}"]:checked`).value;
                            if (input.matches(':checked')) {
                                values[input.name] = input.value;
                            }
                            break;
                        case 'checkbox':
                            if(!input.matches(':checked')){
                                if(!Array.isArray(values[input.name])){
                                    values[input.name] = "";
                                }
                                return values;
                            }
                            if(!Array.isArray(values[input.name])){
                                values[input.name] = [];
                            }
                            values[input.name].push(input.value);
                            break;
                        default:
                            values[input.name] = input.value;
                    }
                    return values;
                }, {})
                options.onSubmit(formValues);
            }
            else{
                formElement.submit();
            }
        }
    }
}