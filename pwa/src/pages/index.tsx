import React, {ReactElement} from 'react';
import Head from "next/head";

const index = (): ReactElement => (
    <>
        <Head>
            <title>Welcome to OGA</title>
        </Head>

        <div className="welcome">
            <header className="welcome__top">
                <h1>Hello Online General Assembly</h1>
            </header>
            <section className="welcome__main">
                <div className="main__content">
                    <h1>
                        Welcome to <strong>OGA</strong>!
                    </h1>
                    <div className="main__before-starting">
                        <p>
                            This page will present features and more for your new favorite meeting app !
                        </p>
                    </div>
                    <div className="main__other">
                        <h2>Available services:</h2>
                    </div>
                </div>
            </section>
        </div>
    </>
);

export default index;
