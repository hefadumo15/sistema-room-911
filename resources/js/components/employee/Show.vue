<template>
    <div class="row">
        <div class="col-12 mb-2">
            <!-- llamamos al componente para Crear   -->
            <router-link :to='{name:"createEmployee"}' class="btn btn-success"><i class="fas fa-plus-circle"></i> New Employee</router-link>
        </div>
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
                                <router-link :to='{name:"editEmployee",params:{id:employee.id}}' class="btn btn-info mt-2"><i class="fas fa-edit"></i>
                                </router-link>
                                <br />
                                <a type="button" @click="deleteEmployee(employee.id)" class="btn">
                                    <i class="fas fa-trash"></i>
                                </a>
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
    name:"employees",
    data(){
        return {
            employees:[]
        }
    },
    mounted(){
        this.showEmployees()
    },
    methods:{
        async showEmployees(){
            await this.axios.get('/api/employee').then(response=>{
                this.employees = response.data
            }).catch(error=>{
                console.log(error)
                this.employees = []
            })
        },
        deleteEmployee(id){
            if(confirm("¿Confirma eliminar el registro?")){
                this.axios.delete(`/api/employee/${id}`).then(response=>{
                    this.showEmployees()
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
}
</script>