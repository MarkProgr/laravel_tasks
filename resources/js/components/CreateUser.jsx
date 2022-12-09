// eslint-disable-next-line import/no-extraneous-dependencies
import React, { useState } from 'react';
// eslint-disable-next-line import/no-extraneous-dependencies
import axios from 'axios';
import { Link, useNavigate } from 'react-router-dom';

export default function CreateUser() {
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [gender, setGender] = useState('Male');
  const [status, setStatus] = useState('Active');

  const navigate = useNavigate();

  function createUser() {
    axios.post(
      '/api/create',
      {
        name,
        email,
        gender,
        status,
      },
    )
    // eslint-disable-next-line consistent-return
      .then((response) => {
        if (response.status === 201) {
          return navigate('/list');
        }
      });
  }

  return (
    <div className="container">
      <div className="mb-3">
        {/* eslint-disable-next-line jsx-a11y/label-has-associated-control */}
        <label className="form-label">Name</label>
        <input type="text" name="name" value={name} onChange={(e) => setName(e.target.value)} className="form-control text-center rounded-4 w-50" />
      </div>
      <div className="mb-3">
        {/* eslint-disable-next-line jsx-a11y/label-has-associated-control */}
        <label className="form-label">Email address</label>
        <input type="email" value={email} onChange={(e) => setEmail(e.target.value)} name="email" className="form-control text-center rounded-4 w-50" />
      </div>
      <div className="mb-3">
        {/* eslint-disable-next-line jsx-a11y/label-has-associated-control */}
        <label className="form-label">Gender</label>
        <select onChange={(e) => setGender(e.target.value)} value={gender} name="gender" className="form-select rounded-4 text-center w-50">
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
      </div>
      <div className="mb-3">
        {/* eslint-disable-next-line jsx-a11y/label-has-associated-control */}
        <label className="form-label">Status</label>
        <select name="status" value={status} onChange={(e) => setStatus(e.target.value)} className="form-select rounded-4 text-center w-50">
          <option value="Active">Active</option>
          <option value="Inactive">Inactive</option>
        </select>
      </div>
      {/* eslint-disable-next-line react/button-has-type */}
      <button onClick={createUser} className="btn btn-primary w-10 rounded-5">Submit</button>
      <Link className="btn btn-dark rounded-5" to="/list">Go back</Link>
    </div>
  );
}
