
import Vue from "vue";
import Vuex from 'vuex'

Vue.use(Vuex)


export default new Vuex.Store({ 
    
    state : { 

        token: localStorage.getItem('token') || '',
        user: {},
        userLoaded: false,

    },
    mutations : { 

        login(state, token) {
            const now = new Date()

            localStorage.setItem("token", token)
            localStorage.setItem("token_ttl", now.getTime() + (3*60*60*1000))
        },
        logout(state) {
            localStorage.removeItem("token")
            localStorage.removeItem("token_ttl")
        },
        setUser(state, obj){
            
            state.user = obj
        },
        setUserLoaded(state, obj){

            state.userLoaded = obj
        },

    },
    getters: {
        isAuth: state => {
            return localStorage.getItem('token') !== null
        }
    },
    actions: { 

        getUserInfo(context){
            axios.get('/api/v1/users')
            .then(res => {

                context.commit('setUserLoaded', true)
                context.commit('setUser', res.data)
            }).catch(err=> {
                console.log("err===========", err)
                this.auth = false;
                document.cookie = 'sso_token=; Max-Age=-99999999;';
                localStorage.removeItem('token');
                localStorage.removeItem('userInfo');
                localStorage.clear();
                delete axios.defaults.headers.common['Authorization'];
                document.getElementById("logoutform").submit();
                return;
            })
        },

    }
})