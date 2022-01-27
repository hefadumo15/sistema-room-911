<template>
    <div class="row">
        <div class="col-12 mb-2">
            <!-- llamamos al componente para Crear   -->
            <!-- <router-link :to='{name:"crearBlog"}' class="btn btn-success"><i class="fas fa-plus-circle"></i></router-link> -->
            <button @click="modal = true" class="btn btn-success"><i class="fas fa-plus-circle"></i> New Employee </button>

            <!-- component -->
            <div v-show="modal" class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover" id="modal-id">
                <div class="absolute bg-black opacity-80 inset-0 z-0"></div>
                <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
                    <!--content-->
                    <div class="">
                        <div class="font-medium self-center text-xl sm:text-3xl text-gray-800">
                            <h1 class="text-center text-2xl mb-6 text-gray-600 font-bold font-sans">Form of Register</h1>
                        </div>
                        <!--body-->
                        <form @submit.prevent="create" class="mt-6">
                            <div class="flex justify-between gap-3">
                                <span class="w-1/2">
                                    <label for="name" class="block text-xs font-semibold text-gray-600 uppercase">Name</label>
                                    <input id="name" type="text" name="name" placeholder="John" autocomplete="given-name" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required v-model="employee.name" />
                                </span>
                                <span class="w-1/2">
                                    <label for="lastname" class="block text-xs font-semibold text-gray-600 uppercase">Lastname</label>
                                    <input id="lastname" type="text" name="lastname" placeholder="Doe" autocomplete="family-name" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required v-model="employee.last_name" />
                                </span>
                            </div>

                            <div class="flex justify-between gap-3">
                                <span class="w-1/2">
                                    <label for="identification" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Identification</label>
                                    <input id="identification" type="text" name="identification" placeholder="123456789" autocomplete="given-name" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required v-model="employee.identification" />
                                </span>
                                <span class="w-1/2">
                                    <label for="phone" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Phone</label>
                                    <input id="phone" type="text" name="phone" placeholder="031-789-2028" autocomplete="family-name" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required v-model="employee.phone" />
                                </span>
                            </div>
                            
                            <label for="addres" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Address</label>
                            <input id="addres" type="text" name="addres" placeholder="calle 1 # 3 - 18" autocomplete="email" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required v-model="employee.addres" />
                        
                            <div class="p-3  mt-2 text-center space-x-4 md:block">
                                <button @click="modal = false" class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">
                                    Cancel
                                </button>
                                <button type="submit" class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">Register</button>
                            </div>
                        
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <!-- SHOW EMPLOYEES -->
        <div class="col-12">             
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Last Name</th>
                            <th>Identification</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="employee in employees" :key="employee.id">
                            <td>{{ employee.id }}</td>
                            <td>{{ employee.name }}</td>
                            <td>{{ employee.last_name }}</td>
                            <td>{{ employee.identification }}</td>
                            <td>{{ employee.phone }}</td>
                            <td>{{ employee.addres }}</td>
                            <td>
                                <!-- llamamos al componente para Editar     -->
                                <router-link :to='{name:"editEmployee",params:{id:employee.id}}' class="btn btn-info"><i class="fas fa-edit"></i></router-link>
                                <a type="button" @click="deleteEmployee(employee.id)" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>                          
        </div>
    </div>
</template>

<script>
export default {
    name: "employees",
    name: "create-employee",
    data() {
        return {
            employees: [],
            modal: false,
            employee:{
                    name:"",
                    last_name:"",
                    identification:"",
                    phone:"",
                    addres:""
            }
        }
    },
    
    mounted() {
        this.showEmployees();
    },

    methods: {
        async create(){
            await this.axios.post('/api/employee',this.employee).then(response=>{
                this.$router.push({name:"showEmployee"})
            }).catch(error=>{
                console.log(error)
            })
        },

        async showEmployees() {
            await this.axios
            .get("/api/employee")
            .then((response) => {
                    this.blogs = response.data;
                })
            .catch((error) => {
                console.log(error);
                this.blogs = [];
                }
            );
        },

        deleteEmployee(id) {
            if (confirm("¿Confirma eliminar el registro?")) {
                this.axios
                .delete(`/api/employee/${id}`)
                .then((response) => {
                    this.showEmployees();
                })
                .catch((error) => {
                    console.log(error);
                });
            }
        },

    },

};

</script>