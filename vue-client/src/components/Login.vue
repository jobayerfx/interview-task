<template>
    <div class="vue-tempalte">
        <form @submit="login">
            <h3>Sign In</h3>
            <div class="alert alert-success" role="alert" v-if="loginSuccess">
              Login successful!
            </div>
            <div class="alert alert-danger" role="alert" v-if="errorOccour">
              Incorrect login data.
            </div>
            <div class="form-group">
                <label>Email address</label>
                <input type="email" v-model="email" name="email" class="form-control form-control-lg" />
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" v-model="password" name="password" class="form-control form-control-lg" />
            </div>

            <button type="submit" class="btn btn-dark btn-lg btn-block">Sign In</button>

            <p class="forgot-password text-right mt-2 mb-4">
                <router-link to="/forgot-password">Forgot password?</router-link>
            </p>

        </form>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        data() {
            return {
              email: '',
              password: '',
              loginSuccess: false,
              errorOccour: false,
            }
        },
      methods: {
          login (e) {
            e.preventDefault()
            if (!this.email) {
              alert('Please add a email address')
              return
            }
            if (!this.password) {
              alert('Please add password')
              return
            }
            var email = this.email
            var password = this.password
            const requestOptions = {
              headers: { 'Content-Type': 'application/json' },
              // body: JSON.stringify({ email, password })
              email: email,
              password: password
            };
            axios.post(`login` , requestOptions)
                .then(user => {
                  if (user.data.token) {
                    localStorage.setItem('user', JSON.stringify(user.data));
                    this.errorOccour = false
                    this.loginSuccess = true
                    this.$router.push('/home')
                    window.location.reload()
                  }else{
                    this.loginSuccess = false
                    this.errorOccour = true;
                  }
                  // return user;
                })
              .catch(function (error) {
                console.log(error);
              });

          }
      }
    }
</script>