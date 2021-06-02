import axios from 'axios';
import authHeader from './auth-header';
import { INTERNAL_ADMIN_API_URL } from '@/InternalAdmin/router/api_routes.js'


class CompanyService {
  listCompany() {
    return axios.get(INTERNAL_ADMIN_API_URL + '/companies', { headers: authHeader() });
  }

  createCompany(data) {
    return axios.post(INTERNAL_ADMIN_API_URL + '/companies', data, { headers: authHeader() });
  }
}

export default new CompanyService();