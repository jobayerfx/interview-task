<template>
  <div>
    <div class="alert alert-success" role="alert" v-if="success">
      Successfully Delete
    </div>
    <div class="alert alert-danger" role="alert" v-if="errorOccour">
      Failed!
    </div>
    <div :key="role.id" v-for="role in roles">
      <Role @delete-role="deleteRole" :role="role"/>
    </div>
  </div>
</template>

<script>
  import Role from '../components/Role'
  import axios from "axios"
  export default {
    name: 'Roles',
    data() {
      return {
        roles: Array,
        user_id: (localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')).user.id : null),
        success: false,
        errorOccour: false
      }
    },
    components: {
      Role,
    },
    emits: ['delete-role'],
    methods: {
      async fetchRoles() {
        axios.get('user-role/'+ this.user_id, {
          headers: {
            "Content-Type": "application/json",
          }
        })
          .then(response => {
            this.roles = response.data.roles
            // console.log(response.data);
          })
          .catch(function (error) {
            console.log(error);
          });
      },
      async deleteRole(id) {
        if (confirm('Are you sure?')) {
          axios.get('delete-assign-role/' + this.user_id + '/' + id, {
            headers: {
              "Content-Type": "application/json",
            }
          })
          .then(response => {
            // console.log(response.status)
            if(response.status === 200) {
              (this.roles = this.roles.filter((role) => role.role_id !== id))
              this.errorOccour = false
              this.success = true
            }else{
              this.success = false
              this.errorOccour = true
            }
          })
          .catch(function (error) {
            this.success = false
            this.errorOccour = true
            console.log(error)
          });
        }
      },
    },
    created() {
      this.fetchRoles()
    }
  }
</script>