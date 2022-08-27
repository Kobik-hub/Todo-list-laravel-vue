const authState = {
    namespaced: true,
    state: {
        user: {},
    },
    mutations:{
        SET_USER: (state,data) =>{
            state.user = data;
        }
    },
    actions:{
        setUser({commit},user){
            commit('SET_USER', user);
        }
    }
}

export default authState
