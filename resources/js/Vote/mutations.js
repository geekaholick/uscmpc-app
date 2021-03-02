let mutations = {
    // CREATE_POST(state, candidate) {
    //     state.candidates.unshift(candidate)
    // },
    FETCH_CANDIDATES(state, candidates) {
        return state.candidates = candidates
    },
    // DELETE_POST(state, candidate) {
    //     let index = state.candidates.findIndex(item => item.id === post.id)
    //     state.posts.splice(index, 1)
    // }

}
export default mutations
