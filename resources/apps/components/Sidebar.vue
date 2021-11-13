<template>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
            <img :src="require('../assets/img/AdminLTELogo.png')" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user (optional) -->
            
            <div class="user-panel mt-2 pb-0 mb-3 d-flex"></div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                
                <li class="nav-item">
                    <!--<a href="widgets.html" class="nav-link active">-->
                    <a @click.prevent="goto('/')" class="nav-link" :class="{'active' : $route.path === '/dashboard' || $route.path === '/' }" href="/">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Dashboard
                        <!--<span class="right badge badge-danger">New</span>-->
                    </p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a @click.prevent="goto(routes.createorder)" class="nav-link" :class="{'active' : $route.path === routes.createorder  }" :href="routes.createorder ">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Create Order
                        <!--<i class="fas fa-angle-left right"></i>-->
                        
                    </p>
                    </a>
                    
                    
                </li>

                <li class="nav-item">
                    <!--<a href="widgets.html" class="nav-link active">-->
                    <a @click="logout" class="nav-link" href="javascript:void(0);">
                    <i class="nav-icon fa fa-window-close"></i>
                    <p>
                        Logout
                        <!--<span class="right badge badge-danger">New</span>-->
                    </p>
                    </a>
                </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
</template>

<script>
import { EventBus } from '../eventBus'
export default {
    data(){
        return {

            routes:{
                createorder: '/createorder',
            }
           
        }
    },

    methods:{
            goto(to) {

                console.log('to: ' +to)

                if(this.$route.path == to)
                    EventBus.$emit('reloadPage')
                else
                    this.$router.push(to)
            },
            loadMenu(){
                let path = this.$route.path
            },
            logout() {
                
                document.cookie = 'sso_token=; Max-Age=-99999999;';
                localStorage.removeItem('token');
                localStorage.removeItem('userInfo');
                localStorage.clear();
                axios.post('/logout')
                    .then(() => location.href = '/')
            },
    },
    mounted(){

        this.loadMenu()

    },
    computed: {
         
    }


}
</script>