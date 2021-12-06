const state = {
    user: {}
};
const getters = {
    user: (state) => {
        return {
            email: state.user.email,
            name: state.user.name
        }
    },
};
const actions = {
    loginUser( {commit}, user) {
        axios.post('/api/login', {
            email: user.email,
            password: user.password
        })
        .then((response) => {
            if (response.data.token) {
                localStorage.setItem(
                    'token',
                    response.data.token
                );
                localStorage.setItem(
                    'user',
                    JSON.stringify(response.data.user)
                );
            }
        }).then(() => {
        axios.get('/sanctum/csrf-cookie')
            .then(() => {
                axios.post('/login', {
                    email: user.email,
                    password: user.password
                }).then((response) => {
                    window.location.href = '/';
                })
            })
        });
    },
    async logoutUser({}) {
        await  axios.post('/api/logout', {
            token: localStorage.getItem('token'),
        }).then(() => {
            localStorage.removeItem('token');
            axios.post('/logout', {
                token: localStorage.getItem('token')
            });
        })
    },
    // getUser({ commit }) {
    //     axios.get('/api/user/current')
    //         .then(response => {
    //             commit('setUser', response.data)
    //         });
    // },
};
const mutations = {
    setUser(state, data) {
        state.user = data;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
