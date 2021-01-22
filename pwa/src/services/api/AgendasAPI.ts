import { Meeting } from "./MeetingsAPI";
import { Vote } from "./VotesAPI";

export interface Agenda {
    "@context"?: string;
    "@id"?: string;
    "@type"?: string;
    "id"?: number;
    "meeting": Meeting;
    "label": string;
    "majority": number;
    "votes"?: Vote[];
    "usersVoted"?: string;
}
