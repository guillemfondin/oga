import React from "react";
import Head from "next/head";
import { HydraAdmin, ResourceGuesser } from "@api-platform/admin";

const entrypoint = process.env.API_ENTRYPOINT || "https://localhost";

const AdminLoader = () => {
  if (typeof window !== "undefined") {
    return (
      <HydraAdmin entrypoint={entrypoint}>
        <ResourceGuesser name={'users'} />
      </HydraAdmin>
    );
  }

  return <></>;
};

const Admin = () => (
  <>
    <Head>
      <title>API Platform Admin</title>
    </Head>

    <AdminLoader />
  </>
);
export default Admin;
