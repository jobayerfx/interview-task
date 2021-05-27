<template>
  <h3 v-if="authData">Welcome! {{authData.user.firstName}} {{authData.user.lastName}}</h3>
  <p v-else>Your are not logged in. Please <router-link class="nav-link" to="/login">Login</router-link></p>
</template>


<script>
export default {
  name: 'Home',
  props: ['authData'],
  data() {
    return {}
  },
  methods: {
  }
}
</script>