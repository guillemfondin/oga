import React, { ReactElement, useEffect, useState } from 'react';
import moment from 'moment';
import { useRouter } from "next/router";
import { getMeetingById, Meeting } from "../../../services/api/MeetingsAPI";

const initialMeeting = {
    subject: "",
    date: new Date()
};

const meetingInfo = (): ReactElement => {
    const [meeting, setMeeting] = useState<Meeting>(initialMeeting);
    const router = useRouter();
    const { id } = router.query;

    const fetchMeeting = async () => {
        if (typeof id !== "string") {
            throw new Error("id must be a string");
        }

        try {
            return await getMeetingById(parseInt(id))
        } catch (e) {
            console.log(e);
        }
    }

    useEffect(() => {
        fetchMeeting().then(r => setMeeting(r));
    }, []);

    return (
        <>
            <h1>{meeting.subject}</h1>

            <p>{moment(meeting.date).format()}</p>
        </>
    )
};

export default meetingInfo;
