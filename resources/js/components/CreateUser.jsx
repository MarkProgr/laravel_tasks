import React, {Component, useState} from 'react';
import axios from "axios";
import {Link, Navigate, redirect, useNavigate} from "react-router-dom";

export default function () {
    const [name, setName] = useState('')
    const [email, setEmail] = useState('');
    const [gender, setGender] = useState('Male');
    const [status, setStatus] = useState('Active');

    const navigate = useNavigate();

    function handleInputName(e) {
        setName(e.target.value)
    }

    function handleInputEmail(e) {
        setEmail(e.target.value);
    }

    function handleInputGender(e) {
        setGender(e.target.value)
    }

    function handleInputStatus(e) {
        setStatus(e.target.value)
    }

    function createUser () {
        axios.post(`/api/create`,
            {
                name,
                email,
                gender,
                status
            })
            .then(response =>{
                if (response.status === 201) {
                    console.log(response.status);
                    return navigate('/list');
                }
            });
    }

    return (
        <div className="container">
            <div className="mb-3">
                <label className="form-label">Name</label>
                <input type="text" name='name' value={name} onChange={handleInputName} className="form-control text-center rounded-4 w-50"></input>
            </div>
            <div className="mb-3">
                <label className="form-label">Email address</label>
                <input type="email" value={email} onChange={handleInputEmail} name='email' className="form-control text-center rounded-4 w-50"></input>
            </div>
            <div className="mb-3">
                <label className="form-label">Gender</label>
                <select onChange={handleInputGender} value={gender} name='gender' className="form-select rounded-4 text-center w-50">
                    <option value='Male'>Male</option>
                    <option value='Female'>Female</option>
                </select>
            </div>
            <div className="mb-3">
                <label className="form-label">Status</label>
                <select name="status" value={status} onChange={handleInputStatus} className="form-select rounded-4 text-center w-50">
                    <option value='Active'>Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>
            <button onClick={createUser} className="btn btn-primary w-10 rounded-5">Submit</button>
            <Link className='btn btn-dark rounded-5' to='/list'>Go back</Link>
        </div>
    )
}
