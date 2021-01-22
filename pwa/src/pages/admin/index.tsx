import React, {ReactElement} from "react";
import Head from "next/head";
import { HydraAdmin, ResourceGuesser } from "@api-platform/admin";

const entrypoint = process.env.API_ENTRYPOINT || "https://localhost";

const AdminLoader = (): ReactElement => {
  if (typeof window !== "undefined") {
    return (
      <HydraAdmin entrypoint={entrypoint}>
        <ResourceGuesser name={'users'} />
        <ResourceGuesser name={'meetings'} />
        <ResourceGuesser name={'agendas'} />
      </HydraAdmin>
    );
  }

  return <></>;
};

const Admin = (): ReactElement => (
  <>
    <Head>
      <title>API Platform Admin</title>
    </Head>

    <AdminLoader />
  </>
);
export default Admin;
