import axios from "axios";
import { mapGetters } from "vuex";

export default {
    name: "LoginPage",
    data()
    {
        return {
            emailStatus: false,
            passwordStatus: false,
            userEmail: '',
            userPassword: ''
        }
    },
    computed: {
        ...mapGetters(['getToken'])
    },
    methods: {
        showPassword()
        {
            let userPassword = document.getElementById("userPassword");
            if (userPassword.type == "password") {
                userPassword.type = "text";
            } else {
                userPassword.type = "password";
            }
        },
        directRegisterPage()
        {
            this.$router.push({
                name: "registerPage"
            });
        },
        login()
        {
            let userData = {
                'email': this.userEmail,
                'password': this.userPassword
            }

            if (this.userEmail != '' && this.userPassword != '') {
                axios.post('http://localhost:8000/api/login/post', userData)
                .then((response) =>
                {
                    console.log(response);
                    if (response.data.token) {
                        this.$store.dispatch('loginToken', response.data.token);
                        this.$router.push({
                            name: 'homePage'
                        });
                    } else {
                        this.$router.push({
                            name: 'loginPage'
                        });
                    }
                })
                .catch(error => console.log(error));
            } else {
                this.emailStatus = this.userEmail == '' ? true : false;
                this.passwordStatus = this.userPassword == '' ? true : false;
            }
        }
    },
    mounted () {
        console.log(this.getToken);;
    },
};