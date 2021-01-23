import React, { ReactElement } from 'react';
import { useTranslation } from "react-i18next";

const dashboard = (): ReactElement => {
  const { t } = useTranslation();

  return (
    <>
      <h1>{t('page.dashboard.title')}</h1>
    </>
  );
}

export default dashboard;
