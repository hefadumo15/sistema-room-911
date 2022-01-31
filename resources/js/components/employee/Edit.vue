<template>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header"><h4>Crear Usuario</h4></div>
        <div class="card-body">
          <FormEmploye action="edit" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import FormEmploye from "../FormEmploye.vue";

export default {
  name: "EditEmployee",
  components: {
    FormEmploye,
  },
  data() {
    return {
      id: this.$route.params.id,
      employee: {
        addres: "",
        identification: "",
        last_name: "",
        name: "",
        phone: "",
      },
    };
  },

  methods: {
    async update() {
      await axios
        .post("/api/employee", this.employee)
        .then((response) => {
          this.$router.push({ name: "showEmployees" });
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async getEmployee() {
      await axios
        .get(`/api/employee/${this.id}`)
        .then((res) => res.data)
        .then((data) => {
          this.employee.addres = data.addres;
          this.employee.name = data.name;
          this.employee.last_name = data.last_name;
          this.employee.identification = data.identification;
          this.employee.phone = data.phone;
        })
        .catch((error) => {
          console.log(error);
        });
      console.log(this.id);
    },
  },

  mounted() {
    this.getEmployee();
  },
};
</script>