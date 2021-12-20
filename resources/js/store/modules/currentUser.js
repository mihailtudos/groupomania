import {isLoggedIn, logOut} from "../../components/Shared/util/auth";

const state = {
    user: {},
    isLoggedIn: false,
};
const getters = {
    user: (state) => {
        return {
            email: state.user.email,
            name: state.user.name,
            id: state.user.id
        }
    },
};
const actions = {
    loadStoredState(context) {
        context.commit("setLoggedIn", isLoggedIn());
    },
    async loadUser({ commit, dispatch }) {
        if (isLoggedIn()) {
            try {
                const user = (await axios.get("/user")).data;
                commit("setUser", user);
                commit("setLoggedIn", true);
            } catch (error) {
                dispatch("logout");
            }
        }
    },
    async logout({commit}) {
        try {
            logOut();
            window.location.href = '/auth/login';
            window.location.go();
            await axios.post('/logout');
            await commit("setLoggedIn", false);
        } catch (error) {
            await axios.post('/logout');
        }
    },
};
const mutations = {
    setUser(state, data) {
        state.user = data;
    },
    setLoggedIn(state, payload) {
        state.isLoggedIn = payload;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
