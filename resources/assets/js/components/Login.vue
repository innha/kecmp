<template>    
    <div class="modal fade" id="loginModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title text-uppercase" id="exampleModalLabel">Login</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" role="form">
                <div class="form-group" :class="{'has-error': errorsEmail}">
                    <!-- <label for="email" class="col-md-4 control-label">Email</label> -->

                    <!-- <div class="col-md-6"> -->
                    <div class="col-sm">
                        <input id="email" type="email" class="form-control form-control-md" name="email" placeholder="E-Mail Address" required autofocus v-model="loginDetails.email">

                        <span v-if="errorsEmail" class="help-block">
                            <strong>{{ emailError }}</strong>
                        </span>
                    </div>
                </div>

                <div class="form-group" :class="{'has-error': errorsPassword}">
                    <!-- <label for="password" class="col-md-4 control-label">Password</label> -->

                    <!-- <div class="col-md-6"> -->
                    <div class="col-sm">
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password" required v-model="loginDetails.password">

                        <span v-if="errorsPassword" class="help-block">
                            <strong>{{ passwordError }}</strong>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" v-model="loginDetails.remember"> Remember Me
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <!-- <div class="col-md-8 col-md-offset-4"> -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" @click.prevent="attemptLogin()" :disabled="!isValidLoginForm">
                            Login
                        </button>
                        <!-- <a class="btn btn-link" href="">Forgot Your Password?</a> -->
                    </div>
                </div>    
            </form>
          </div>
        </div>
      </div>
    </div>    
</template>

<script>
    import Vue from 'vue'
    import axios from 'axios'
    import VueAxios from 'vue-axios'

    Vue.use (VueAxios, axios)

    export default {
        mounted() {

            console.log('Component mounted.');            
        },

        data() {

            return {

                loginDetails: {
                    email: '',
                    password: '',
                    remember: true
                },

                loading: false,

                errorsEmail: false,
                errorsPassword: false,
                emailError: null,
                passwordError: null
            }
        },

        computed: {

            isValidLoginForm: function() {
                let self = this

                //alert(self.email);
                //return self.email && self.password;
                return self.emailIsvalid() && self.loginDetails.password && !self.loading;
            },

        },        

        methods: {

            emailIsvalid: function () {

                let self = this
            
                //alert(self.email);
                
                if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(self.loginDetails.email)) {
                    return true;
                }
                
                return false
                
            },

            attemptLogin: function() {

                let self = this

                self.loading = true

                //alert(self.loginDetails.email + ' ' + self.loginDetails.password + ' ' + self.loginDetailsremember)
                //alert(JSON.stringify(self.loginDetails))

                this.axios.post('/login', self.loginDetails).then(function (resp) {

                    console.log(resp)
                    //alert('resp')

                    //alert(JSON.stringify(resp))
                    //alert(resp.data.status)                                                        

                    if(resp.data.status == 'NOT OK') {

                        alert(resp.data.status + ': ' + resp.data.location)

                    } else {

                        //alert(resp.data.status + ': ' + resp.data.location)

                        // location.reload()
                        location.replace('/home')
                        
                    }

                }).catch(function (error) {

                    self.loading = false
                    
                    console.log(error)
                    //alert(JSON.stringify(error))

                    var errors = error.response

                    //alert(errors.statusText)            

                    if(errors.statusText === 'Unprocessable Entity') {                    

                        if(errors.data) {

                            
                            //alert(JSON.stringify(errors.data))
                            if(errors.data.message) {

                                self.errorsEmail = true
                                self.emailError = errors.data.message //_.isArray(errors.data.message) ? errors.data.message[0] : errors.data.message
                            }

                            /*
                            //alert(JSON.stringify(errors.data.errors))

                            if(errors.data.errors.email) {

                                self.errorsEmail = true
                                self.emailError = _.isArray(errors.data.errors.email) ? errors.data.errors.email[0] : errors.data.errors.email
                            }

                            if(errors.data.errors.password) {

                                self.errorsPassword = true
                                self.passwordError = _.isArray(errors.data.errors.password) ? errors.data.errors.password[0] : errors.data.errors.password
                            }
                            */                           
                        }
                    }
                })
                //alert('after axios')
            }
        }
    }
</script>
