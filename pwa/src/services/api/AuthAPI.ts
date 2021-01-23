import axios from 'axios';
import jwtDecode from 'jwt-decode';
import { LOGIN_API, USERS_API } from './config';

interface LoginData {
  username: string,
  password: string
}

interface PasswordResetResponse {
  "@context": string,
  "@id": string,
  "@type": string,
  id: number
}

interface DecodedToken {
  id: number,
  firstName: string,
  lastName: string,
  roles: string[]
}

export function logout(): void {
  window.localStorage.removeItem('token');
  delete axios.defaults.headers['Authorization'];
}

export function login(loginData: LoginData): Promise<string> {
  return axios
    .post(LOGIN_API, loginData)
    .then((response) => response.data.token)
    .then((token) => {
      if (typeof token === "string") {
        window.localStorage.setItem('token', token);
        setAxiosToken(token);
        return token;
      }

      throw new Error("Invalid token");
    })
  ;
}

export function resetPassword(email: string, origin: string): Promise<PasswordResetResponse> {
  return axios
    .post(USERS_API + '/reset-password', {email}, {headers: {origin}})
    .then((response) => response.data)
  ;
}

export function setAxiosToken(token: string): void {
  axios.defaults.headers['Authorization'] = 'Bearer ' + token;
}

export function isAuthenticated(): string|boolean {
  const token = window.localStorage.getItem("token");
  if (!token) {
    return false
  }

  // @ts-ignore
  const {exp} = jwtDecode(token);

  if (exp * 1000 > new Date().getTime()) {
    return token;
  }

  return false;
}

export function setup(): boolean {
  const isAuth = isAuthenticated();

  if (!isAuth || typeof isAuth !== "string") {
    return false;
  }

  setAxiosToken(isAuth);
  return true;
}

export function decodeToken(token: string):DecodedToken {
  return jwtDecode(token);
}
