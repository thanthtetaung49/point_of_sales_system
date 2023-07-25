import axios from 'axios'

export default {
    name: "RegisterPage",

    data()
    {
        return {
            userNameValidationStatus: false,
            emailValidationStatus: false,
            passwordValidationStatus: false,
            confirmPasswordValidationStatus: false,
            passwordLengthValidationStatus: false,
            confirmPassordLengthValidationStatus: false,

            registerData: {
                userName: "",
                userEmail: "",
                userPassword: "",
                userConfirmPassword: "",
            }
        };
    },

    methods: {
        directLoginPage()
        {
            this.$router.push({
                name: "loginPage",
            });
        },
        showPassword()
        {
            let userPassword = document.getElementById("userPassword");
            if (userPassword.type == "password") {
                userPassword.type = "text";
            } else {
                userPassword.type = "password";
            }
        },
        showConfirmPassword()
        {
            let userPassword = document.getElementById("confirmPassword");
            if (userPassword.type == "password") {
                userPassword.type = "text";
            } else {
                userPassword.type = "password";
            }
        },
        register()
        {
            if (this.registerData.userName != "" && this.registerData.userEmail != "" && this.registerData.userPassword != "" && this.registerData.userConfirmPassword != "" && this.registerData.userPassword.length > 6 && this.registerData.userConfirmPassword.length > 6) {
                axios.post('http://localhost:8000/api/register/post', this.registerData)
                    .then((response) =>
                    {
                        console.log(response);
                    })
                    .catch(error => console.log(error));
                this.$router.push({
                    name: "productPage"
                });
            }

            this.userNameValidationStatus = this.registerData.userName == "" ? true : false;
            this.emailValidationStatus = this.registerData.userEmail == "" ? true : false;
            this.passwordValidationStatus = this.registerData.userPassword == "" ? true : false;
            this.confirmPasswordValidationStatus = this.registerData.userConfirmPassword == "" ? true : false;

            if (this.registerData.userPassword.length > 0 && this.registerData.userPassword.length <= 6) {
                this.passwordLengthValidationStatus = true;
            } else {
                this.passwordLengthValidationStatus = false;
            }

            if (this.registerData.userConfirmPassword.length > 0 && this.registerData.userConfirmPassword.length <= 6) {
                this.confirmPassordLengthValidationStatus = true;
            } else {
                this.confirmPassordLengthValidationStatus = false;
            }
        }
    },
};