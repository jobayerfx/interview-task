<template>
  <div class="vue-tempalte">
    <form @submit="updateRole">
      <h3>Manage Role</h3>
      <div class="alert alert-success" role="alert" v-if="AddSuccess">
        Successfully UPDATED!
      </div>
      <div class="alert alert-danger" role="alert" v-if="errorOccour">
        Error encountered
      </div>
      <div class="form-group form-check" v-for="item in roles" :key="item.id">
        <label class="form-check-label pr-5" :for="item.id">{{item.name}}</label>
        <input type="checkbox" name="role" v-model="inputData" :id="item.id" :value="item.id">
<!--        <input type="checkbox" name="role" v-model="inputData" :id="item.id" :value="item" :checked="isInUserRole(item.id)">-->
      </div>

      <button type="submit" class="btn btn-dark btn-lg btn-block">Update Role</button>

    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      roles: Array,
      user_id: (localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')).user.id : null),
      AddSuccess: false,
      errorOccour: false,
      assignedRoles: null,
      inputData: [],
    }
  },
  methods: {
    async fetchAllRoles() {
      axios.get('role', {
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
    async fetchUserRoles() {
      axios.get('get-single-roles/' + this.user_id, {
        headers: {
          "Content-Type": "application/json",
        }
      })
        .then(response => {
          this.assignedRoles = response.data.roles
          for (var key in this.assignedRoles){
            this.inputData.push(this.assignedRoles[key].role_id)
            console.log(this.assignedRoles[key].role_id)
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    isInUserRole(id) {
      // console.log(this.assignedRoles)
      for (var key in this.assignedRoles){
        if (this.assignedRoles[key].role_id === id){
          return true
        }
      }
      return false
    },
    updateRole (e) {
      e.preventDefault()
      const requestOptions = {
        headers: { 'Content-Type': 'application/json' },
        user_id: this.user_id,
        roles: this.inputData
      };
      axios.post(`save-edit-role` , requestOptions)
          .then(res => {
            if (res.data.success) {
              this.errorOccour = false
              this.AddSuccess = true
            }else{
              this.AddSuccess = false
              this.errorOccour = true;
            }
          })
          .catch(function (error) {
            console.log(error)
          });

    }
  },
  created() {
    this.fetchAllRoles()
  },mounted() {
    this.fetchUserRoles()

  }
}
</script>