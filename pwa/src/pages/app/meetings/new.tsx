import React, { ReactElement, useState } from 'react';
import { useTranslation } from "react-i18next";
import { useForm } from "react-hook-form";
import { useRouter } from "next/router";
import { postMeeting } from "../../../services/api/MeetingsAPI";
import { useRemoveEmptyFields } from "../../../hooks/useRemoveEmptyFields";

const add = (): ReactElement => {
    const { t } = useTranslation();
    const router = useRouter();
    const { register, handleSubmit, errors } = useForm();
    const [error, setError] = useState<boolean>(false);

    const onSubmit = async data => {
        try {
            const { id } = await postMeeting(useRemoveEmptyFields(data));

            await router.push(`/app/meetings/${id}`);
        } catch (e) {
            setError(true);
        }
    };

    return (
        <>
            <h1>{t('page.meeting.new.title')}</h1>

            {error && <span>{t('input.error.global')}</span>}
            <form className={"new"} onSubmit={handleSubmit(onSubmit)}>
                <input
                    name={"subject"}
                    placeholder={t('input.label.subject')}
                    ref={register({ required: true })}
                />
                {errors.subject && <span>{t('input.error.required')}</span>}

                <input
                    name="date"
                    type={'datetime-local'}
                    placeholder={t('input.label.date')}
                    ref={register({ required: true })}
                />
                {errors.date && <span>{t('input.error.required')}</span>}

                <input type={'number'} placeholder={t('input.label.quorum')} name="quorum" ref={register} />

                <button type={"submit"}>{t('input.label.save')}</button>
            </form>

        </>
    );
};

export default add;
