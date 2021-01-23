import { decodeToken } from "../services/api/AuthAPI";

export const useUser = (): any => {
    const token = localStorage.getItem('token');

    return decodeToken(token);
}
