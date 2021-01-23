import React, { ReactElement, useEffect, useState } from 'react';
import Link from "next/link";
import { useTranslation } from "react-i18next";
import { getMeetingsByUserId, Meeting } from "../../../services/api/MeetingsAPI";
import { useUser } from "../../../hooks/useUser";

const meetings = (): ReactElement => {
  const { t } = useTranslation();
  const [meetings, setMeetings] = useState<Meeting[]>([])

  const fetchMeetings = async () => {
    const { id } = useUser();

    try {
      return await getMeetingsByUserId(id);
    } catch (e) {
      console.log(e);
    }
  }

  useEffect(() => {
    fetchMeetings().then(r => setMeetings(r['hydra:member']));
  }, []);

  return (
    <>
      <h1>{t('page.meeting.title')}</h1>

      <Link href={'/app/meetings/new'}><button>{t('page.meeting.add')}</button></Link>

      {meetings.map((meeting: Meeting, index) => (
        <Link key={index} href={`/app/meetings/${meeting.id}`}>
          <p>{meeting.subject}</p>
        </Link>
      ))}
    </>
  );
};

export default meetings;
