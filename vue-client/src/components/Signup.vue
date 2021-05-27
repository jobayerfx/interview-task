<template>
    <div class="vue-tempalte">
        <form @submit="onSubmit">
            <h3>Sign Up</h3>

            <div class="form-group">
                <label>First Name</label>
                <input type="text" v-model="firstName" name="firstName" class="form-control form-control-lg"/>
            </div>

            <div class="form-group">
                <label>Last Name</label>
                <input type="text" v-model="lastName" name="lastName" class="form-control form-control-lg"/>
            </div>

            <div class="form-group">
                <label>Email address</label>
                <input type="email" v-model="email" name="email" class="form-control form-control-lg" />
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" v-model="password" name="password" class="form-control form-control-lg" />
            </div>

            <button type="submit" class="btn btn-dark btn-lg btn-block">Sign Up</button>

            <p class="forgot-password text-right">
                Already registered 
                <router-link :to="{name: 'login'}">sign in?</router-link>
            </p>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
              users: [],
              firstName: '',
              lastName: '',
              email: '',
              password: '',
            }
        },
      methods: {
        async onSubmit(e) {
          e.preventDefault()
          if (!this.firstName) {
            alert('Please add a first name')
            return
          }
          if (!this.lastName) {
            alert('Please add a last name')
            return
          }
          if (!this.email) {
            alert('Please add a email')
            return
          }
          if (!this.password) {
            alert('Please add a password')
            return
          }
          const newUser = {
            id: Math.floor(Math.random() * 100000),
            firstName: this.firstName,
            lastName: this.lastName,
            email: this.email,
            password: this.password,
          }
          const res = await fetch('api/users', {
            method: 'POST',
            headers: {
              'Content-type': 'application/json',
            },
            body: JSON.stringify(newUser),
          })
          const data = await res.json()
          this.users = [...this.users, data]

          this.firstName = ''
          this.lastName = ''
          this.email = ''
          this.password = ''
        },
      },
      async addUser(user) {
        const res = await fetch('api/users', {
          method: 'POST',
          headers: {
            'Content-type': 'application/json',
          },
          body: JSON.stringify(user),
        })
        const data = await res.json()
        this.users = [...this.users, data]
      },
    }
</script>