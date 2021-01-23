import { Agenda } from "./AgendasAPI";
import { MeetingUser } from "./MeetingUsersAPI";
import axios from "axios";
import {MEETING_API, USERS_API} from "./config";

export interface Meeting {
    "@context"?: string;
    "@id"?: string;
    "@type"?: string;
    "id"?: number;
    "date": Date;
    "subject": string;
    "quorum"?: number;
    "currentAgenda"?: string;
    "agendas"?: Agenda[];
    "meetingUsers"?: MeetingUser[];
}

export function postMeeting(data: Meeting): Promise<Meeting> {
    return axios
        .post(MEETING_API, data)
        .then((response) => response.data)
    ;
}

export function getMeetingById(id: number): Promise<Meeting> {
    return axios
        .get(`${MEETING_API}/${id}`)
        .then((response) => response.data)
    ;
}

export function getMeetingsByUserId(userId: number): Promise<Meeting[]> {

    return axios
        .get(`${USERS_API}/${userId}/meetings`)
        .then((response) => response.data)
    ;
}
