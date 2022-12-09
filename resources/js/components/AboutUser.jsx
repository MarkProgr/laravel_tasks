// eslint-disable-next-line import/no-extraneous-dependencies
import React, { useState } from 'react';
import { Link, useLoaderData } from 'react-router-dom';

export default function AboutUser() {
  const data = useLoaderData();

  const [user] = useState(data.data);

  return (
    <div className="container">
      <h2>{user.name}</h2>
      <p>{user.email}</p>
      <p>{user.gender}</p>
      <p>{user.status}</p>
      <div>
        <Link className="btn btn-dark" to="/list">Go back</Link>
      </div>
    </div>
  );
}
