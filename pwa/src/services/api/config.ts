export const API_URL = `${process.env.API_ENTRYPOINT ?? 'https://localhost'}/`;

export const LOGIN_API = API_URL + 'login_check';
export const USERS_API = API_URL + 'users';
export const MEETING_API = API_URL + 'meetings';
export const AGENDAS_API = API_URL + 'agendas';
export const HAS_VOTED_API = API_URL + 'has_voted';
export const MEETING_USERS_API = API_URL + 'meeting_users';
export const VOTE_API = API_URL + 'votes';
