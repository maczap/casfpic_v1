import Vue from "vue";

export const store1 = Vue.observable({
  isNavOpen: false
});

export const mutations1 = {
  setIsNavOpen(yesno) {
    store1.isNavOpen = yesno;
  },
  toggleNav() {
    store1.isNavOpen = !store1.isNavOpen;
  }
};


