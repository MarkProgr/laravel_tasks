// eslint-disable-next-line import/no-extraneous-dependencies
import React, { Component } from 'react';
// eslint-disable-next-line import/no-extraneous-dependencies
import ReactDOM from 'react-dom/client';
// eslint-disable-next-line import/no-extraneous-dependencies
import axios from 'axios';
import { Link, createBrowserRouter, RouterProvider } from 'react-router-dom';
import AboutUser from './AboutUser';
import EditUser from './EditUser';
import CreateUser from './CreateUser';

class App extends Component {
  // eslint-disable-next-line react/state-in-constructor
  state = {
    users: [],
  };

  componentDidMount() {
    axios.get('/api/list')
      .then((response) => {
        this.setState({ users: response.data.data });
      });
  }

  // eslint-disable-next-line class-methods-use-this
  deleteUser(id) {
    axios.delete(`api/delete/${id}`)
    // eslint-disable-next-line consistent-return
      .then((response) => {
        if (response.status === 204) {
          return window.location.reload();
        }
      });
  }

  render() {
    return (
      <table className="table caption-top">
        <caption>List of users</caption>
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Gender</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
          {/* eslint-disable-next-line react/destructuring-assignment */}
          {this.state.users.map((user, key) => (
            // eslint-disable-next-line react/no-array-index-key
            <tr key={key}>
              <th scope="row">{user.id}</th>
              <td>{user.name}</td>
              <td>{user.email}</td>
              <td>{user.gender}</td>
              <td>{user.status}</td>
              <td>
                <Link className="btn btn-dark" to={`/about/${user.id}`}>About</Link>
                <Link className="btn btn-dark" to={`/edit/${user.id}`}>Edit</Link>
                {/* eslint-disable-next-line react/button-has-type */}
                <button className="btn btn-danger" onClick={() => this.deleteUser(user.id)}>Delete</button>
              </td>
            </tr>
          ))}
        </tbody>
        <Link className="btn btn-success" to="/create">Create User</Link>
      </table>
    );
  }
}

export default App;

const router = createBrowserRouter([
  {
    path: '/list',
    element: <App />,
  },
  {
    path: '/about/:userId',
    loader: async ({ params }) => fetch(`/api/about/${params.userId}`),
    element: <AboutUser />,
  },
  {
    path: '/edit/:userId',
    loader: async ({ params }) => fetch(`/api/about/${params.userId}`),
    element: <EditUser />,
  },
  {
    path: '/create',
    element: <CreateUser />,
  },
]);

if (document.getElementById('root')) {
  const Index = ReactDOM.createRoot(document.getElementById('root'));

  Index.render(
    <React.StrictMode>
      <RouterProvider router={router} />
    </React.StrictMode>,
  );
}
