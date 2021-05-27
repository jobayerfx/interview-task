<template>
  <table class="table">
    <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
    </tr>
    </thead>
    <tbody>
      <tr :key="user.id" v-for="user in users">
        <th scope="row">{{ user.id }}</th>
        <td>{{ user.firstName }}</td>
        <td>{{ user.lastName }}</td>
        <td>{{ user.email }}</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
Vue.use(VueAxios, axios)

  export default {
    name: 'UserTable',
    props: {
      users: Array,
    },
    methods: {
      async fetchUsers() {
        axios.get(`user-list` , {
          headers: {
            "Content-Type": "application/json",
          }
        })
        .then(response => {
          this.users = response.data.users
          // console.log(response.data.users);
        })
        .catch(function (error) {
          console.log(error);
        });
      }
    },
    mounted() {
      this.fetchUsers()
    },
  }
</script>