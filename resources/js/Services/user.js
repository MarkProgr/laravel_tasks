import axios from 'axios';
import { join } from 'lodash';
import ValidationError from './errors';

class UserService {
  handleError(error) {
    const currentError = {};
    Object.keys(error.response.data.errors).forEach((field) => {
      currentError[field] = join(error.response.data.errors[field]);
    });
    currentError.image_name = null;
    throw new ValidationError(currentError);
  }

  async create(user) {
    try {
      await axios.post('api/create', user);
    } catch (error) {
      this.handleError(error);
    }
  }

  async edit(id, user) {
    try {
      await axios.put(`/api/edit/${id}`, user);
    } catch (error) {
      this.handleError(error);
    }
  }
}

export default new UserService();
