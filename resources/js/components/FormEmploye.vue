<template>
  <form @submit.prevent="onSubmit">
    <div class="row">
      <div class="col-12 mb-2">
        <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-control" v-model="employee.name" />
        </div>
      </div>
      <div class="col-12 mb-2">
        <div class="form-group">
          <label>Last Name</label>
          <input
            type="text"
            class="form-control"
            v-model="employee.last_name"
          />
        </div>
      </div>
      <div class="col-12 mb-2">
        <div class="form-group">
          <label>Identification</label>
          <input
            type="text"
            class="form-control"
            v-model="employee.identification"
          />
        </div>
      </div>
      <div class="col-12 mb-2">
        <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-control" v-model="employee.email" />
        </div>
      </div>
      <div class="col-12 mb-2">
        <div class="form-group">
          <label>Phone</label>
          <input type="text" class="form-control" v-model="employee.phone" />
        </div>
      </div>
      <div class="col-12 mb-2">
        <div class="form-group">
          <label>Address</label>
          <input type="text" class="form-control" v-model="employee.addres" />
        </div>
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </form>
</template>

<script>
export default {
  name: "FormEmployee",
  props: {
    action: {
      type: String,
      default: "create",
    },
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
    onSubmit() {
      if (this.$props.action === "edit") {
        this.update();
      } else {
        this.create();
      }
    },
    async create() {
      await axios
        .post("/api/employee", this.employee)
        .then(() => {
          this.$router.push({ name: "showEmployees" });
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async update() {
      await axios
        .put(`/api/employee/${this.id}`, this.employee)
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
    },
  },

  mounted() {
    this.$props.action === "edit" && this.getEmployee();
  },
};
</script>
