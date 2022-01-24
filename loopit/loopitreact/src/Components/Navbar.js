import React from 'react';
import { Link, useHistory } from 'react-router-dom';
import { Button } from "reactstrap";

function Navbar ()
{
    let login = localStorage.getItem('isLoggedIn')
const history = useHistory();

    const onLogoutHandler = () => {
        localStorage.clear();
        window.location.reload(false);
        history.push('/');
      };
if(login)
  return(
    <div className="pb-5">
        <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
        <div className="container">

          <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span className="navbar-toggler-icon"></span>
          </button>
          <div className="collapse navbar-collapse" id="navbarSupportedContent">
             
            <ul className="navbar-nav ms-auto mb-2 mb-lg-0">
            
              {/* <li className="nav-item">
                <Link className="nav-link" to="/register">Register</Link>
              </li>
              <li className="nav-item">
                <Link className="nav-link" to="/login">Login</Link>
              </li> */}
              <Button
              className="btn btn-primary text-right"
              onClick={onLogoutHandler}
            >
              Logout
            </Button>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  );
  else
  return(
    <div className="pb-5">
        <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
        <div className="container">

          <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span className="navbar-toggler-icon"></span>
          </button>
          <div className="collapse navbar-collapse" id="navbarSupportedContent">
             
            <ul className="navbar-nav ms-auto mb-2 mb-lg-0">
            
              <li className="nav-item">
                <Link className="nav-link" to="/register">Register</Link>
              </li>
              <li className="nav-item">
                <Link className="nav-link" to="/login">Login</Link>
              </li>
              {/* <Button
              className="btn btn-primary text-right"
              onClick={onLogoutHandler}
            >
              Logout
            </Button> */}
            </ul>
          </div>
        </div>
      </nav>
    </div>
  );
}

export default Navbar;