import axios from 'axios';
import authHeader from './auth-header';
import { API_URL } from '@/InternalAdmin/router/api_routes.js'


class UserService {
  getUser() {
    return axios.get(API_URL + '/user', { headers: authHeader() });
  }
}

export default new UserService();