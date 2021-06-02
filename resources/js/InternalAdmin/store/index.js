'use strict'

import { createStore } from "vuex" 
import createPersistedState from "vuex-persistedstate";
import { auth } from './auth.module';
import { company } from './company.module';

export const store = createStore({
  plugins: [createPersistedState({
      storage: window.sessionStorage,
  })],
  modules: {
    auth,
    company
  },
  state: {
    layout: 'default-layout'
  },
  mutations: {
    SET_LAYOUT (state, payload) {
      state.layout = payload
    }
  },
  getters: {
    layout (state) {
      return state.layout
    }
  }
})