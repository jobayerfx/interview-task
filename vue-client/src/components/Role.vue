<template>
  <div class="_role">
    <h3>
      {{ role.name }} {{role.id}}
      <i @click="$emit('delete-role', role.role_id)" class="fa fa-times"></i>
    </h3>
    <p>{{ role.description }}</p>
  </div>
</template>

<script>
export default {
  name: 'Role',
  props: {
    role: Object,
  },
}
</script>

<style scoped>
.fa {
  color: red;
}

._role {
  background: #f4f4f4;
  margin: 5px;
  padding: 10px 20px;
  cursor: pointer;
}

._role.reminder {
  border-left: 5px solid green;
}

._role h3 {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
</style>