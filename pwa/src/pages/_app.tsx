import React, {useEffect, useState} from 'react';
import { useRouter } from "next/router";
import moment from "moment";
import Header from '../components/Header';
import Footer from '../components/Footer';
import Sidebar from "../components/Sibebar";
import { setup } from "../services/api/AuthAPI";
import { appWithTranslation } from '../../translations/i18n';

import '../assets/scss/main.scss';

const App = ({ Component, pageProps }: any) => {
  const { route, replace } = useRouter();
  const [displaySidebar, setDisplaySidebar] = useState(false);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    moment.locale('fr');

    if (!setup() && route.includes('app')) {
      replace('/login').then((r) => r);
    }

    setLoading(false);
  }, []);

  useEffect(() => {
    setDisplaySidebar(route.includes('app'))
  }, [route]);

  return (
    <>
      <Header />
      <div className={"main-content"}>
        {displaySidebar && <Sidebar />}
        <div className={`${displaySidebar && 'sidebar-open'} content`}>
          {loading ?
            <div className="loader"><span>Loading...</span></div>
          :
            <Component {...pageProps} />
          }
        </div>
      </div>
      <Footer />
    </>
  );
}
export default appWithTranslation(App);
