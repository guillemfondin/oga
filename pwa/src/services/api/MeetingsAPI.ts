import { Agenda } from "./AgendasAPI";
import { MeetingUser } from "./MeetingUsersAPI";

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
