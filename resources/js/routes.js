const App = ()=> import('./components/App.vue')
// const Home = ()=> import('./components/Home.vue')
// const Contact = ()=> import('./components/Contact.vue')

//Importamos los componenetes para los empleados
// const Show = ()=> import('./components/employee/Show.vue')
const Edit = ()=> import('./components/employee/Edit.vue')
const Create = ()=> import('./components/employee/Create.vue')

export const routes = [
    // {
    //     name: 'home',
    //     path: '/',
    //     component: Home
    // },
    // {
    //     name: 'contact',
    //     path: '/contact',
    //     component: Contact
    // },
    {
        name: 'showEmployee',
        path: '/dashboard',
        component: App
    },
    {
        name: 'createEmployee',
        path: '/create',
        component: Create
    },
    {
        name: 'editEmployee',
        path: '/edit/:id',
        component: Edit
    },
    
]

