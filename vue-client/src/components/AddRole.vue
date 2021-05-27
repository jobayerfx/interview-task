<template>
    <div class="vue-tempalte">
        <form @submit="saveRole">
            <h3>Create new role</h3>
            <div class="alert alert-success" role="alert" v-if="AddSuccess">
              Successfully Added!
            </div>
            <div class="alert alert-danger" role="alert" v-if="errorOccour">
              Invalid
            </div>
            <div class="form-group">
                <label>Role Name</label>
                <input type="text" v-model="name" name="name" class="form-control form-control-lg" />
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea v-model="description" name="description" class="form-control form-control-lg"></textarea>
            </div>

            <button type="submit" class="btn btn-dark btn-lg btn-block">Save Role</button>

        </form>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        data() {
            return {
              name: '',
              description: '',
              AddSuccess: false,
              errorOccour: false,
            }
        },
      methods: {
        saveRole (e) {
            e.preventDefault()
            if (!this.name) {
              alert('Please add a name')
              return
            }
            const requestOptions = {
              headers: { 'Content-Type': 'application/json' },
              name: this.name,
              description: this.description
            };
            axios.post(`role` , requestOptions)
                .then(res => {
                  if (res.data.role) {
                    this.errorOccour = false
                    this.AddSuccess = true
                  }else{
                    this.AddSuccess = false
                    this.errorOccour = true;
                  }
                })
              .catch(function (error) {
                console.log(error);
              });

          }
      }
    }
</script>