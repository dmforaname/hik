<template>
    <div>

        <!-- Site wrapper -->
        <div class="wrapper">

            <!-- Preloader -->
            <preloader></preloader>

            <!-- Navbar -->
            <navbar></navbar>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <sidebar></sidebar>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <breadcrumb></breadcrumb>
                </section>

                <!-- Main content -->
                
                <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <router-view></router-view>
                    </div>
                </div>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <footers></footers>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        
    </div>
    
</template>


<script>

import preloader from './Preloader.vue'
import sidebar from './Sidebar.vue'
import navbar from './Navbar.vue'
import footers from './Footer.vue'
import breadcrumb from './Breadcrumb.vue'

export default {
    components:{
        preloader,
        sidebar,
        navbar,
        footers,
        breadcrumb
    },
    mounted() {
        console.log('Component mounted.')
    }
}
</script>