// eslint-disable-next-line import/no-extraneous-dependencies
import React, { useState } from 'react';
// eslint-disable-next-line import/no-extraneous-dependencies
import axios from 'axios';
import {
  Link,
  useLoaderData,
  useNavigate,
  useParams,
} from 'react-router-dom';

export default function EditUser() {
  const id = useParams();

  const data = useLoaderData();

  const navigate = useNavigate();

  const [name, setName] = useState(data.data.name);
  const [email, setEmail] = useState(data.data.email);
  const [gender, setGender] = useState(data.data.gender);
  const [status, setStatus] = useState(data.data.status);

  function updateUser() {
    axios.put(
      `/api/edit/${id.userId}`,
      {
        name,
        email,
        gender,
        status,
      },
    )
    // eslint-disable-next-line consistent-return
      .then((response) => {
        if (response.status === 200) {
          return navigate('/list');
        }
      });
  }

  return (
    <div className="container">
      <div className="mb-3">
        {/* eslint-disable-next-line jsx-a11y/label-has-associated-control */}
        <label className="form-label">Name</label>
        <input type="text" onChange={(e) => setName(e.target.value)} value={name} className="form-control text-center rounded-4 w-50" />
      </div>
      <div className="mb-3">
        {/* eslint-disable-next-line jsx-a11y/label-has-associated-control */}
        <label className="form-label">Email address</label>
        <input type="email" onChange={(e) => setEmail(e.target.value)} value={email} className="form-control text-center rounded-4 w-50" />
      </div>
      <div className="mb-3">
        {/* eslint-disable-next-line jsx-a11y/label-has-associated-control */}
        <label className="form-label">Gender</label>
        <select value={gender} onChange={(e) => setGender(e.target.value)} className="form-select rounded-4 text-center w-50" aria-label="Default select example">
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
      </div>
      <div className="mb-3">
        {/* eslint-disable-next-line jsx-a11y/label-has-associated-control */}
        <label className="form-label">Status</label>
        <select name="status" onChange={(e) => setStatus(e.target.value)} value={status} className="form-select rounded-4 text-center w-50" aria-label="Default select example">
          <option value="Active">Active</option>
          <option value="Inactive">Inactive</option>
        </select>
      </div>
      {/* eslint-disable-next-line react/button-has-type */}
      <button onClick={updateUser} className="btn btn-primary w-10 rounded-5">Submit</button>
      <Link className="btn btn-dark rounded-5" to="/list">Go back</Link>
    </div>
  );
}
