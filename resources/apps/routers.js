
import Dashboard from "./pages/Dashboard"
import CreateOrder from "./pages/CreateOrder"

const routes =  [
    {
        path: "/",
        alias: '/dashboard',
        name: 'Dashboard',
        component: Dashboard,
    },
    {
        path: "/createorder",
        name: 'CreateOrder',
        component: CreateOrder,
        meta: {
            
            title : 'Create Order'
        }
    },
];

export default routes;
