import React, { Component } from 'react';
import ReactDOM from 'react-dom/client';
import axios from 'axios';
import { Link, createBrowserRouter, RouterProvider } from 'react-router-dom';
import AboutUser from './AboutUser';
import EditUser from './EditUser';
import CreateUser from './CreateUser';

class App extends Component {
  constructor(args) {
    super(args);
    this.state = {
      users: [],
    };
  }

  componentDidMount() {
    axios.get('/api/list')
      .then((response) => {
        this.setState({ users: response.data.data });
      });
  }

  deleteUser(id) {
    axios.delete(`api/delete/${id}`)
      .then((response) => {
        if (response.status === 204) {
          window.location.reload();
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
          {this.state.users.map(({
            id,
            name,
            email,
            gender,
            status,
          }) => (
            <tr key={id}>
              <th scope="row">{id}</th>
              <td>{name}</td>
              <td>{email}</td>
              <td>{gender}</td>
              <td>{status}</td>
              <td>
                <Link className="btn btn-dark" to={`/about/${id}`}>About</Link>
                <Link className="btn btn-dark" to={`/edit/${id}`}>Edit</Link>
                <button type="button" className="btn btn-danger" onClick={() => this.deleteUser(id)}>Delete</button>
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
