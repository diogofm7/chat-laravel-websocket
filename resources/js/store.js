import { createStore } from 'vuex'
import createPersistedState from "vuex-persistedstate";

export default createStore({
    state: {
        user: {}
    },
    mutations: {
        setUserState(state, value) {
            state.user = value;
        }
    },
    actions: {
       userStateAction: ({commit :commit}) => {
           axios.get('api/users/me').then(response => {
               commit('setUserState', response.data.user);
           })
       }
    },
    plugins: [createPersistedState()]
});
