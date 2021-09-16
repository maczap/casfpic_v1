export default {

    setIsNavOpen(yesno) {
        state.isNavOpen = yesno;
    },
    toggleNav() {
        state.isNavOpen = !store.isNavOpen;
    },

    setCadastros(state, payload) {
        state.cadastros = payload;
    },
  
}