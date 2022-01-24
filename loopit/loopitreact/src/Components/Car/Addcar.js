import React, {useState} from 'react';
import {Link, useHistory} from 'react-router-dom';
import axios from 'axios';
import swal from 'sweetalert';

function AddCar() {

    const history = useHistory();
    const [setInput, setCar] = useState({
        model: '',
        brand: '',
        stock: '',
        error_list: [],
    });

    const handleInput = (e) => {
        e.persist();
        setCar({...setInput, [e.target.name]: e.target.value })
    }

    const saveCar = (e) => {
        e.preventDefault();
        
        const data = {
            model:setInput.model,
            brand:setInput.brand,
            stock:setInput.stock,
        }

        axios.post(`http://localhost:8000/api/add-car`, data).then(res => {

            if(res.data.status === 200)
            {
                swal("Success!",res.data.message,"success");
                setCar({
                    model: '',
                    brand: '',
                    stock: '',
                    error_list: [],
                });
                history.push('/cars');
            }
            else if(res.data.status === 422)
            {
                console.log(res)
                setCar({...setInput, error_list: res.data.validationErrors });
            }
        });
    }

    return (
        <div>
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-6">
                        <div className="card">
                            <div className="card-header">
                                <h4>Add Students 
                                    <Link to={'/cars'} className="btn btn-danger btn-sm float-end"> BACK</Link>
                                </h4>
                            </div>
                            <div className="card-body">
                                
                                <form onSubmit={saveCar} >
                                    <div className="form-group mb-3">
                                        <label>Car Model</label>
                                        <input type="text" name="model" onChange={handleInput} value={setInput.model} className="form-control" />
                                        <span className="text-danger">{setInput.error_list.model}</span>
                                    </div>
                                    <div className="form-group mb-3">
                                        <label>Car Brand</label>
                                        <input type="text" name="brand" onChange={handleInput} value={setInput.brand}  className="form-control" />
                                        <span className="text-danger">{setInput.error_list.brand}</span>
                                    </div>
                                    <div className="form-group mb-3">
                                        <label>Total stock</label>
                                        <input type="text" name="stock" onChange={handleInput} value={setInput.stock}  className="form-control" />
                                        <span className="text-danger">{setInput.error_list.stock}</span>
                                    </div>

                                    <div className="form-group mb-3">
                                        <button type="submit" className="btn btn-primary">Save Car</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );

}

export default AddCar;