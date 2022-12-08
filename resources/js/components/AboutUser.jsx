import React, {Component, useEffect, useState} from 'react';
import ReactDOM from 'react-dom/client';
import axios from "axios";
import {Link, useParams} from "react-router-dom";

export default function AboutUser() {
    const id = useParams();

    const [user, setUser] = useState({});

    useEffect(() => {
        axios.get(`/api/about/${id.userId}`)
            .then(response => {
                setUser(response.data.data);
            });
    }, [setUser]);

    return (
        <div className='container'>
            <h2>{user.name}</h2>
            <p>{user.email}</p>
            <p>{user.gender}</p>
            <p>{user.status}</p>
            <div>
                <Link className='btn btn-dark' to='/list'>Go back</Link>
            </div>
        </div>
        )
}

