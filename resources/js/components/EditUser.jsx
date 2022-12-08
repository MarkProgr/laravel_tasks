import React, {useEffect, useState} from 'react';
import axios from "axios";
import {Link, useNavigate, useParams} from "react-router-dom";

export default function EditUser() {
    const id = useParams();

    const navigate = useNavigate();

    const [name, setName] = useState('')
    const [email, setEmail] = useState('');
    const [gender, setGender] = useState('');
    const [status, setStatus] = useState('');


    useEffect(() => {
        axios.get(`/api/about/${id.userId}`)
            .then(response => {
                setName(response.data.data.name)
                setEmail(response.data.data.email)
                setGender(response.data.data.gender)
                setStatus(response.data.data.status)
            });
    }, [setName, setEmail, setGender, setStatus]);

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

    function updateUser() {
        axios.put(`/api/edit/${id.userId}`,
            {
                name,
                email,
                gender,
                status
            })
            .then(response => {
                if (response.status === 200) {
                    return navigate('/list');
                }
            });
    }

    return (
        <div className="container">
            <div className="mb-3">
                <label className="form-label">Name</label>
                <input type="text" onChange={handleInputName} value={name} className="form-control text-center rounded-4 w-50"></input>
            </div>
            <div className="mb-3">
                <label className="form-label">Email address</label>
                <input type="email" onChange={handleInputEmail} value={email} className="form-control text-center rounded-4 w-50"></input>
            </div>
            <div className="mb-3">
                <label className="form-label">Gender</label>
                <select value={gender} onChange={handleInputGender} className="form-select rounded-4 text-center w-50" aria-label="Default select example">
                    <option value='Male'>Male</option>
                    <option value='Female'>Female</option>
                </select>
            </div>
            <div className="mb-3">
                <label className="form-label">Status</label>
                <select name="status" onChange={handleInputStatus} value={status} className="form-select rounded-4 text-center w-50" aria-label="Default select example">
                    <option value='Active'>Active</option>
                    <option value='Inactive'>Inactive</option>
                </select>
            </div>
            <button onClick={updateUser} className="btn btn-primary w-10 rounded-5">Submit</button>
            <Link className='btn btn-dark rounded-5' to={'/list'}>Go back</Link>
        </div>
        )
}
