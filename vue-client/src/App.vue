<template>
  <div class="vue-tempalte">
    <!-- Navigation -->
  <Header :authData="authData" />

    <!-- Main -->
    <div class="App">
      <div class="vertical-center">
        <div class="inner-block">
          <router-view :authData="authData" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import Header from './components/Header'

  export default {
    name: 'App',
    components: {
      Header,
    },
    data() {
      return {
        users: [],
        authData: null,
      }
    },
    created() {
      this.authData = JSON.parse(localStorage.getItem('user'))
    }

  }
</script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap');
</style>