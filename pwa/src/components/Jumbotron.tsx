import React, {ReactElement} from 'react';

const Jumbotron = ({children}): ReactElement => (
    <div className={"jumbotron"}>
        {children}
    </div>
);

export default Jumbotron;
