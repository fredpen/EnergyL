import './App.css'
import {BrowserRouter, Routes, Route, Navigate} from 'react-router-dom';
import Login from "./pages/Auth/login.tsx";
import Register from "./pages/Auth/register.tsx";
import Dashboard from "./pages/Dashboard/home.tsx";


function App() {
    const isAuthenticated = false; // Replace with real auth later

    return (
        <BrowserRouter>
            <Routes>
                <Route path="/login" element={<Login/>}/>
                <Route path="/register" element={<Register/>}/>
                <Route
                    path="/dashboard"
                    element={isAuthenticated ? <Dashboard/> : <Navigate to="/login"/>}
                />
                <Route path="*" element={<Navigate to="/login"/>}/>
            </Routes>
        </BrowserRouter>
    );
}

export default App;

