<template>

  <div class="row" v-if="authData">
    <div class="col-sm-6 col-md-8">
      <h4>{{authData.user.firstName}} {{authData.user.lastName}}</h4>
      <small><cite title="San Francisco, USA">San Francisco, USA <i class="glyphicon glyphicon-map-marker">
      </i></cite></small>
      <p>
        <i class="glyphicon glyphicon-envelope"></i>{{authData.user.email}}
        <br />
        <i class="glyphicon glyphicon-gift"></i>June 06, 1988</p>
    </div>
  </div>

</template>


<script>
  export default {
    name: 'Home',
    props: ['authData'],
    data() {
      return {}
    }
  }
</script>