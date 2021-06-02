import CompanyService from '../services/company.service';

export const company = {
  namespaced: true,
  actions: {
    create({ commit }, data) {
      return CompanyService.createCompany(data).then(
        res => {
        //   commit('loginSuccess', user);
          return Promise.resolve(res);
        },
        error => {
        //   commit('loginFailure');
          return Promise.reject(error);
        }
      );
    },
    list({ commit }) {
      return CompanyService.listCompany().then(
        res => {
          return Promise.resolve(res);
        },
        error => {
          return Promise.reject(error);
        }
      );
    },
  },
  mutations: {
  }
};