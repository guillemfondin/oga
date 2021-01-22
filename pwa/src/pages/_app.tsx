import React from 'react';
import Header from '../components/Header';
import Footer from '../components/Footer';
import { appWithTranslation } from '../../translations/i18n';

import '../assets/scss/main.scss';

const Index = (props: any) => {
  const { Component, pageProps } = props;

  return (
    <>
      <Header />
      <div className="main-content" >
        <Component {...pageProps}/>
      </div>
      <Footer />
    </>
  );
}
export default appWithTranslation(Index);
