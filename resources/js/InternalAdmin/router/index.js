import { createWebHistory, createRouter } from "vue-router";
import Home from "../Pages/Home.vue";
import PageNotFound from "../Pages/404.vue";
import Login from "../Pages/Auth/Login.vue";
import ForgotPassword from "../Pages/Auth/ForgotPassword.vue";
import CompanyManagement from "../Pages/Company/Index.vue";
import CreateCompany from "../Pages/Company/Create.vue";
import * as api_routes from "./api_routes.js";
import { store } from '../store';
import auth from '../middleware/auth';

const routes = [
  {
    path: api_routes.HOME_URL,
    name: "home",
    component: Home,
    meta: {
      middleware: [auth]
    }
  },
  {
    path: api_routes.LOGIN_URL,
    name: "login",
    component: Login
  },
  {
    path: api_routes.FORGOT_PASSWORD_URL,
    name: "forgot-password",
    component: ForgotPassword
  },
  {
    path: api_routes.COMPANY_MANAGEMENT_URL,
    name: "company-management",
    component: CompanyManagement
  },
  {
    path: api_routes.CREATE_COMPANY_URL,
    name: "create-company",
    component: CreateCompany
  },
  { 
    path: '/:pathMatch(.*)*',
    name:'404', 
    component: PageNotFound,
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});
router.beforeEach((to, from, next) => {
  if (!to.meta.middleware) {
    return next()
  }
  
  const middleware = to.meta.middleware

  const context = {
      to,
      from,
      next,
      store
  }
  return middleware[0]({
      ...context
  })
});
export default router;