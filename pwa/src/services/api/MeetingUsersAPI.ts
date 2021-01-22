import { User } from "./UsersAPI";
import { Meeting } from "./MeetingsAPI";

export interface MeetingUser {
    "@context"?: string;
    "@id"?: string;
    "@type"?: string;
    "id"?: number;
    "meeting": Meeting;
    "user": User;
    "roles": string;
    "votedAgendas"?: string;
}
