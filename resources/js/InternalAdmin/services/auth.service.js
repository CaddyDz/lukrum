import axios from 'axios';

import { LOGIN_API_URL } from '@/InternalAdmin/router/api_routes.js'

class AuthService {
  login(user) {
    return axios
      .post(LOGIN_API_URL, {
        email: user.email,
        password: user.password
      })
      .then(response => {
        if (response.data.access_token) {
          localStorage.setItem('user', JSON.stringify(response.data));
        }

        return response.data;
      });
  }

  logout() {
    localStorage.removeItem('user');
    sessionStorage.clear();
  }
}

export default new AuthService();