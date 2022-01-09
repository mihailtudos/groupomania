const state = {
    posts: [],
};
const getters = {
    posts: (state) => {
        return state.posts;
    },
    post: (state) => (postId) => {
        return state.posts.find(({ id }) => id == postId);
    },
};
const actions = {
    async loadPosts({ commit, dispatch }) {
        try {
            const posts = (await axios.get("/api/admin/posts")).data;
            commit("setPosts", posts);
        } catch (error) {
        }
    },
};
const mutations = {
    setPosts(state, data) {
        state.posts = data;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
