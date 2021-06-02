import { store } from '../store';
export default function authHeader() {
  let user = store.state.auth.user;
  if (user && user.data.access_token) {
    return { Authorization: 'Bearer ' + user.data.access_token };
  } else {
    return {};
  }
}