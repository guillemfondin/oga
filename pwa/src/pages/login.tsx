import React, {ReactElement, useState} from 'react';
import { useRouter } from "next/router";
import { useForm } from "react-hook-form";
import { useTranslation } from "react-i18next";
import { login } from "../services/api/AuthAPI";
import Jumbotron from "../components/Jumbotron";

const Header = (): ReactElement => {
    const { t } = useTranslation();
    const router = useRouter();
    const { register, handleSubmit, errors } = useForm();
    const [error, setError] = useState<boolean>(false);

    const onSubmit = async data => {
        try {
            await login(data);

            await router.replace('/app');
        } catch (e) {
            setError(true);
        }
    };

    return (
        <Jumbotron>
            <h1>{t('page.login.title')}</h1>

            {error && <span>{t('page.login.error')}</span>}
            <form className={"login"} onSubmit={handleSubmit(onSubmit)}>
                <input
                    defaultValue={"guillem.fondin@hotmail.fr"} // TODO: remove
                    name={"email"}
                    placeholder={t('input.label.email')}
                    ref={register({ required: true })}
                />
                {errors.email && <span>{t('input.error.email')}</span>}

                <input
                    defaultValue={"password"} // TODO: remove
                    type={"password"}
                    name={"password"}
                    placeholder={t('input.label.password')}
                    ref={register({ required: true })}
                />
                {errors.password && <span>{t('input.error.password')}</span>}

                <button type={"submit"}>{t('input.label.connection')}</button>
            </form>
        </Jumbotron>
    );
}

export default Header;
