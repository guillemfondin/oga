import axios from 'axios';
import { USERS_API } from './config';
import { Meeting } from "./MeetingsAPI";
import { Options, toQuery } from "../utils/QueryOptions";

export interface User {
    "@context"?: string;
    "@id"?: string;
    "@type"?: string;
    id?: number;
    email: string,
    roles: string[],
    password?: string,
    meetings?: Meeting[]
}

/**
 * Créer un utilisateur
 **/
export function postUser(userData: User): Promise<User> {
    return axios.post(USERS_API, userData).then((response) => response.data);
}

/**
 * Récupérer la liste des utilisateurs
 **/
export function getUsers(options?: Options): Promise<User[]> {
    return axios.get(USERS_API + toQuery(options)).then((response) => response.data);
}

/**
 * Récupérer un utilisateur grâce à son ID
 **/
export function getUserById(id: number): Promise<User> {
    return axios.get(USERS_API + '/' + id).then((response) => response.data);
}

/**
 * Supprimer un utilisateur grâce à son ID
 **/
export function deleteUserById(id: number): Promise<void> {
    return axios.delete(USERS_API + '/' + id).then((response) => response.data);
}

/**
 * Modifier un utilisateur grâce à son ID
 **/
export function putUserById(id: number, userData: User): Promise<User> {
    return axios.put(USERS_API + '/' + id, userData).then((response) => response.data);
}

/**
 * Modifier une donnée d'un utilisateur grâce à son ID
 **/
export function patchUserById(id: number, password: string, token: string): Promise<User> {
    return axios.patch(USERS_API + '/' + id, { password }, {
        headers: {
            'Authorization': 'Bearer ' + token,
            'Content-Type': 'application/merge-patch+json',
        }
    }).then((response) => response.data);
}
