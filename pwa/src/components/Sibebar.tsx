import React, {ReactElement, useEffect} from 'react';
import { useTranslation } from "react-i18next";
import { useRouter } from "next/router";
import Link from 'next/link';
import {setup} from "../services/api/AuthAPI";

const links = [
    {
        path: "/app",
        label: "sidebar.menu.dashboard"
    },
    {
        path: "/app/meetings",
        label: "sidebar.menu.meeting"
    }
]

const Sidebar = (): ReactElement => {
    const { t } = useTranslation();
    const { route } = useRouter();

    return (
        <aside className={"sidebar"}>
            <h2>{t('sidebar.title')}</h2>

            <ul className={"menu"}>
                {links.map(({path, label}, index) => (
                    <li key={index} className={`${path === route && 'selected'} link`}>
                      <Link href={path}>{t(label)}</Link>
                    </li>
                ))}
            </ul>
        </aside>
    )
};

export default Sidebar;
