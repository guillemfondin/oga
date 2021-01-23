import React, { ReactElement } from 'react';
import Link from 'next/link';

const Header = (): ReactElement => (
    <header className={"header"}>
        <Link href={'/'}>
            <h1>OGA</h1>
        </Link>
    </header>
);

export default Header;
