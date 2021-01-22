import { Agenda } from "./AgendasAPI";
import { MeetingUser } from "./MeetingUsersAPI";

export interface Vote {
    "@context"?: string;
    "@id"?: string;
    "@type"?: string;
    "id"?: number;
    "votedAt"?: Date;
    "agenda": Agenda;
    "meetingUser": MeetingUser;
    "value"?: string;
}
