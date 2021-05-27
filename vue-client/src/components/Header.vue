<template>
  <nav class="navbar shadow bg-white rounded justify-content-between flex-nowrap flex-row fixed-top">
    <div class="container">
      <strong class="navbar-brand float-left">
        TikWeb
      </strong>
      <ul class="nav navbar-nav flex-row float-right">

        <li class="nav-item">
          <router-link class="nav-link pr-3" to="/home">Home</router-link>
        </li>
        <li class="nav-item" v-if="authData">
          <router-link class="nav-link pr-3" to="/add-role">Add Role</router-link>
        </li>
        <li class="nav-item" v-if="authData">
          <router-link class="nav-link pr-3" to="/user-list">Users list</router-link>
        </li>
        <li class="nav-item" v-if="authData">
          <router-link class="nav-link pr-3" to="/profile">Profile</router-link>
        </li>
        <li class="nav-item" v-if="authData">
          <router-link class="nav-link pr-3" to="/my-roles">My Roles</router-link>
        </li>
        <li class="nav-item" v-if="authData">
          <router-link class="nav-link pr-3" to="/manage-roles">Manage Role</router-link>
        </li>
        <li class="nav-item" v-if="authData">
          <a class="nav-link" href="javascript::void(0)" @click="doLogout">Logout</a>
        </li>
        <li class="nav-item" v-if="!authData">
          <router-link class="nav-link pr-3" to="/login">Sign in</router-link>
        </li>
        <li class="nav-item" v-if="!authData">
          <router-link class="btn btn-info" to="/">Sign up</router-link>
        </li>

      </ul>

    </div>
  </nav>
</template>

<script>
export default {
  name: 'Header',
  props: ['authData'],
  data() {
    return {}
  },
  methods: {
    doLogout() {
      localStorage.removeItem('user')
      this.$router.push('/home')
      window.location.reload()
    }
  }
}
</script>