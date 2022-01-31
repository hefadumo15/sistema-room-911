<template>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header"><h4>Crear Usuario</h4></div>
        <div class="card-body">
          <FormEmploye />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import FormEmploye from "../FormEmploye.vue";
export default {
  name: "CreateEmployee",
  components: {
    FormEmploye,
  },
};
</script>